<?php
namespace App\Repositories;


use App\Comment;

class CommentRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function getByCommentable($commentableId, $commentableType)
    {
        return $this->model->where(['commentable_id'=>$commentableId, 'commentable_type'=>$commentableType])->get();
    }

    public function store($input)
    {
        return $this->model->save($this->model, $input);
    }

    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
    }

}