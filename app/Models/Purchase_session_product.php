<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_session_product extends Model
{
    use HasFactory;

    protected $table = "purchase_session_product";

    protected $fillable = [
        'purchase_session_id',
        'product_id',
        'quantity',
    ];
}
