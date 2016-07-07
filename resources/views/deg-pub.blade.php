@extends('welcome')

@section('title')
    DEG
@endsection


@section('content')
    <div class="de-pub">
        <div class="row title-for-pub">
            <div class="col-md-12">
                <h1>DEG</h1>
                <p class="lead">Dielectric Elastomer Generator</p>
                <p><i>- Subject to a voltage, the DE reduces in
                        thickness and expands in area. This process is known as
                        electrical actuation</i></p>
            </div>
        </div>


        <div class="container-previews">
            <ul class="list-inline">
                <li>
                    <h2>Theory</h2>
                    <p>How does it act as an generator?</p>
                </li>

                <li>
                    <h2>DEGs</h2>
                    <p>Showcase some of the DEG</p>
                </li>
                <li>
                    <h2>Applications</h2>
                    <p>Let's use this new energy generator</p>
                </li>
            </ul> <!-- .cd-projects-previews -->
        </div>

        <div class="container-content-views">
            <ul>
                <li hidden>
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </li>
                <li hidden>
                    <h2>DEAs</h2>
                    <p>Showcase some of the DEA</p>
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </li>
                <li hidden>
                    <h2>Applications</h2>
                    <p>Let's use this artificial muscle</p>
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                </li>
            </ul> <!-- .cd-projects-previews -->
        </div>

    </div>
@endsection