<?php

namespace App\Transformers;

use App\Comment;
use App\User;
use League\Fractal\TransformerAbstract;

class CommentTransformers extends TransformerAbstract
{
    protected $availableIncludes = [ 'user' ];

    public function transform (Comment $comment) {
        $content = json_decode($comment->content);

        return [
            'id'            => $comment->id,
            'user_id'       => $comment->user_id,
            'username'      => isset($comment->user) ? $comment->user->name : 'Null',
            'avatar'        => isset($comment->user) ? $comment->user->avatar : config('blog.default_avatar'),
            'commentable'   => isset($comment->commentable) ? $comment->commentable->title : 'Be Forbidden!',
            'type'          => $comment->commentable_type,
            'content_raw'   => $comment->content,
            'created_at'    => $comment->created_at->diffForHumans(),
            'like'          => false,
            'like_num'      => 0,
        ];
    }

    public function includeUser(Comment $comment)
    {
        $user = $comment->user;

        return $this->item($user, new UserTransformer);
    }
}