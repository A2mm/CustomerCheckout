<?php

namespace App\Http\Controllers\Api\V1\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\Api\V1\Cart\CartApiResource;
use App\Http\Requests\Api\V1\Cart\AddCartApiRequest;
use App\Http\Requests\Api\V1\Cart\RemoveFromCartApiRequest;
use App\Models\Customer;

class CartApiController extends Controller
{
	/*#######################################################################################*/
    // start add to cart function 
    // validation handled through request
    public function add_cart(AddCartApiRequest $request)
	{
		// customer_id request parameter will act here as logged in user
		$item_id     = $request->item_id;
		$customer_id = $request->customer_id;
		$quantity    = $request->quantity;

		$auth_user   = Customer::findOrFail($customer_id);
		$cartItem    = Cart::where(['item_id' => $item_id, 'customer_id' => $customer_id])->first();
        
        // check if this user already has this item in his cart 
        
        // case exists
		if ($cartItem != null) {
		   $cartItem->update(['quantity' => $quantity]);
		   $message = 'Quantity Updated';	
		}
		// case not exists
		else{
			$data = [
				'customer_id' => $customer_id,
				'item_id'     => $item_id,
				'quantity'    => $quantity,
			];
			Cart::insert($data);
			$message = 'Item Added To Your Cart';
		}

	    return response()->json([
	    	'message'        => $message, 
	    	'status_code'    => 200,
	    ], 200);
	}
	// end add to cart function
    /*#######################################################################################*/

    
    /*#######################################################################################*/
    // start remove from cart function 
    public function remove_from_cart(RemoveFromCartApiRequest $request)
	{
		// customer_id request parameter will act here as logged in user
		$item_id     = $request->item_id;
		$customer_id = $request->customer_id;

		// logged in auth user
		$auth_user   = Customer::findOrFail($customer_id);
		// also fetch user cart with relation
		$cartItem    = Cart::where(['item_id' => $item_id, 'customer_id' => $customer_id])->first();        
		if ($cartItem->exists()) {
		   $cartItem->delete();
		   $message = 'Item Removed';	
		}

	    return response()->json([
	    	'message'        => $message, 
	    	'status_code'    => 200,
	    ], 200);
	}
	// end remove from cart function
    /*#######################################################################################*/

   /*#######################################################################################*/
    // start remove from cart function 
    public function show_cart(Request $request)
	{
		// customer_id request parameter will act here as logged in user
		$customer_id = $request->customer_id;
		// logged in auth user
		$auth_user   = Customer::findOrFail($customer_id);
		$cartItems   = Cart::where(['customer_id' => $auth_user->id]);
		$data        = CartApiResource::collection($cartItems->get());
		// sum total through collection
		$total       = collect($data)->sum('sub_total');

	    return response()->json([
	    	'total'          => $total,
	    	'count_items'    => count($data), // count items
	    	'data'           => $data, 
	    	'status_code'    => 200,
	    ], 200);
	}
	// end remove from cart function
    /*#######################################################################################*/

}
