<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username' ,
        'phone' ,
        'active' ,
        'people_id',
        'varification_codes'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'varification_codes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'account_verified_at' => 'datetime',
    ];

    public function person(){
        return $this->belongsTo(\App\Models\People::class,'people_id','id');
    }
    /**
     * Third party authentication
     */
    public function thirdPartyAuthentications(){
        return $this->hasMany(\App\ThirdPartyAuthentication::class,'user_id','id');
    }
    public function facebookAuthentication(){
        $this->thirdPartyAuthentications()->where('name',\App\ThirdPartyAuthentication::FACEBOOK)->first();
    }
    public function googleAuthentication(){
        $this->thirdPartyAuthentications()->where('name',\App\ThirdPartyAuthentication::GOOGLE)->first();
    }
    public function appleAuthentication(){
        $this->thirdPartyAuthentications()->where('name',\App\ThirdPartyAuthentication::APPLE)->first();
    }
    /**
     * Functions
     */
    public function emailConfirmation($code){
        return $this->verification_codes == $code ? true : false ;
    }
    public function phoneConfirmation($code){
        return $this->verification_codes == $code ? true : false ;
    }
    /**
     * Route notifications for the authy channel.
     *
     * @return int
     */
    public function routeNotificationForAuthy()
    {
        return $this->authy_id;
    }

}
