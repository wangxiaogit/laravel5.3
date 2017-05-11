<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositories $user)
    {
        $this->user =$user;
    }

    public function index()
    {
        if(\Auth::check()) {
            return redirect()->to('/user/'.\Auth::user()->name);
        }
    }

    public function show($username)
    {
        $user = $this->user->getByName($username);
//        dd($user->toArray());
        if (!$user) abort(404);

        return view('user.index', compact('user'));
    }

    public function following($username)
    {
        $user = $this->user->getByName($username);

        if (!isset($user)) abort(404);

        $followings = $user->followings;

        return view('user.following', compact('user', 'followings'));
    }

    public function doFollow($id)
    {
        $user = $this->user->getById($id);

        if (\Auth::user()->isFollowing($id)) {
            \Auth::user()->unFollowing($id);
        } else {
            \Auth::user()->follow($id);
        }

        return redirect()->back();
    }

    public function edit()
    {
        if (!\Auth::id()) abort(404);

        $user = $this->user->getById(\Auth::id());

        return view('user.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['name', 'email', 'is_admin']);

        $user = $this->user->update($id, $input);

        return redirect()->back();
    }

    public function avatar(Request $request)
    {
        $file = $request->files['files'];

        $input = ['image'=> $file];
        $rules = ['image'=> 'image'];

        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['succss'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
        }

        $detinationPath = 'avatar/'.\Auth::user()->id.'/';
        $fileType = 1;
    }

}
