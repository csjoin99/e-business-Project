<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Product extends Model implements Auditable
{
    use HasFactory, SoftDeletes, HasSlug, AuditableTrait;

    protected $table = "product";

    const MODULE_NAME = 'Productos';
    const FIELDS = [
        'category_id' => [
            'name' => 'Categoría',
            'field' => 'model',
            'model' => 'App\Models\Provider',
        ],
        'name' => [
            'name' => 'Nombre',
            'field' => 'input',
        ],
        'price' => [
            'name' => 'Precio',
            'field' => 'input',
        ],
        'discount' => [
            'name' => 'Descuento',
            'field' => 'input',
        ],
        'description' => [
            'name' => 'Descripción',
            'field' => 'textarea',
        ],
        'code' => [
            'name' => 'Código',
            'field' => 'input',
        ]
    ];

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'discount',
        'temp_stock',
        'description',
        'code',
    ];

    protected $appends = [
        'real_price',
    ];

    protected $auditInclude = [
        'category_id',
        'name',
        'price',
        'discount',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_photo()
    {
        return $this->hasMany(Product_photo::class)->orderBy('order', 'asc');
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
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

    public function find_category($id)
    {
        return Category::find($id)->name;
    }
}
