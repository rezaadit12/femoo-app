<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_history extends Model
{
    protected $table = 'history_users';
    protected $fillable = [
        'users_id', 'relapseDays', 'reasons',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'users_id');
    }
}
