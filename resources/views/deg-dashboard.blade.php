@extends('layouts.de-template')


@section('type')DEG
@endsection

@if($page_number == 1)
@section('page1')active @endsection
@section('page1_display')block @endsection
@section('page2_display')none @endsection
@endif

@if($page_number == 2)
@section('page2')active @endsection
@section('page1_display')none @endsection
@section('page2_display')block @endsection
@endif


@section('add-de')
    <div class="list-group add-de">
        <form action="{{route('post.createDEG')}}" method = 'post'>
            <div class="list-group add-de">
                <form action="{{route('post.createDEA')}}" method = 'post'>
                    <div class="list-group-item">
                <span class="row">
                    <span class="col-md-3 col-sm-3">
                        <h4 class="list-group-item-heading">Dimension</h4>
                         <p class="list-group-item-text">Selected Dimension ID</p>
                        <input class="output" name="dimension" type="text" value="-1" style="width: 40px" readonly >
                    </span>

                    <span class="col-md-8  col-sm-8">
                        <div class="horizontal">
                            <div class="table">
                                    <article>
                                        <h3>ID: -1</h3>
                                        <h2>No selection</h2>
                                        <input type="hidden" value="-1">
                                    </article>

                                @foreach($dimensions as $dimension)
                                    <article>
                                        <h3>@if($dimension->id)ID: {{$dimension->id}}@endif</h3>
                                        <h2>@if($dimension->name){{$dimension->name}}@endif</h2>
                                        <p>@if($dimension->description){{$dimension->description}}@endif</p>
                                        <input type="hidden" value="{{$dimension->id}}">
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </span>
                    <span class="col-md-1 col-sm-1">
                        <a href="#" class="add-1">Define new dimension</a>
                    </span>
                </span>
                    </div>

                    <div class="list-group-item">
                <span class="row">
                    <span class="col-md-3">
                        <h4 class="list-group-item-heading">Configuration</h4>
                         <p class="list-group-item-text">Selected Configuration ID:</p>
                         <input class="output" name="configuration" type="text" value="-1" style="width: 40px">
                    </span>
                    <span class="col-md-8">

                    <div class="horizontal">
                            <div class="table">
                                    <article>
                                        <h3>ID: -1</h3>
                                        <h2>No selection</h2>
                                        <input type="hidden" value="-1">
                                    </article>

                                @foreach($configurations as $configuration)
                                    <article>
                                        <h3>@if($configuration->id)ID: {{$configuration->id}}@endif</h3>
                                        <h2>@if($configuration->name){{$configuration->name}}@endif</h2>
                                        <p>@if($configuration->description){{$configuration->description}}@endif</p>
                                        <input type="hidden" value="{{$configuration->id}}">
                                    </article>
                                @endforeach
                            </div>
                    </div>

                    </span>
                    <span class="col-md-1">
                          <a href="#" class="add-2">Define new Configuration</a>
                    </span>
                </span>
                    </div>
                    <div  class="list-group-item">
                <span class="row">
                    <span class="col-md-3">
                        <h4 class="list-group-item-heading">Material</h4>
                         <p class="list-group-item-text">Selected Material ID</p>
                         <input class="output" name="material" type="text" value="-1" style="width: 40px">
                    </span>
                    <span class="col-md-8">

                   <div class="horizontal">
                            <div class="table">
                                    <article>
                                        <h3>ID: -1</h3>
                                        <h2>No selection</h2>
                                        <input type="hidden" value="-1">
                                    </article>
                                @foreach($materials as $material)
                                    <article>
                                        <h3>@if($material->id)ID: {{$material->id}}@endif</h3>
                                        <h2>@if($material->name){{$material->name}}@endif</h2>
                                        <p>@if($material->description){{$material->description}}@endif</p>
                                        <input type="hidden" value="{{$material->id}}">
                                    </article>
                                @endforeach
                            </div>
                        </div>

                    </span>
                    <span class="col-md-1">
                        <a href="#" class="add-3">Define new material</a>
                    </span>
                </span>
                    </div>
                    <div class="list-group-item">
                <span class="row">
                    <span class="col-md-3">
                        <h4 class="list-group-item-heading">Prestretch</h4>
                         <p class="list-group-item-text">Selected prestretch value:</p>
                         <input class="output" name="prestretch" type="text" value="-1" style="width: 40px">
                    </span>
                    <span class="col-md-8">

                    <div class="horizontal">
                            <div class="table">
                                    <article>
                                        <h3>ID: -1</h3>
                                        <h2>No selection</h2>
                                        <input type="hidden" value="-1">
                                    </article>
                                @foreach($prestretches as $prestretch)
                                    <article>
                                        <h2>@if($prestretch->prestretch){{$prestretch->prestretch}}@endif</h2>

                                        <input type="hidden" value="{{$prestretch->prestretch}}">
                                    </article>
                                @endforeach
                            </div>
                        </div>

                    </span>
                    <span class="col-md-1">
                        <a href="#" class="add-4">Define new Prestretch</a>
                    </span>
                </span>
                    </div>
                    <div class="list-group-item">
                <span class="row">
                    <span class="col-md-3">
                        <h4 class="list-group-item-heading">Layer</h4>
                         <p class="list-group-item-text">Selected layer value:</p>
                         <input class="output" name="layer" type="text" value="-1" style="width: 40px">
                    </span>
                    <span class="col-md-8">

                    <div class="horizontal" id="final">
                            <div class="table">
                                    <article>
                                        <h2>ID: -1</h2>
                                        <h3>No selection</h3>
                                        <input type="hidden" value="-1">
                                    </article>
                                @foreach($layers as $layer)
                                    <article>
                                        <h2>@if($layer->layer){{$layer->layer}}@endif</h2>

                                        <input type="hidden" value="{{$layer->layer}}">
                                    </article>
                                @endforeach
                            </div>
                        </div>

                    </span>
                    <span class="col-md-1">
                        <a href="#" class="add-5">Define new Layer</a>
                    </span>
                </span>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-5">
                            <button type = 'submit' class="btn btn-primary">Create DEG</button>
                            <input type="hidden" value = "{{Session::token()}}" name="_token">
                        </div>
                    </div>
                </form>
            </div>
        </form>
    </div>
