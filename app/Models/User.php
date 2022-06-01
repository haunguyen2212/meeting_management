<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function account(){
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function supporter(){
        return $this->hasMany(Supporter::class, 'user_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'register_id', 'id');
    }

}
