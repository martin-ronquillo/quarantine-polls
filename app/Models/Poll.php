<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
