<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $user;

    public function __construct(UserRepositories $user)
    {
        $this->user = $user;
    }

    public function index ()
    {
        return view('setting.index');
    }

}
