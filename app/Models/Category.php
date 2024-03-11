<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $fillable=['name','image','status','description'];

    
    public function products(){
        return $this->hasMany(Products::class,'category_id','id');
    }
}
