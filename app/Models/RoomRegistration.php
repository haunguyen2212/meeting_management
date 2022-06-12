<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRegistration extends Model
{
    use HasFactory;

    protected $table = 'room_registrations';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function room(){
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function register(){
        return $this->belongsTo(Member::class, 'register_id', 'id');
    }

    public function typeSupport(){
        return $this->belongsTo(TypeSupport::class, 'type_sp_id', 'id');
    }

    public function supporter(){
        return $this->belongsTo(Supporter::class, 'supporter_id', 'id');
    }
}
