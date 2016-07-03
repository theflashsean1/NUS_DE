<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NUS-DEA/DEG</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{route('welcome')}}">Home <span class="sr-only">(current)</span></a></li>

                    <li><a href="{{route('progress-pub')}}">Progress</a></li>

                    <li><a href="#">DEA</a></li>

                    <li><a href="#">DEG</a></li>

                    <li><a href="{{route('contact')}}">Contact</a></li>

                    @if(Auth::user())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actuation <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('deaDashboard',['dimension_id'=>'-1','configuration_id'=>'-1','material_id'=>'-1','prestretch'=>'-1.0','layer'=>'-1','page_number'=>'1'])}}">DEA</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('deaExperiment',['page_number'=>'1'])}}">Experiments</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('progress-dea')}}">DEA Team Plan</a></li>
                            </ul>

                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Energy<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('degDashboard',['dimension_id'=>'-1','configuration_id'=>'-1','material_id'=>'-1','prestretch'=>'-1.0','page_number'=>'1'])}}">DEG</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('degExperiment', ['page_number'=>'1'])}}">Experiments</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{route('progress-deg')}}">DEG Team Plan</a></li>
                            </ul>
                        </li>

                        <li><a href="{{route('management')}}">Manage</a></li>
                    @endif

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user())
                    <li><a href="{{route('account')}}">Account</a></li>
                    <li><a href="{{route('logout')}}">Logout</a></li>
                    @endif
                </ul>





            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->

    </nav>


</header>