<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, AuditableTrait;

    protected $table = 'user';

    const MODULE_NAME = 'Usuarios';

    const FIELDS = [
        'name' => [
            'name' => 'Nombre',
            'field' => 'input',
        ],
        'lastname' => [
            'name' => 'Apellido',
            'field' => 'input',
        ],
        'email' => [
            'name' => 'Correo',
            'field' => 'input',
        ],
        'avatar' => [
            'name' => 'Avatar',
            'field' => 'image',
        ],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'avatar',
        'password',
    ];

    protected $auditInclude = [
        'name',
        'lastname',
        'email',
        'avatar',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
