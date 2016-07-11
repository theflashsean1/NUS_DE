@extends('layouts.master')

@section('title')
    Welcome!
@endsection


@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>Dielectric Elastomer</h1>
            <p>A material that shapes the future of Robotics and Energy harvesting!</p>
            @if(!Auth::user())
                <p><a class="btn btn-primary btn-lg" href="#" id="sign-up-button" role="button">Staff Sign Up</a></p>
            @else
                @if(Auth::user()->focus == "ALL"||Auth::user()->focus == "OTHER")
                    <p><a class="btn btn-primary btn-lg" href="{{route('management')}}" id="" role="button">Edit Progress</a> </p>
                @else
                    <p><a class="btn btn-primary btn-lg" href="{{route(strtolower(Auth::user()->focus).'Experiment', ['page_number'=>'2'])}}" id="" role="button">{{Auth::user()->focus}} experiments</a></p>
                @endif
            @endif

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


    <!-- Sign up -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="sign-up">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <form action="{{route('signup')}}" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Your E-mail</label>
                            <input type="text" class="form-control" name="email" value = {{Request::old('email')}}>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Your first name</label>
                            <input type="text" class="form-control" name="first_name" value = {{Request::old('first_name')}}>
                        </div>
                        <div class="form-group">
                            <label for="password">Your Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="focus">Focus</label>
                            <select name="focus" value = {{Request::old('focus')}}>
                                <option value="All">All</option>
                                <option value="DEA">DEA</option>
                                <option value="DEG">DEG</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="credential">Credential</label>
                            <input type="password" class="form-control" name="credential">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id = "Experiment-save">Save</button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        var token = '{{Session::token()}}';
        var create_equipment_url = '{{route('post.createEquipment')}}';
        var create_parameter_url = '{{route('post.createParameter')}}';
        var delete_experiment_url = '{{route('post.deleteExperiment')}}';

        var search_dea_url = '{{route('post.searchDEA')}}'
    </script>



@endsection
