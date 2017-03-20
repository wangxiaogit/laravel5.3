<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Identicon\Identicon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        $articles = $this->article->page(config('blog.article.number'), config('blog.article.sort'), config('blog.article.sortColumn'));

        return view('article.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = $this->article->getBySlug();

        return view('article.show', compact('article'));
    }
}
