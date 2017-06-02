<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositories;
use App\Services\FileManager\UploadManager;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    protected $user;
    protected $manager;

    public function __construct(UserRepositories $user, UploadManager $uploadManager)
    {
        $this->user = $user;
        $this->manager = $uploadManager;
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

        return view('user.index', compact('user'));
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
        $file = $request->file('files');

        $input = ['image'=> $file];
        $rules = ['picture'=> 'image'];

        $validator = \Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['succss'=>false, 'errors'=>$validator->getMessageBag()->toArray()]);
        }

        $destinationPath = 'avatar/';

        $fileType = $file->getClientOriginalExtension();
        $filename = \Auth::user()->id.'_'.time().'_'.str_random(12). '.' . $fileType;

        $file->storeAs($destinationPath, $filename, 'uploads');

        $image = Image::make('uploads/'.$destinationPath.$filename)->fit(400)->stream();

        $this->manager->saveFile($destinationPath.$filename, $image->__toString());

        $this->user->saveAvatar(\Auth::user()->id, '/uploads/'.$destinationPath.$filename);

        return response()->json([
            'success' => true,
            'image'   => '/uploads/'.$destinationPath.$filename
        ]);
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
        if (\Auth::user()->isFollowing($id)) {
            \Auth::user()->unfollow($id);
        } else {
            \Auth::user()->follow($id);
        }

        return redirect()->back();
    }

    public function discussions($username)
    {
        $user = $this->user->getByName($username);

        if (!isset($user)) abort(404);

        $discussions = $user->discussions;

        return view('user.discussions', compact('user', 'discussions'));
    }

    public function comments($username)
    {
        $user = $this->user->getByName($username);

        if (!isset($user)) abort(404);

        $comments = $user->comments;

        return view('user.comments', compact('user', 'comments'));
    }
}
