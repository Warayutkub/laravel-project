<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    protected $table = 'authusers';
    public function level(){
        return $this->belongsTo('App\Models\Level');
    }
}
