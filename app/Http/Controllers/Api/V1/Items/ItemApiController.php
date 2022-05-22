<?php

namespace App\Http\Controllers\Api\V1\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Resources\Api\V1\Items\ItemsApiResource;

class ItemApiController extends Controller
{
	/*########################################################################################*/
	public function fetch_items(Request $request)
	{
		// can arrange items according to its attributes (price, new, name)
		// if not sent , so default is latest first (DESC Order)
		
		$order_by     = isset($request->order_by) ? $request->order_by : 'created_at';
		$sequence     = isset($request->sequence) ? $request->sequence : 'Desc';

	    $collection   = Item::orderBy($order_by, $sequence)->get();
	    $data         = ItemsApiResource::collection($collection);

	    return response()->json([
	    	'data'        => $data, 
	    	'status_code' => 200,
	    ], 200);
	}
	/*########################################################################################*/
}
