@extends('welcome')

@section('title')
    DE Database
@endsection


@section('content')

    <section>
        <h1>Dimension</h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at:</th>
                    <th>Description</th>
                </tr>
                </thead>
            </table>
        </div>
        <div  class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody class="dimension-tbody">

                    @foreach($dimensions as $dimension)
                    <tr>
                        <td>{{$dimension->id}}</td>
                        <td>{{$dimension->name}}</td>
                        <td>{{$dimension->created_at}}</td>
                        <td>{{$dimension->description}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>

    <section>
        <h1>Configuration</h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at:</th>
                    <th>Description</th>
                </tr>
                </thead>
            </table>
        </div>
        <div  class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody class="configuration-tbody">
                @foreach($configurations as $configuration)
                    <tr>
                        <td>{{$configuration->id}}</td>
                        <td>{{$configuration->name}}</td>
                        <td>{{$configuration->created_at}}</td>
                        <td>{{$configuration->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <section>
        <h1>Material</h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at:</th>
                    <th>Description</th>
                </tr>
                </thead>
            </table>
        </div>
        <div  class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody class="material-tbody">
                @foreach($materials as $material)
                    <tr>
                        <td>{{$material->id}}</td>
                        <td>{{$material->name}}</td>
                        <td>{{$material->created_at}}</td>
                        <td>{{$material->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <section>
        <h1>Equipment</h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created at:</th>
                    <th>Description</th>
                </tr>
                </thead>
            </table>
        </div>
        <div  class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody class="equipment-tbody">
                @foreach($equipment as $equipmentOfOne)
                    <tr>
                        <td>{{$equipmentOfOne->id}}</td>
                        <td>{{$equipmentOfOne->name}}</td>
                        <td>{{$equipmentOfOne->created_at}}</td>
                        <td>{{$equipmentOfOne->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <section>
        <h1>Parameters</h1>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Description</th>
                    <th>Unit</th>
                </tr>
                </thead>
            </table>
        </div>
        <div  class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody class="parameter-tbody">
                @foreach($parameters as $parameter)
                    <tr>
                        <td>{{$parameter->id}}</td>
                        <td>{{$parameter->name}}</td>
                        <td>{{$parameter->created_at}}</td>
                        <td>{{$parameter->description}}</td>
                        <td>{{$parameter->unit}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    @for($i=0; $i<5; $i++)
        <div class="modal fade" tabindex="-1" role="dialog" id="management-edit-{{$i+1}}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <?php
                    $form = " <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                       <h5 class='modal-title'>Edit ";
                    $edit_type ="";
                    switch ($i){
                        case 0: $edit_type = 'dimension'; break;
                        case 1: $edit_type = 'configuration'; break;
                        case 2: $edit_type = 'material'; break;
                        case 3: $edit_type = 'equipment'; break;
                        case 4: $edit_type = 'parameter'; break;
                    }
                    $form = $form.$edit_type."</h5></div>";
                    if ($i<4){
                        $form = $form.
                                "   <div class='form-group'>
                                        <label for='management-name-edit-".($i+1)."'>".$edit_type." Name: </label>
                                        <input type='text' name='management-name-edit-".($i+1)."' id='management-name-edit-".($i+1)."'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='management-description-edit-".($i+1)."'>".$edit_type."Description:</label>
                                        <textarea class='form-control' name='management-description-edit-".($i+1)."' id='management-description-edit-".($i+1)."' rows='5'></textarea>
                                    </div>";
                    }else{
                        $form = $form.
                                "   <div class='form-group'>
                                        <label for='management-name-edit-".($i+1)."'>".$edit_type." Name: </label>
                                        <input type='text' name='management-name-edit-".($i+1)."' id='management-name-edit-".($i+1)."'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='management-description-edit-".($i+1)."'>".$edit_type."Description:</label>
                                        <textarea class='form-control' name='management-description-edit-".($i+1)."' id='management-description-edit-".($i+1)."' rows='5'></textarea>
                                    </div>
                                    <div class='form-group'>
                                        <label for='management-unit-edit-".($i+1)."'>".$edit_type." Unit: </label>
                                        <input type='text' name='management-unit-edit-".($i+1)."' id='management-unit-edit-".($i+1)."'>
                                    </div>
                                    ";
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
                        <button class="btn btn-danger" style="color: #000000" href="#" id="management-edit-{{$i+1}}-delete">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id = "management-edit-{{$i+1}}-save">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endfor


    <script>
        var token = '{{Session::token()}}';
        var urlEditDimension = '{{route('post.editDimension')}}';
        var urlDeleteDimension = '{{route('post.deleteDimension')}}';
        var urlEditConfiguration = '{{route('post.editConfiguration')}}';
        var urlDeleteConfiguration = '{{route('post.deleteConfiguration')}}';
        var urlEditMaterial = '{{route('post.editMaterial')}}';
        var urlDeleteMaterial = '{{route('post.editConfiguration')}}';
        var urlEditEquipment = '{{route('post.editEquipment')}}';
        var urlDeleteEquipment = '{{route('post.deleteEquipment')}}';
        var urlEditParameter = '{{route('post.editParameter')}}';
        var urlDeleteParameter = '{{route('post.deleteParameter')}}';
    </script>

@endsection