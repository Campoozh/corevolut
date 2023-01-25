<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

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
        'level_id',
        'url_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [];

    public function getFirstNameAttribute(){

        list($firstName, $lastName) = explode(" ", $this->name);

        return $firstName;

    }

    public function level(){

        return $this->hasOne('App\Models\Level', "id");

    }

    public function followers(){
        
        return $this->belongsToMany('App\Models\User', 'user_followers', 'user_id', 'follower_id'); 
        
    }
    
    public function followings(){
        
        return $this->belongsToMany('App\Models\User', 'user_followers', 'follower_id', 'user_id');
        
    }

    public function getNextId() {

     $statement = DB::select("show table status like 'users'");

     return $statement[0]->Auto_increment;

    }

    public function getLevelAttribute(){

        // $level = Level::where('id', $this->level_id)->get();
        
        $level = Level::findOrFail($this->level_id);

        return $level['level'];

    }

}
