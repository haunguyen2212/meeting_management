<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSupport extends Model
{
    use HasFactory;

    protected $table = 'types_support';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function meetingManagement(){
        return $this->hasMany(MeetingManagement::class, 'type_sp_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'type_sp_id', 'id');
    }
}
