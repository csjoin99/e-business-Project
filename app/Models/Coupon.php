<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "coupon";

    protected $fillable = [
        'code',
        'discount',
        'type',
        'date_start',
        'date_end',
        'stock',
    ];

    protected $appends = [
        'status',
        'discount_value'
    ];

    public function getStatusAttribute()
    {
        if (!$this->stock)
            return 'Agotado';
        $date_now = date("Y-m-d");
        if ($this->date_start > $date_now)
            return 'No activo';
        if ($this->date_end < $date_now)
            return 'Expirado';
        return 'Activo';
    }

    public function getDiscountValueAttribute()
    {
        if ($this->type === 'Fijo')
            return "S/. {$this->discount}";
        return floatval($this->discount) . "%";
    }
}
