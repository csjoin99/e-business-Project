<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Buy_order extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $table = "buy_order";

    protected $fillable = [
        'provider_id',
        'total',
        'subtotal',
        'discount',
        'num_doc',
    ];

    protected $auditInclude = [
        'provider_id',
        'total',
        'subtotal',
        'discount',
        'num_doc',
    ];

    const MODULE_NAME = 'Orden de compra';

    const FIELDS = [
        'provider_id' => [
            'name' => 'Proveedor',
            'field' => 'model',
            'model' => 'App\Models\Provider',
        ],
        'total' => [
            'name' => 'Total',
            'field' => 'input',
        ],
        'subtotal' => [
            'name' => 'Subtotal',
            'field' => 'input',
        ],
        'discount' => [
            'name' => 'Descuento',
            'field' => 'input',
        ],
        'num_doc' => [
            'name' => 'N°',
            'field' => 'input',
        ],
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'buy_order_detail')->withPivot(['quantity', 'total']);
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
