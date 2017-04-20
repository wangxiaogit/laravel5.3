@extends('layouts.app')

@section('content')
    <jumbotron>
        <h3>{{ lang('Tags') }}</h3>
        <h6>{{ lang('Tags Meta') }}</h6>
    </jumbotron>

    <div class="container">
        <div class="row">
            @forelse($tags as $tag)
                <div class="col-md-3 text-center">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>
                                    <a href="{{ url('tag', ['tag'=>$tag->tag]) }}">{{ $tag->tag }}</a>
                                </h3>
                            </div>
                        </div>
                        <div class="panel-body" style="font-size: 12px;">
                            {{ $tag->meta_description }}
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-center">{{ lang('Nothing') }}</h3>
            @endforelse
        </div>
    </div>
@endsection