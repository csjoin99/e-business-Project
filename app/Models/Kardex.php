<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kardex extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "kardex";

    protected $fillable = [
        'product_id',
        'order_id',
        'buy_order_id',
        'total',
        'unit_price',
        'current_price',
        'init_stock',
        'end_stock',
        'quantity'
    ];

    protected $appends = [
        'type',
        'date',
        'new_total',
        'old_total',
        'unit_price_format',
        'current_price_format',
        'total_format',
    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }

    public function buy_order()
    {
        $this->belongsTo(Buy_order::class);
    }

    public function getTypeAttribute()
    {
        if ($this->order_id) {
            return 'orden';
        } else {
            return 'compra';
        }
    }

    public function getDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y');
    }

    public function getNewTotalAttribute()
    {
        return number_format($this->end_stock * $this->current_price, 2, '.', '');
    }

    public function getOldTotalAttribute()
    {
        return number_format($this->init_stock * $this->current_price, 2, '.', '');
    }

    public function getUnitPriceFormatAttribute()
    {
        return number_format($this->unit_price, 2, '.', '');
    }

    public function getCurrentPriceFormatAttribute()
    {
        return number_format($this->current_price, 2, '.', '');
    }

    public function getTotalFormatAttribute()
    {
        return number_format($this->total, 2, '.', '');
    }
}
