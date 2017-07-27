<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends ApiController
{
    protected $comment;

    public function __construct(CommentRepository $comment)
    {
        parent::__construct();

        $this->comment = $comment;
    }

    public function show (Request $request, $commentableId)
    {
        $commentableType = $request->get('commentable_type');

        $comment = $this->comment->getByCommentable($commentableId, $commentableType);

        return $this->respondWithCollection($comment, new CommentTransformers);
    }

    public function store (CommentRequest $request)
    {
        $data = array_merge($request->all(), ['user_id'=> \Auth::user()->id]);

        $comment = $this->comment->store($data);

        return $this->respondWithItem($comment, new CommentTransformers);
    }

    public function destory($id)
    {
        $this->authorize('delete', $this->comment->getById($id));

        $this->comment->destroy($id);

        return $this->noContent();
    }
}
