@extends('layouts.app')

@section('content')
    <jumbotron>
        <h3>{{ $tag->tag }}</h3>
        <h6>{{ lang('Tags Meta') }}</h6>
    </jumbotron>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ lang('For Articles') }} ({{ $articles->count() }})</div>
                    <ul class="list-group">
                        @forelse($articles as $article)
                            <li class="list-group-item"><a href="{{url($article->slug)}}}">{{$article->title}}}</a></li>
                        @empty
                            <li class="text-center">{{ lang('Nothing') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection