@extends('layouts.de-template')
@section('type')DEA-Experiment
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
    <form class="form-horizontal add-de-experiments" method="post" action="{{route('post.createExperiment')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-1 control-label">Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="experiment_name" placeholder="name/id for experiment">
            </div>
            <label class="col-md-1 control-label">Image</label>
            <div class=" col-md-3">
                <input type="file" name="image" class = "form-control" id="image">
            </div>
            <label  class="col-md-1 control-label">Type</label>
            <div class="col-md-2">
                <input type="text" class="form-control" name = "experiment_type" value="DEA" readonly>
            </div>

        </div>
        <div class="form-group">
            <label  class="col-md-1 control-label">Purpose</label>
            <div class="col-md-11">
                <input type="text" class="form-control" name = "experiment_purpose" placeholder="what to accomplish?">
            </div>
        </div>
        <div class="form-group checkbox-group equipment-form">
            <label for="Equipments" class="col-md-1 control-label">Equipments</label>
            @for($i = 0; $i< 5; $i++)
                <div class="col-md-2">
                    <select class="form-control" name="equipment{{$i+1}}_id">
                        <option value="-1" disabled selected hidden>Equipment{{$i+1}}</option>
                        <option value="-1">None</option>
                        @foreach($equipments as $equipment)
                            <option value={{$equipment->id}}>{{$equipment->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endfor
            <a href="#" class="glyphicon glyphicon-plus" ></a>
        </div>
        <div class="form-group">
            <label for="experiment_procedure" class="col-md-1 control-label">Procedure</label>
            <div class="col-md-11">
                <textarea class="form-control" name="experiment_procedure" rows="3"></textarea>
            </div>
        </div>
        <div class="well well-sm" style="text-align: center; font-family: 'Al Bayan'; font-size: large;">
            <a href="#" class="select-dea" >Select DEA</a><br/>
            <label for="ID">ID:</label> 
            <input type="number" name="selected_dea_id" style="text-align: center; width: 40px" readonly>
        </div>

        <div class="well well-sm" style="text-align: center; font-family: 'Al Bayan'; font-size: large;">
            Result Parameters
        </div>
        <div class="row">
            <div class="label label-warning col-md-offset-1 col-md-10" style="">
                <a href="#" class="create-parameter"> Define New Parameter?</a>
            </div>
        </div>
        <div class="form-group">
        </div>

        <div class="parameter-form">
        @for($i = 0; $i<10; $i++)
                <div class="form-group">
                    <label for="Parameter {{$i+1}}" class="col-md-offset-1 col-md-2 control-label">Parameter {{$i+1}}</label>
                    <div class="col-md-3">
                        <select class="form-control" name="parameter{{$i+1}}_id">
                            <option value="-1" selected ></option>
                            <option value="-1" disabled ><b>Continuous</b></option>
                            @foreach($parameters as $para1)
                                <option value="{{$para1->id}}">{{$para1->name}}({{$para1->unit}})</option>
                            @endforeach


                        </select>
                    </div>

                    <label for="inputPassword3" class="col-md-offset-1 col-md-1 control-label">Value</label>
                    <div class="col-md-2">
                        <input type="number" name="parameter{{$i+1}}_value">
                    </div>
                    <div class="col-md-2">
                        <p class="unit"></p>
                    </div>
                </div>

        @endfor
        </div>

        <div class="well well-sm" style="text-align: center; font-family: 'Al Bayan'; font-size: large;">
        </div>



        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <button type = 'submit' class="btn btn-primary">Create Experiment</button>
                <input type="hidden" value = "{{Session::token()}}" name="_token">
            </div>
        </div>
    </form>
@endsection


@section('view-de')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <button class="parameters_filter_start_button btn-primary" >Filter Experiments!</button>
        </div>
    </div>
    <form action="" method="post">
        <span class="parameters_filter_tools" hidden>
            @for($i =0;$i<count($parameters);$i++)
                <div class="row">
                    <div class="col-md-4">
                        <label>{{$parameters[$i]->name}}</label>
                    </div>
                    <div class="col-md-4">
                        <
                        <input type="number" name="{{$parameters[$i]->name}}" class="max">
                        ({{$parameters[$i]->unit}})
                    </div>
                    <div class="col-md-4">
                        >
                        <input type="number" name="{{$parameters[$i]->name}}" class="min">
                        ({{$parameters[$i]->unit}})
                    </div>
                </div>
            @endfor

        </span>
    </form>


    <table class="table table-hover">
        @for($i = 0; $i< count($experiments); $i++)
           <div class="rr-both">
                <div class="rr rr-left">
                        <div class="row">
                            <div class="col-md-4 id_text">
                                ID: <b class="experiment-id">{{$experiments[$i]->id}}</b>
                            </div>
                            <div class="col-md-8">
                                <p class="name_text">{{$experiments[$i]->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <p class="purpose_text" ><i>-{{$experiments[$i]->purpose}}</i></p>
                        </div>
                        <div class="row last-row">
                            <div class="col-md-4">
                                <label>DEA</label>
                                <ul>
                                    <li><a>@if(isset($experiments[$i]->dea->configuration)){{$experiments[$i]->dea->configuration->name}}@endif</a></li>
                                    <li><a>@if(isset($experiments[$i]->dea->material)){{$experiments[$i]->dea->material->name}}@endif</a></li>
                                    <li><a>@if(isset($experiments[$i]->dea->prestretch))pre:{{$experiments[$i]->dea->prestretch}}@endif</a></li>
                                    <li><a>@if(isset($experiments[$i]->dea->layer))layer:{{$experiments[$i]->dea->layer}}@endif</a></li>

                                    <li><a>@if(isset($experiments[$i]->dea->layer)){{$experiments[$i]->dea->dimension->name}}@endif</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 tools-for-experiment">
                                <label>Tool</label>
                                <ul>
                                    @if(count($experiments[$i]->equipment)>0)
                                        <li><a>{{$experiments[$i]->equipment[0]->name}}</a></li>
                                    @endif
                                    @if(count($experiments[$i]->equipment)>1)
                                        <li><a>{{$experiments[$i]->equipment[1]->name}}</a></li>
                                    @endif
                                    @if(count($experiments[$i]->equipment)>2)
                                        <li><a>{{$experiments[$i]->equipment[2]->name}}</a></li>
                                    @endif
                                    @if(count($experiments[$i]->equipment)>3)
                                        <li><a>{{$experiments[$i]->equipment[3]->name}}</a></li>
                                    @endif
                                    @if(count($experiments[$i]->equipment)>4)
                                        <li><a>{{$experiments[$i]->equipment[4]->name}}</a></li>
                                    @endif
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <label>Procedure</label>
                                <p class="procedure_text">{{$experiments[$i]->procedure}}</p>
                            </div>
                        </div>
                </div>


                <div class="rr rr-right parameters">
                    <div>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <h3>Parameters</h3>
                            </div>
                        </div>
                        <ul>
                                @if(isset($parameterNames[$i][0]))
                                    <li><a>{{$parameterNames[$i][0]}}={{$experiments[$i]->value1}}({{$parameterUnits[$i][0]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][1]))
                                    <li><a>{{$parameterNames[$i][1]}}={{$experiments[$i]->value2}}({{$parameterUnits[$i][1]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][2]))
                                    <li><a>{{$parameterNames[$i][2]}}={{$experiments[$i]->value3}}({{$parameterUnits[$i][2]}})</a></li>
                                @endif()
                                @if(isset($parameterNames[$i][3]))
                                    <li><a>{{$parameterNames[$i][3]}}={{$experiments[$i]->value4}}({{$parameterUnits[$i][3]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][4]))
                                    <li><a>{{$parameterNames[$i][4]}}={{$experiments[$i]->value5}}({{$parameterUnits[$i][4]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][5]))
                                    <li><a>{{$parameterNames[$i][5]}}={{$experiments[$i]->value6}}({{$parameterUnits[$i][5]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][6]))
                                    <li><a>{{$parameterNames[$i][6]}}={{$experiments[$i]->value7}}({{$parameterUnits[$i][6]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][7]))
                                    <li><a>{{$parameterNames[$i][7]}}={{$experiments[$i]->value8}}({{$parameterUnits[$i][7]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][8]))
                                    <li><a>{{$parameterNames[$i][8]}}={{$experiments[$i]->value9}}({{$parameterUnits[$i][8]}})</a></li>
                                @endif
                                @if(isset($parameterNames[$i][9]))
                                    <li><a>{{$parameterNames[$i][9]}}={{$experiments[$i]->value10}}({{$parameterUnits[$i][9]}})</a></li>
                                @endif
                        </ul>

                    </div>
                </div>
            </div>
        @endfor
    </table>
@endsection


@section('modal')
    <!--Add Equipment modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="add-equipment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create New Equipment</h4>
                </div>
                <div class="modal-body">
                    <form action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="post-body">Equipment Name</label>
                            <input type="text" class="form-control" name="equipment-name" id="equipment-name">
                        </div>
                        <div class="form-group">
                            <label for="post-body">Category</label>
                            <select name="type" id="equipment-type">
                                <option value="EXPERIMENT_TOOL">Experiment tool</option>
                                <option value="DEA_APPLICATION">DEA Application</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="post-body">Description</label>
                            <textarea class="form-control" name="equipment-description" id="equipment-description" rows="5"></textarea>
                        </div>

                        <div class="form-group ">
                            <label for="image">Image (only .jpg)</label>
                            <input type="file" name="image" class = "form-control" id="equipment-image">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id = "add-equipment-modal-save">Save changes</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Select DEA Modal-->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="select-dea">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select DEA</h4>
                </div>
                <section class="select-dea-table">
                    @include('includes/dea-table')
                </section>
            </div>
        </div>
    </div>

    <!--Add parameter Modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="add-parameter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit DEA</h4>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="post-body">Parameter Name</label>
                            <input type="text" name="parameter-name">

                            <label for="post-body">Unit</label>
                            <input type="text" name="parameter-unit" style="width: 20%;">
                        </div>
                        <div class="form-group">
                            <label for="parameter-description">Description</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id = "add-parameter-modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit Experiment -->
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-Experiment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">DEA Experiment Photo/Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="de-experiment-image-container">
                            <img id="de-experiment-photo" src="" alt="" class="img-responsive" align="middle" style="margin: auto">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" style="color: #000000" href="#" id="Experiment-delete">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           {{--         <button type="button" class="btn btn-primary" id = "Experiment-save">Save changes</button>--}}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        var token = '{{Session::token()}}';
        var create_equipment_url = '{{route('post.createEquipment')}}';
        var create_parameter_url = '{{route('post.createParameter')}}';
        var delete_experiment_url = '{{route('post.deleteExperiment')}}';

        var search_dea_url = '{{route('post.searchDEA')}}'

        var urlExperimentImage = '{{route('post.experimentImage')}}';
    </script>

@endsection