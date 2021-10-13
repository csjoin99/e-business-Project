<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_session extends Model
{
    use HasFactory;

    protected $table = "purchase_session";

    protected $fillable = [
        'token',
        'user_id',
        'date',
    ];
    
    public function product()
    {
        return $this->hasMany(Purchase_session_product::class);
    }
}
