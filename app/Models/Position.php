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

    public function member(){
        return $this->hasMany(Member::class, 'position_id', 'id');
    }
}
