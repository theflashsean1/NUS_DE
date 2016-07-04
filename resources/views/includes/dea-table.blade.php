<!--This DEA table view requires $dimensions, $configurations, $materials, $prestretches, $layers and deas when called-->
<!--When Submit is clicked, values on form are submitted to searchDEA method, -->
<form action="{{route('post.searchDEA')}}" method="post">
    <div class="row">
        <div class="col-md-2 ">
            <h3>Dimension</h3>
        </div>
        <div class="col-md-2 ">
            <h3>Configuration</h3>

        </div>
        <div class="col-md-2 ">
            <h3>material</h3>
        </div>
        <div class="col-md-2 ">
            <h3>prestretch</h3>
        </div>
        <div class="col-md-2 ">
            <h3>layer</h3>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <select class="form-control" name="dimension_id">

                <option value="-1">All</option>
                @foreach($dimensions as $dimension)
                    <option value="{{$dimension->id}}">{{$dimension->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 ">
            <select class="form-control" name="configuration_id">
                <option value="-1">All</option>
                @foreach($configurations as $configuration)
                    <option value="{{$configuration->id}}">{{$configuration->name}}</option>
                @endforeach
            </select>

        </div>

        <div class="col-md-2 ">
            <select class="form-control" name="material_id">
                <option value="-1">All</option>
                @foreach($materials as $material)
                    <option value="{{$material->id}}">{{$material->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 1">
            <select class="form-control" name="prestretch">
                <option value="-1.0">All</option>
                @foreach($prestretches as $prestretch)
                    <option value="{{$prestretch->prestretch}}">{{$prestretch->prestretch}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 ">
            <select class="form-control" name="layer">
                <option value="-1">All</option>
                @foreach($layers as $layer)
                    <option value="{{$layer->layer}}">{{$layer->layer}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type = 'submit' class="btn btn-primary">Find DEA</button>
            <input type="hidden" value = "{{Session::token()}}" name="_token">
        </div>
    </div>

   

</form>


<table class="table table-hover">

    @for($i = 0; $i< count($deas); $i++)
        @if($i%2 == 1)
            <div class="rr rr-right">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <h3>ID: {{$deas[$i]->id}} </h3>
                        </div>

                        <div class="col-md-9">
                            <input type="hidden" value="{{$deas[$i] -> configuration_id}}">
                            <h2>@if(isset($deas[$i]->configuration)){{$deas[$i]->configuration->name}} @endif</h2>
                        </div>
                    </div>

                    <input type="hidden" value="{{$deas[$i] -> material_id}}">
                    <h4>@if(isset($deas[$i]->material))Material: {{$deas[$i]->material->name}}@endif</h4>

                    <input type="hidden" value="{{$deas[$i] -> prestretch}}">
                    <h4>Prestretch: {{$deas[$i]->prestretch}}</h4>

                    <input type="hidden" value="{{$deas[$i] -> layer}}">
                    <h4>Layer: {{$deas[$i]->layer}}</h4>

                    <input type="hidden" value="{{$deas[$i] -> dimension_id}}">
                    <h5>@if(isset($deas[$i]->dimension)){{$deas[$i]->dimension->name}}@endif</h5>

                </div>
            </div>
        @else


            <div class="rr rr-left">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <h3>ID: {{$deas[$i]->id}} </h3>
                        </div>

                        <div class="col-md-9">
                            <input type="hidden" value="{{$deas[$i] -> configuration_id}}">
                            <h2>@if(isset($deas[$i]->configuration)){{$deas[$i]->configuration->name}} @endif</h2>
                        </div>
                    </div>

                    <input type="hidden" value="{{$deas[$i] -> material_id}}">
                    <h4>@if(isset($deas[$i]->material))Material: {{$deas[$i]->material->name}}@endif</h4>

                    <input type="hidden" value="{{$deas[$i] -> prestretch}}">
                    <h4>Prestretch: {{$deas[$i]->prestretch}}</h4>

                    <input type="hidden" value="{{$deas[$i] -> layer}}">
                    <h4>Layer: {{$deas[$i]->layer}}</h4>

                    <input type="hidden" value="{{$deas[$i] -> dimension_id}}">
                    <h5>@if(isset($deas[$i]->dimension)){{$deas[$i]->dimension->name}}@endif</h5>
                </div>
            </div>
        @endif

    @endfor


</table>