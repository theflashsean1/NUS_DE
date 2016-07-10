@extends('welcome')

@section('title')
    DEA
@endsection


@section('content')
    <div class="de-pub">
        <div class="row title-for-pub">
            <div class="col-md-12">
                <h1>DEA</h1>
                <p class="lead">Dielectric Elastomer Actuator</p>
                <p><i>- Subject to a voltage, the DE reduces in
                        thickness and expands in area. This process is known as
                        electrical actuation</i></p>
            </div>
        </div>


        <div class="container-previews">
            <ul class="list-inline">
                <li>
                    <h2>Theory</h2>
                    <p>How does it act as an actuator?</p>

                </li>
                <li>
                    <h2>DEAs</h2>
                    <p>Showcase some of the DEA</p>
                </li>
                <li>
                    <h2>Applications</h2>
                    <p>Let's use this artificial muscle</p>
                </li>
            </ul> <!-- .cd-projects-previews -->
        </div>

        <div class="container-content-views">
            <ul>
                <li hidden>
                    <h2>The structure of DEA</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <p>1: A dielectric elastomer (DE) transducer consists
                                of a thin membrane of polymer, sandwiched between
                                compliant electrodes.</p>
                            <br>
                            <p>2: Subject to a voltage, the DE reduces in
                                thickness and expands in area.</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{route('public.image', ['filename'=>'dea_theory1.jpg'])}}" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-4">
                            <p>3: Because of its fast response time, excellent
                                conversion efficiency, and high specific energy</p>
                            <br>
                            <p>4: The maximum strain that can be induced by voltage is limited
                                by multiple modes of DE failure–</p>
                        </div>
                    </div>


                </li>

                <li hidden>
                    <h2>DEAs</h2>
                    <p>Showcase some of the DEA</p>
                    <div class="row">
                        @foreach($deas as $dea)

                        <div class="col-md-4">
                        @if(isset($dea->configuration))
                            <p>Configuration: {{$dea->configuration->name}}</p>
                        @endif
                            <br>
                        @if(isset($dea->dimension))
                            <p>Dimension: {{$dea->dimension->name}}</p>
                        @endif
                        </div>
                        <div class="col-md-4">
                            @if(Storage::disk('dea')->has("dea_".$dea->id.'.jpg'))
                                        <img src="{{route('get.deaImage', ['filename'=> "dea_".$dea->id.'.jpg'])}}" alt="" class="img-responsive">
                                </section>
                            @endif
                        </div>
                        <div class="col-md-4">

                            <p>Prestretch: {{$dea->prestretch}}</p>
                            <br>
                            <p>Layer: {{$dea->layer}}</p>
                            <br>
                            @if(isset($dea->material))
                            <p>Material: {{$dea->material->name}}</p>
                            @endif
                        </div>

                        @endforeach
                    </div>
                </li>

                <li hidden>
                    <h2>Applications</h2>
                    <p>Let's use this artificial muscle</p>

                        @foreach($applications as $application)
                        <div class="row">
                        <div class="col-md-6">
                            <p>Name: {{$application->name}}</p>
                            <br>
                            <p>Description: {{$application->description}}</p>
                        </div>
                        <div class="col-md-6">
                            @if(Storage::disk('equipment')->has("dea_application_".$application->id.'.jpg'))
                                <img src="{{route('get.equipmentImage', ['filename'=> "dea_".$application->id.'.jpg'])}}" alt="" class="img-responsive">
                                </section>
                            @endif
                        </div>
                        </div>
                        @endforeach

                </li>
            </ul> <!-- .cd-projects-previews -->
        </div>






    </div>

@endsection