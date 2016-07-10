@extends('layouts.master')


@section('title')
    Account
@endsection


@section('content')
    <div class="row title-for-pub">
        <div class="col-md-12">
            <h1>Your Account</h1>
            <p class="lead">Edit Your Account</p>
            <p><i></i></p>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(Storage::disk('local')->has($user->first_name.'-'.$user->id.'.jpg'))
                    <img src="{{route('account.image', ['filename'=> $user->first_name.'-'.$user->id.'.jpg'])}}" style="width: 150px;height: 150px; float: left; border-radius:50% ;margin-right: 25px" alt="" class="img-responsive">
                @else
                    <img src="{{route('account.image',['filename'=>'default.jpg'])}}" alt="" class="img-responsive" style="width: 150px;height: 150px; float: left; border-radius:50% ;margin-right: 25px">
                @endif
                <h2>{{$user->first_name}}'s Profile</h2>
                <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
                    <label for="Update profile">Update Profile Image</label>
                    {{--
                    <input type="file" name="avatar">
                    <input type="hidden" value = "{{Session::token()}}" name="_token">
                    <input type="submit" class="pull-right btn btn-sm btn-primary ">
--}}
                    <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 form-group">
                        <label for="first_name">First name</label>
                        <input type="text" class="form-control" name = "first_name"  value="{{$user -> first_name}}" id="first_name">
                                <label for="image">Image (only .jpg)</label>
                                <input type="file" name="image"  id="image">
                            </div>



                        </div>
                        <input type="submit" class="pull-right btn btn-sm btn-primary ">
                        <input type="hidden" value = "{{Session::token()}}" name="_token">
                    </form>
                </form>
            </div>
        </div>
    </div>


{{--
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" name = "first_name" class = "form-control" value="{{$user -> first_name}}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class = "form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value = "{{Session::token()}}" name="_token">
            </form>
        </div>
    </section>
    --}}
{{--
    @if(Storage::disk('local')->has($user->first_name.'-'.$user->id.'.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{route('account.image', ['filename'=> $user->first_name.'-'.$user->id.'.jpg'])}}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
    --}}
@endsection
