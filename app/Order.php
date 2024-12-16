<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'app_order';
	
	
	public function orderItem(){
		return $this->hasMany(OrderItem::class,'order_id','id');
	}
	public function orderPayment(){
		return $this->hasOne(OrderItem::class,'order_id','id');
	}
}
