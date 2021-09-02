<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "product";

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount',
        'stock',
        'description',
        'code',
    ];

    protected $appends = [
        'real_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_photo()
    {
        return $this->hasMany(Product_photo::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_detail')->withPivot(['quantity', 'price', 'price_discount']);
    }

    public function getRealPriceAttribute()
    {
        if (!$this->discount)
            return $this->price;
        return number_format($this->price * (100 - $this->discount) / 100, 2);
    }
}
