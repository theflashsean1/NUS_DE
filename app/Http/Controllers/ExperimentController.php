<?php
namespace App\Http\Controllers;

use App\Dea;
use App\Equipment;
use App\Experiment;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExperimentController extends Controller
{
    public function getDeaExperiment($page_number){
        $parameters = Parameter::orderBy('created_at', 'desc')->get();


        $equipments = Equipment::orderBy('created_at','desc')->get();

        $experiments = Experiment::where('dea_deg_other','=','DEA')->orderBy('created_at','desc')->get();
        $parameterNames =[[]]; // 2D array to hold parameters for each experiment
        $parameterUnits =[[]];
        for ($i=0; $i<count($experiments);$i++){
            foreach ($experiments[$i]->parameters as $parameter){
                $parameterNames[$i][$parameter->pivot->type_value_index]=$parameter->name;
                $parameterUnits[$i][$parameter->pivot->type_value_index]=$parameter->unit;
            }
        }


        //For attaching a DEA to the Experiment
        $data = DeController::searchDea(-1,-1,-1,-1,-1);

        $dimensions = $data['dimensions'];
        $configurations = $data['configurations'];
        $materials = $data['materials'];
        $prestretches = $data['prestretches'];
        $layers = $data['layers'];
        $deas = $data['deas'];


        return view('dea-experiment',['page_number'=>$page_number,'parameters'=>$parameters,'equipments'=>$equipments,'experiments'=>$experiments,'parameterNames'=>$parameterNames,'parameterUnits'=>$parameterUnits,'deas'=>$deas,  'dimensions'=>$dimensions,
        'configurations' => $configurations, 'materials'=>$materials, 'prestretches'=>$prestretches, 'layers'=>$layers]);
    }

    public function getDegExperiment($page_number){
        return view('deg-experiment', ['page_number'=>$page_number]);
    }


    public function postCreateExperiment(Request $request){
       // $this->validate($request, [
       //     'selected_dea_id'=>'min|0',
       // ]);
        $experiment = new Experiment();
        $experiment -> name = $request['experiment_name'];
        $experiment -> dea_deg_other = $request['experiment_type'];
        $experiment -> purpose = $request['experiment_purpose'];
        $experiment -> procedure = $request['experiment_procedure'];
        if(isset($request['selected_dea_id'])&&$request['selected_dea_id']!=''){
            $experiment ->dea_id = $request['selected_dea_id'];
        }
        $experiment->save();


        for ($i = 0; $i<5; $i++){
            $tempEquipmentID = 'equipment'.($i+1).'_id';
            if ($request[$tempEquipmentID]!=-1){
                $experiment->equipment()->attach($request[$tempEquipmentID]);
            }
        }

        for ($i = 0; $i<10;$i++){
            $tempID = 'parameter'.($i+1).'_id';
            $tempValueInsert = 'parameter'.($i+1).'_value';
            switch ($i){
                case 0: $experiment->value1= $request[$tempValueInsert];break;
                case 1: $experiment->value2= $request[$tempValueInsert];break;
                case 2: $experiment->value3= $request[$tempValueInsert];break;
                case 3: $experiment->value4= $request[$tempValueInsert];break;
                case 4: $experiment->value5= $request[$tempValueInsert];break;
                case 5: $experiment->value6= $request[$tempValueInsert];break;
                case 6: $experiment->value7= $request[$tempValueInsert];break;
                case 7: $experiment->value8= $request[$tempValueInsert];break;
                case 8: $experiment->value9= $request[$tempValueInsert];break;
                case 9: $experiment->value10= $request[$tempValueInsert];break;
            }
           if ($request[$tempID]!=-1){
               $experiment->parameters()->attach($request[$tempID],array('type_value_index'=>$i));
           }
        }
        $experiment->save();

        return redirect()->back();

    }
    public function postDeleteExperiment(Request $request){
        $experiment = Experiment::where('id', $request['experiment_id'])->first();
        $experiment->delete();
        return response()->json(200);
    }


    /*
     * DEA/DEG Experiment Common
     */
    //Equipment
    public function postCreateEquipment(Request $request){
        $equipment = new Equipment();
        $equipment->name = $request['equipment_name'];
        $equipment->description = $request['equipment_description'];
        $message = 'error';
        if($equipment -> save()){
            $message = 'Equipment successfully created';
        };
        return response() -> json(['new_equipment_name' => $equipment->name, 'new_equipment_id'=>$equipment->id],200);
    }
    public function postEditEquipment(Request $request){
        $equipment = Equipment::where('id', $request['id'])->first();
        $equipment->name = $request['name'];
        $equipment->description = $request['description'];
        $equipment->update();
        return response()->json(['new_name' => $equipment->name, 'new_description'=>$equipment->description],200);
    }
    public function postDeleteEquipment(Request $request){
        $equipment = Equipment::where('id', $request['id'])->first();
        $equipment->delete();
        return response()->json(200);
    }


    //Parameter
    public function postCreateParameter(Request $request){
        $parameter = new Parameter();
        $parameter->name = $request['parameter_name'];
        $parameter->unit = $request['parameter_unit'];
        $parameter->description = $request['parameter_description'];
        $parameter->update();
        $parameter->save();
        return response() -> json(['new_parameter_name'=>$parameter->name, 'new_parameter_unit'=>$parameter->unit, 'new_parameter_id'=>$parameter->id],200);
    }
    public function postEditParameter(Request $request){
        $parameter = Parameter::where('id', $request['id'])->first();
        $parameter->name = $request['name'];
        $parameter->description = $request['description'];
        $parameter->unit = $request['unit'];

        return response()->json(['new_name' => $parameter->name, 'new_description'=>$parameter->description, 'new_unit'=>$parameter->unit],200);
    }
    public function postDeleteParameter(Request $request){
        $parameter = Parameter::where('id', $request['id'])->first();
        $parameter->delete();
        return response()->json(200);
    }



}

?>