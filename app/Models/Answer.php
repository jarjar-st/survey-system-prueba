<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['description', 'ask_id'];
    public function ask() {
        return $this->belongsTo(Ask::class);
    }
    public function votings() {
        return $this->hasMany(Voting::class);
    }
}
