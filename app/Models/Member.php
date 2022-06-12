<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function account(){
        return $this->belongsTo(User::class, 'account_id', 'id');
    }

    public function supporter(){
        return $this->hasMany(Supporter::class, 'user_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'register_id', 'id');
    }
}
