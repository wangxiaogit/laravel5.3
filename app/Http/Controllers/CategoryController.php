<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();

        return view('category.index', compact('categories'));
    }

    public function show($category)
    {
        $articles = $this->category->getByName($category)->articles;

        return view('category.show', compact('category', 'articles'));
    }
}
