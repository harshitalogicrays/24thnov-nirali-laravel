<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table="cart";
    protected $fillable=['user_id','product_id','quantity'];

    public function product():BelongsTo{
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}
