<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buy_order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "buy_order";

    protected $fillable = [
        'provider_id',
        'total',
        'subtotal',
        'discount',
        'num_doc',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'buy_order_detail')->withPivot(['quantity', 'total']);
    }
}
