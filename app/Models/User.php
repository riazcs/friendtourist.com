<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */


    const Roles = [
        'Admin' => 1,
        'Hotel Admin' => 2,
        'User' => 3
    ];

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'otp',
        'attempt',
        'can_verified_after',
        'user_type',
        'sur_name',
        'designation',
        'nid',
        'dob',
        'address',
        'base',
        'base_id',
        'age',
        'status',
        'phone_verified_at',
        'email_verified_at',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes ',
        'approved_by',
        'updated_by',
        'current_team_id',
        'profile_photo_path',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
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
     * The attributes that should be cast.
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

    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function hotel()
    {
        return $this->hasOne(Hotel::class, 'user_id', 'id');
    }
    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

    public function favourite_hotels()
    {
        return $this->belongsToMany(Hotel::class, 'favourites');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Rating::class, 'user_id', 'id');
    }
}
