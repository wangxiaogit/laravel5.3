<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 15:57
 */

namespace App\Repositories;


use App\Category;

class CategoryRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}