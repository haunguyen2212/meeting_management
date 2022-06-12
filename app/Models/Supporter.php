<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $table = 'supporters';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function member(){
        return $this->belongsTo(Member::class, 'user_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'supporter_id', 'id');
    }
}
