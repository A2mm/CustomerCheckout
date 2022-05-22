<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'carts';

    protected $fillable = [
        'item_id',
        'customer_id',
        'quantity',
    ];

    public function item(){
    	return $this->belongsTo(Item::class, 'item_id');
    }

    public function customer(){
    	return $this->belongsTo(Customer::class, 'customer_id');
    }
}
