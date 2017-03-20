<?php
namespace App\Repositories;

use App\Article;
use App\Scopes\DraftScope;

class ArticleRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * Get the page of articles without draft scope.
     *
     * @param  integer $number
     * @param  string  $sort
     * @param  string  $sortColumn
     * @return collection
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        $this->model = $this->checkAuthScope();

        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Get the article by article's slug.
     * The Admin can preview the article if the article is drafted.
     *
     * @param $slug
     * @return object
     */
    public function getBySlug($slug)
    {
        $this->model = $this->checkAuthScope();

        $article = $this->model->where('slug', $slug)->firstOrFail();

        $article->increment('view_count');

        return $article;
    }

    /**
     * Check the auth and the model without global scope when user is the admin.
     *
     * @return Model
     */
    public function checkAuthScope()
    {
        if (auth()->check() && auth()->user()->is_admin) {
                $this->model = $this->model->withoutGlobalScope(DraftScope::class);
        }

        return $this->model;
    }


}