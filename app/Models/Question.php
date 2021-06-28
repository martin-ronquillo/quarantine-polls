<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poll_id', 
        'question',
        'type',
        'required',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function options(){
        return $this->hasMany(Option::class);
    }

    public function polls(){
        return $this->belongsTo(Poll::class, 'poll_id');
    }
}