@endsection


@section('view-de')
    @include('includes/deg-table')

@endsection




@section('modal')
    @for($i=0; $i<5; $i++)
        <div class="modal fade" tabindex="-1" role="dialog" id="add-{{$i+1}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php
                    $form = " <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                       <h5 class='modal-title'>Add ";
                    $add_type ="";
                    switch ($i){
                        case 0: $add_type = 'dimension'; break;
                        case 1: $add_type = 'configuration'; break;
                        case 2: $add_type = 'material'; break;
                        case 3: $add_type = 'prestretch'; break;
                        case 4: $add_type = 'layer'; break;
                    }
                    $form = $form.$add_type."</h5></div>";
                    if ($i<3){
                        $form = $form.
                                " <div class='form-group'>
                                        <label for='name-add-".($i+1)."'>".$add_type." Name:(used for search DEG)</label>
                                        <input type='text' name='name-add-".($i+1)."' id='name-add-".($i+1)."'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='description-add-".($i+1)."'>".$add_type."Description:</label>
                                        <textarea class='form-control' name='description-add-".($i+1)."' id='description-add-".($i+1)."' rows='5'></textarea>
                                    </div>";
                    }else{
                        $form = $form." <div class='form-group'>
                                        <label for='name-add-".($i+1)."'>".$add_type.": (used for search DEG)</label>
                                        <input type='number' name='name-add-".($i+1)."' id='name-add-".($i+1)."'>
                                      </div>";
                    }
                    echo
                            "<div class='modal-body'>
                          <form action='#'>
                          ".$form."
                          </form>
                        </div>
                       "
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id = "add-{{$i+1}}-modal-save">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endfor

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-DEG">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit DEG</h4>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="post-body">Edit DEG</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" style="color: #000000" href="#" id="DEG-delete">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id = "DEG-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        var token = '{{Session::token()}}';
        var urlDimension = '{{route('post.addDimension')}}';
        var urlConfiguration = '{{route('post.addConfiguration')}}';
        var urlMaterial = '{{route('post.addMaterial')}}';
        var urlDeleteDEG = '{{route('post.deleteDEG')}}';
    </script>

@endsection