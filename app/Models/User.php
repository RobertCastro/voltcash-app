<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $with = ["roles", "permissions"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        if (!request("page")) {
            session()->put("search", $filters['search'] ?? null);
            session()->put("roles", $filters['roles'] ?? null);
        }
        $query->when(session("search"), function ($query, $search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->when(session("roles"), function ($query, $roles) {
            if ($roles === 'administrator') {

                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'Administrator');
                })->get();

            } elseif ($roles === 'seller') {

                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'seller');
                })->get();

            } elseif ($roles === 'compliance') {
                
                $query->whereHas('roles', function ($q) {
                    $q->where('name', 'compliance');
                })->get();
            }
        });
    }
}
