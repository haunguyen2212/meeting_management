<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function member(){
        return $this->hasMany(Member::class, 'department_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'department_id', 'id');
    }
}
