<?php
namespace App\Http\Controllers;

use App\Dea;
use App\Equipment;
use App\Experiment;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

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
        $parameters = Parameter::orderBy('created_at', 'desc')->get();
        $equipments = Equipment::orderBy('created_at','desc')->get();
        $experiments = Experiment::where('dea_deg_other','=','DEG')->orderBy('created_at','desc')->get();
        $parameterNames =[[]]; // 2D array to hold parameters for each experiment
        $parameterUnits =[[]];
        for ($i=0; $i<count($experiments);$i++){
            foreach ($experiments[$i]->parameters as $parameter){
                $parameterNames[$i][$parameter->pivot->type_value_index]=$parameter->name;
                $parameterUnits[$i][$parameter->pivot->type_value_index]=$parameter->unit;
            }
        }

        //For attaching a DEG to the Experiment
        $data = DeController::searchDeg(-1,-1,-1,-1,-1);
        $dimensions = $data['dimensions'];
        $configurations = $data['configurations'];
        $materials = $data['materials'];
        $prestretches = $data['prestretches'];
        $layers = $data['layers'];
        $degs = $data['degs'];

        return view('deg-experiment',['page_number'=>$page_number,'parameters'=>$parameters,'equipments'=>$equipments,'experiments'=>$experiments,'parameterNames'=>$parameterNames,'parameterUnits'=>$parameterUnits,'degs'=>$degs,  'dimensions'=>$dimensions,
            'configurations' => $configurations, 'materials'=>$materials, 'prestretches'=>$prestretches, 'layers'=>$layers]);
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
        $experiment->save();

        if ($experiment->dea_deg_other == "DEA"){
            if(isset($request['selected_dea_id'])&&$request['selected_dea_id']!=''){
                $experiment ->dea_id = $request['selected_dea_id'];
            }
            if (isset($request['image'])){
                $file = $request->file('image');
                $filename = 'dea_experiment_'. $experiment->id . '.jpg';
                if ($file){
                    Storage::disk('experiments')->put($filename, File::get($file));
                }
            }
        }elseif ($experiment->dea_deg_other == "DEG"){
            if(isset($request['selected_deg_id'])&&$request['selected_deg_id']!=''){
                $experiment ->deg_id = $request['selected_deg_id'];
            }
            if (isset($request['image'])){
                $file = $request->file('image');
                $filename = 'deg_experiment_'. $experiment->id . '.jpg';
                if ($file){
                    Storage::disk('experiments')->put($filename, File::get($file));
                }
            }
        }

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
        $imageName = "experiment_".$request['experiment_id'].".jpg";
        if (Storage::disk('experiments')->has("dea_".$imageName)){
            Storage::disk('experiments')->delete("dea_".$imageName);
        }
        if (Storage::disk('experiments')->has("deg_".$imageName)){
            Storage::disk('experiments')->delete("deg_".$imageName);
        }
        $experiment->delete();
        return response()->json(200);
    }

    public function postExperimentImage(Request $request){
        $file;
        if (Storage::disk('experiments')->has($request['filename'])){
            $file = Storage::disk('experiments')->get($request['filename']);
            $file = base64_encode($file);
        }else{
            $file = null;
        }
        return new Response($file, 200);
    }
    public function postDeleteExperimentImage(Request $request){
        $filename = $request['filename'];
        //print_r($filename);
        if (Storage::disk('experiments')->has($filename)){
            Storage::disk('experiments')->delete($filename);
        }
        return new Response(200);
    }

    /*
     * DEA/DEG Experiment Common
     */
    //Equipment
    public function postCreateEquipment(Request $request){
        $equipment = new Equipment();
        $equipment->name = $request['equipment_name'];
        $equipment->description = $request['equipment_description'];
        $equipment->type = $request['equipment_type'];
        if ($request['visibility']=='true') {
            $equipment->visible = true;
        }else{
            $equipment->visible = false;
        }

        $equipment -> save();

        if (isset($request['image'])){
            $file = $request['image'];
            $filename = 'equipment_'. $equipment->id . '.jpg';
            if ($file){
                Storage::disk('equipment')->put($filename, File::get($file));
            }
        }
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
        $imageName = "equipment_".$request['id'].".jpg";
        if (Storage::disk('equipment')->has($imageName)){
            Storage::disk('equipment')->delete($imageName);
        }
        $equipment->delete();
        return response()->json(200);
    }

    public function getEquipmentImage($filename){
        $file = Storage::disk('equipment')->get($filename);
        return new Response($file, 200);
    }
    public function postEquipmentDeleteImage(Request $request){
        $filename = $request['filename'];
        if (Storage::disk('equipment')->has($filename)){
            Storage::disk('equipment')->delete($filename);
        }
        return new Response(200);
    }
    public function postEquipmentToggleVisibility(Request $request){
        $equipment = Equipment::where('id', $request['equipmentId'])->first();
        $equipment->visible = !$equipment->visible;
        $equipment->update();

        return response()->json(['visible'=>$equipment->visible],200);
    }

    /*
    /*
    public function postEquipmentImage(Request $request){
        $file;
        if (Storage::disk('equipment')->has($request['filename'])){
            $file = Storage::disk('equipment')->get($request['filename']);
            $file = base64_encode($file);
        }else{
            $file = null;
        }
        return new Response($file, 200);
    }*/
    //Parameter
    public function postCreateParameter(Request $request){
        $parameter = new Parameter();
        $parameter->name = $request['parameter_name'];
        $parameter->unit = $request['parameter_unit'];
        $parameter->description = $request['parameter_description'];
        //$parameter->update();
        $parameter->save();
        return response() -> json(['new_parameter_name'=>$parameter->name, 'new_parameter_unit'=>$parameter->unit, 'new_parameter_id'=>$parameter->id],200);
    }
    public function postEditParameter(Request $request){
        $parameter = Parameter::where('id', $request['id'])->first();
        $parameter->name = $request['name'];
        $parameter->description = $request['description'];
        $parameter->unit = $request['unit'];
        $parameter->update();
        return response()->json(['new_name' => $parameter->name, 'new_description'=>$parameter->description, 'new_unit'=>$parameter->unit],200);
    }
    public function postDeleteParameter(Request $request){
        $parameter = Parameter::where('id', $request['id'])->first();
        $parameter->delete();
        return response()->json(200);
    }



}

?>