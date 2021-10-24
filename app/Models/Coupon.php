<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Coupon extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $table = "coupon";

    protected $fillable = [
        'code',
        'discount',
        'type',
        'date_start',
        'date_end',
        'stock',
    ];

    protected $auditInclude = [
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

    const MODULE_NAME = 'Cupones';

    const FIELDS = [
        'code' => [
            'name' => 'Código',
            'field' => 'input',
        ],
        'discount' => [
            'name' => 'Descuento',
            'field' => 'input',
        ],
        'type' => [
            'name' => 'Tipo',
            'field' => 'input',
        ],
        'date_start' => [
            'name' => 'Fecha de inicio',
            'field' => 'input',
        ],
        'date_end' => [
            'name' => 'Fecha de fin',
            'field' => 'input',
        ],
        'stock' => [
            'name' => 'Stock',
            'field' => 'input',
        ],
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

    protected function getUpdatedEventAttributes(): array
    {
        $old = [];
        $new = [];

        foreach ($this->attributes as $attribute => $value) {
            if ($this->isAttributeAuditable($attribute)) {
                $old[$attribute] = Arr::get($this->original, $attribute);
                $new[$attribute] = Arr::get($this->attributes, $attribute);
            }
        }

        return [
            $old,
            $new,
        ];
    }
}
