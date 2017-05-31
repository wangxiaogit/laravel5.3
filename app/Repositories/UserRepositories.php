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

    public function saveAvatar($id, $photo)
    {
        $user = $this->getById($id);

        $user->avatar = $photo;

        return $user->save();
    }
}