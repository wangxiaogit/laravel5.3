<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
       $tags = $this->tag->all();
       return view('tag.index', compact('tags'));
    }

    public function show($tag)
    {
        $tag = $this->tag->getByName($tag);

        $articles = $tag->articles;
        //dd($articles);
        return view('tag.show', compact('tag', 'articles'));
    }
}
