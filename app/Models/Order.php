<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'orders';

    protected $fillable = [
        'customer_id',
        'total',
        'address',
        'telephone',
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class, 'customer_id');
    }

}
