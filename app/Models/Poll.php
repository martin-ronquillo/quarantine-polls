<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id', 
        'poll_reason',
        'poll_subtitle',
        'expected_samplings',
        'total_samplings',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'created_at',
        // 'updated_at'
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
