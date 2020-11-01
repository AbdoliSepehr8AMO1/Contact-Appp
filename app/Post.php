<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['user_id', 'title', 'body', 'price', 'image'];


    // We will define the relationship as a one-to-many relationship because a user will have many posts but a post will only ever belong to one user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }





}
