<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Provider extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $table = "provider";

    protected $fillable = [
        'name',
        'ruc',
        'address',
        'phone',
        'email',
    ];

    protected $auditInclude = [
        'name',
        'ruc',
        'address',
        'phone',
        'email',
    ];

    const MODULE_NAME = 'Proveedores';

    const FIELDS = [
        'name' => [
            'name' => 'Nombre',
            'field' => 'input',
        ],
        'ruc' => [
            'name' => 'RUC',
            'field' => 'input',
        ],
        'address' => [
            'name' => 'Dirección',
            'field' => 'input',
        ],
        'phone' => [
            'name' => 'Teléfono',
            'field' => 'input',
        ],
        'email' => [
            'name' => 'Email',
            'field' => 'input',
        ],
    ];

    public function getFieldAttribute()
    {
        return $this->name;
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
