<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 14:45
 */

namespace App\Repositories;


use App\Tag;

class TagRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function getByName($name)
    {
        $this->model->where('tag',$name)->first();
    }
}