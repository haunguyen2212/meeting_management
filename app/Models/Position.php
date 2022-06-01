<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class, 'position_id', 'id');
    }
}
