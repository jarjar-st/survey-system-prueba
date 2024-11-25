<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    protected $fillable = ['description'];
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
