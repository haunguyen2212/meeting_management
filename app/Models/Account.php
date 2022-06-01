<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'password',
        'role_id',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'account_id', 'id');
    }
}
