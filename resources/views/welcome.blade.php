@extends('layouts.master')

@section('title')
    Welcome!
@endsection


@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>Dielectric Elastomer</h1>
            <p>A material that shapes the future of Robotics and Energy harvesting!</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Staff Sign In</a></p>
        </div>
    </div>




    @if(!Auth::user())
        @include('includes.message-block')
        <div class="row">
            <!--sign up removed for temporary purpose-->

            <!-- end-->


            <div class="col-md-6 col-md-offset-3">
                <form action="{{route('signin')}}" method="post">
                    <h3>Sign In</h3>
                    <div class="form-group">
                        <label for="email">Your E-mail</label>
                        <input class = "form-control" type="text" name = "email" id = "email" value = "{{Request::old('email')}}">
                    </div>


                    <div class="form-group">
                        <label for="password">Your Password</label>
                        <input class = "form-control" type="password" name = "password" id = "password">
                    </div>
                    <button type ='submit' class="btn-primary">Submit</button>
                    <input type="hidden" name="_token" value = "{{Session::token()}}">
                </form>
            </div>

        </div>
    @endif


    @if(Auth::user())
        <h1 class="welcome-message">Welcome back {{Auth::user()->first_name}}</h1>
    @endif


    <footer>
        Created By Sheng Jia
    </footer>
@endsection
