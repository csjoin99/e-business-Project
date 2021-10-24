<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "provider";

    protected $fillable = [
        'name',
        'ruc',
        'address',
        'phone',
        'email',
    ];

    public function getFieldAttribute()
    {
        return $this->name;
    }
}
