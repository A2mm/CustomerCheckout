<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\Payment\PlaceTransactionApiRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Customer;
use App\Http\Resources\Api\V1\Cart\CartApiResource;

class PaymentApiController extends Controller
{  
    /*#######################################################################################*/
    // start place transaction function 
    public function place_transaction(PlaceTransactionApiRequest $request)
	{
		// customer_id request parameter will act here as logged in user
		$address        = $request->address;
		$telephone      = $request->telephone;
		$customer_id    = $request->customer_id;
		$auth_user      = Customer::findOrFail($customer_id);
		// get user current credit
		$current_credit = $auth_user->store_credit;

		// get total price of all cart's items
		$cartItems   = Cart::where(['customer_id' => $auth_user->id]);
		$data        = CartApiResource::collection($cartItems->get());
		$total       = collect($data)->sum('sub_total');


		$data = [
			'customer_id' => $customer_id,
			'address'     => $address,
			'telephone'   => $telephone,
			'total'       => $total,
		];
        
        // check if user has enough credit to cover transaction
		if ($current_credit < $total) 
		{
			return response()->json([
		    	'message'        => 'Payment Failed, Not Enough Credit', 
		    	'status_code'    => 400,
		    ], 400);
		}

		$order = Order::insert($data);
		$auth_user->update(['store_credit' => ($current_credit - $total)]);
		$cartItems->delete();
		return response()->json([
		    	'message'        => 'Transaction Placed', 
		    	'status_code'    => 200,
		], 200);
	}
	// end place transaction function
    /*#######################################################################################*/

}
