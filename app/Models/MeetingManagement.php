<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingManagement extends Model
{
    use HasFactory;

    protected $table = 'meeting_managements';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function typeSupport(){
        return $this->belongsTo(TypeSupport::class, 'type_sp_id', 'id');
    }
}
