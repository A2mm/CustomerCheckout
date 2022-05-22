<?php

namespace App\Http\Resources\Api\V1\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id'               => $this->id,
            'item_id'          => $this->item_id,
            'item_name'        => $this->item->name,
            'quantity'         => $this->quantity,
            'price'            => $this->item->price,
            'sub_total'        => floatval($this->item->price) * ($this->quantity),

        ];
    }
}
