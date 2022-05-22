<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'customers';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'store_credit',
    ];

    public function items(){
    	return $this->hasMany(Item::class);
    }

    public function orders(){
    	return $this->hasMany(Order::class);
    }
}
