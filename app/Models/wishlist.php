<?php

namespace App\Models;

use App\Models\product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class wishlist extends Model
{
    use HasFactory;

    public $table="wishlists";

    public $primaryKey="id";

    protected $fillable=['user_id','product_id'];

    public function user()
    {
        return $this->belongsTo(user::class,'user_id','id');
    }

    public function product()
    {
        return $this->belongsTo(product::class,'product_id','id');
    }
}
