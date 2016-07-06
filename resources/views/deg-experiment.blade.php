@extends('layouts.de-template')


@section('type')DEG-Experiment
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
    <form class="form-horizontal add-de-experiments" method="post" action="{{route('post.createExperiment')}}">
        <div class="form-group">
            <label class="col-md-1 control-label">Name</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="experiment_name" placeholder="name/id for experiment">
            </div>
            <label  class="col-md-1 control-label">Type</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name = "experiment_type" value="DEG" readonly>
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
            <a href="#" class="select-deg" >Select DEG</a><br/>
            <label for="ID">ID:</label> 
            <input type="number" name="selected_deg_id" style="text-align: center; width: 40px" readonly>
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
                    <form action="#">
                        <div class="form-group">
                            <label for="post-body">Equipment Name</label>
                            <input type="text" class="form-control" name="equipment-name" id="equipment-name">
                        </div>
                        <div class="form-group">
                            <label for="post-body">Description</label>
                            <textarea class="form-control" name="equipment-description" id="equipment-description" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id = "add-equipment-modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        var token = '{{Session::token()}}';
        var create_equipment_url = '{{route('post.createEquipment')}}';
        var create_parameter_url = '{{route('post.createParameter')}}';
        var delete_experiment_url = '{{route('post.deleteExperiment')}}';

        var search_dea_url = '{{route('post.searchDEG')}}'
    </script>
@endsection