<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/17
 * Time: 16:54
 */

namespace App\Repositories;


use App\User;

class UserRepositories
{
    use BaseRepository;

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}