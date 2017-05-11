<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public function comments ()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
