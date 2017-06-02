<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_admin', 'avatar', 'password', 'confirm_code',
        'nickname', 'real_name', 'weibo_name', 'weibo_link', 'email_notify_enabled',
        'github_id', 'github_name', 'github_url', 'website', 'description', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    /**
     *  I follow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follow_id');
    }

    /**
     * follow me
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follow_id', 'user_id');
    }


    /**
     * Judge follow
     */
    public function isFollowing($user)
    {
        return $this->followings->contains($user);
    }

    /**
     * do follow
     */
    public function follow($user)
    {
        return $this->followings()->attach($user);
    }

    /**
     * do unfollow
     */
    public function unfollow($user)
    {
        return $this->followings()->detach($user);
    }
}
