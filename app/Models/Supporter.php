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

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function roomRegistration(){
        return $this->hasMany(RoomRegistration::class, 'supporter_id', 'id');
    }
}
