<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // we intend to create a many-to-many relationship between the User and Role models so let’s add a relationship method on both models.
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }




    //We will be adding a checkRoles method that checks what role a user has. We will return a 404 page where a user doesn’t have the expected role for a page
    public function checkRoles($roles)
    {

        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(404);
        }

        return $this->hasRole($roles) || abort(404);
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }






    // a user can have many posts, but a user
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}
