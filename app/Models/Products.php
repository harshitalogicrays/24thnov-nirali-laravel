<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable=['name','brand','description','qty','selling_price','original_price','category_id','status'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function productImages(){
        return $this->hasMany(ProductImages::class,'product_id','id');
    }
}
