@extends('layouts.app')

@section('content')
    <Jumbotron v-cloak>
        <h3>{{ config('blog.article.title') }}</h3>
        <h6>{{ config('blog.article.description') }}</h6>
    </Jumbotron>

    @include('widgets.article')

    {{ $articles->links('pagination.default') }}
@endsection