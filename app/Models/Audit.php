<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Models\Audit as AuditContract;

class Audit extends AuditContract
{
    use HasFactory;

    public function getUserWithTrashedAttribute()
    {
        return User::where('id', $this->user_id)->withTrashed()->first();
    }
}
