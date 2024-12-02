<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = ['user_id', 'answer_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function answer() {
        return $this->belongsTo(Answer::class);
    }
}
