<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

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
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
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
        'photo_url'
    ];


    public function getPhotoUrlAttribute(){
        //$page.props.user.gender == 'm'? $page.props.appUrl+'/images/male_avatar.png' : $page.props.appUrl+'/images/female_avatar.png'

        $image = $this->gender ==='m'?asset('images/male_avatar.png'):asset('images/female_avatar.png');
        if(isset($this->profile_photo_path) && !empty($this->profile_photo_path)){
            if(Storage::disk('public')->exists($this->profile_photo_path)){
                $image = Storage::disk('public')->url($this->profile_photo_path);
            }
        }

        return $image;
    }
    public function hasRole($role): bool
    {
        if ($this->role === $role) {
            return true;
        }
        return false;
    }
}
