<?php

namespace App\Models;

use App\Models\order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order_items extends Model
{
    use HasFactory;

    public $table='order_items';
    public $primaryKey='id';

    public function order()
    {
        return $this->belongsTo(order::class,'order_id','id');
    }

    public function product()
    {
        return $this->belongsTo(product::class,'products_id','id');
    }
}
