@extends('layouts.progress-template')

@section('type')dea
@endsection


@section('left_post')
    <div class="col-md-3">
        <header><h3>Accomplishment</h3></header>
        @foreach($posts as $post)

            @if($post->post_for == 'accomplishment')
                <article class="post" data-postid = "{{$post -> id}}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name}} on {{ $post->created_at }}
                    </div>
                </article>
            @endif

        @endforeach
    </div>
@endsection


@section('right_post')
    <div class="col-md-3 col-md-offset-1">
        <header><h3>Meeting</h3></header>
        @foreach($posts as $post)

            @if($post->post_for == 'meeting')
                <article class="post" data-postid = "{{$post -> id}}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name}} on {{ $post->created_at }}
                    </div>
                </article>
            @endif

        @endforeach
    </div>
@endsection


@section('right_post_option')
    <option value="MEETING">Meeting</option>
@endsection