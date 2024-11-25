<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'id_number'];
    public function votings() {
        return $this->hasMany(Voting::class);
    }
}
