<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $fillable=['user_id','tracking_no','fullname','email','phone','pincode','address','status_message','payment_mode','payment_id'];
    
    public function orderItems(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}