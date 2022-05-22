<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'items';

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    // add some currency to price value when return
    public function getPriceAttribute($value)
    {
    	return $value. ' $';
    }
}
