<?php

namespace App\Models;

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
        'shipment_hour',
        'address',
        'district',
        'reference',
        'total',
        'subtotal',
        'discount',
        'status',
    ];

    /* shipment_type */
    /* 
    Contraentrega
    Presencial
    Delivery
    */

    /* shipment_status */
    /* 
    1: Entregado
    2: Enviado
    3: En espera
    */

    /* status */
    /* 
    1: Pagado
    2: Por pagar
    3: Anulado
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
        return $this->belongsToMany(Product::class, 'order_detail')->withPivot(['quantity', 'price', 'price_discount']);
    }

    public function getShipmentStatusTextAttribute()
    {
        switch ($this->shipment_status) {
            case 1:
                return 'Entregado';
                break;
            case 2:
                return 'Enviado';
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
            case 2:
                return 'Por pagar';
                break;
            default:
                return 'Anulado';
                break;
        }
    }
}
