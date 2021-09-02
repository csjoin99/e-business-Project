<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_photo extends Model
{
    use HasFactory;

    protected $table = "product_photo";

    protected $fillable = [
        'product_id',
        'image',
        'order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
