<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function users()
    {
        //users kunnen verschillende roles hebben
        return $this->belongsToMany(User::class);
    }
}
