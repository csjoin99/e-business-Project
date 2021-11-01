<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order";

    protected $fillable = [
        'user_id',
        'coupon_id',
        'code',
        'client',
        'shipment_date',
        'shipment_type',
        'shipment_price',
        'shipment_status',
        'address',
        'district',
        'reference',
        'total',
        'subtotal',
        'discount',
        'status',
    ];

    protected $appends = [
        'color'
    ];

    /* shipment_type */
    /* 
    Presencial
    Delivery
    */

    /* shipment_status */
    /* 
    1: Entregado
    0: En espera
    */

    /* status */
    /* 
    0: Por pagar
    1: Pagado
    2: Anulado
    */

    public function coupon()
    {
        return $this->belongsTo(Coupon::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_detail')->withPivot(['quantity', 'price']);
    }

    public function getShipmentStatusTextAttribute()
    {
        switch ($this->shipment_status) {
            case 1:
                return 'Entregado';
                break;
            default:
                return 'En espera';
                break;
        }
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 1:
                return 'Pagado';
                break;
            case 0:
                return 'Por pagar';
                break;
            default:
                return 'Anulado';
                break;
        }
    }

    public function getColorAttribute()
    {
        $current_date = Carbon::now();
        if ($this->status == 1 && $this->shipment_status == 1) {
            return "#28a745";
        } else {
            if ($current_date->gt($this->shipment_date)) {
                return "#dc3545";
            }
            if ($this->status != 1 && $this->shipment_status != 1) {
                return "#FFB302";
            }
            if ($this->status != 1) {
                return "#2DCCFF";
            }
            if ($this->shipment_status != 1) {
                return "#2DCCFF";
            }
            return "#dc3545";
        }
    }
}
