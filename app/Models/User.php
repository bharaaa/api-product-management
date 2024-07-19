<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, HasFactory, Notifiable;

    protected $table = "m_user";
    protected $primaryKey = "id";
    protected $keyType = "uuid";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            "email" => $this->email
        ];
    }
}
