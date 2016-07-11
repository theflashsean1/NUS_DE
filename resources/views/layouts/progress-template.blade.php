@extends('layouts.master')

@section('content')
    @include('includes.message-block')

        <div class="row title-for-pub">
            <div class="col-md-12">
                <h1>Progress</h1>
                <p class="lead">Where we are right now </p>
                <p><i></i></p>
            </div>
        </div>


    @if(Auth::user())
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">

            <form action="{{route('post.create')}}" method = 'post'>

                <header ><h3 style="display: inline; float: left">what do you want to share?</h3>
                <select name="post_for" class="btn-primary" id="" style="display: inline; float: right; margin-top: 25px">
                    <option value="Normal" selected>Normal Post</option>
                    <option value="ACCOMPLISHMENT">Accomplishment</option>
                    @yield('right_post_option');
                </select>
                </header>

                <div class="form-group">
                    <textarea name="body" id="new-post" rows="5" class="form-control" placeholder="Your post"></textarea>
                    <input type="hidden" value=@yield('type') name="post-type">
                    <button type = 'submit' class="btn btn-primary">Create Post</button>



                    <input type="hidden" value = "{{Session::token()}}" name="_token">
                </div>
            </form>
        </div>
    </section>
    @endif

    <section class="row posts">
        @yield('left_post')
        <div class="col-md-4 col-md-offset-1">
            <header><h3>Recent Plan/Post</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid = "{{$post -> id}}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->first_name}} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        @if(Auth::user())
                            <a href="#" class="edit">Edit</a>
                            <a href="{{route('post.delete', ['post_id' => $post->id])}}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
        @yield('right_post')
    </section>




    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="post-body">Edit the post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id = "modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
    </script>
@endsection