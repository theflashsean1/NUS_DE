<?php
namespace App\Http\Controllers;

use App\Configuration;
use App\Dea;
use App\Deg;
use App\Dimension;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeController extends Controller
{
    public function getDeaDashboard($dimension_id, $configuration_id, $material_id, $prestretch, $layer, $page_number){
        $data = DeController::searchDea($dimension_id,$configuration_id,$material_id,$prestretch,$layer);
        return view('dea-dashboard', ['dimensions'=>$data['dimensions'],'configurations'=>$data['configurations'],'materials'=>$data['materials'],'prestretches'=>$data['prestretches'],'layers'=>$data['layers'], 'deas'=> $data[
        'deas'], 'page_number' => $page_number]);
    }
    //update dea dashboard using search

    public function postSearchDea(Request $request){
            return redirect()->route('deaDashboard',['dimension_id'=>$request['dimension_id'],'configuration_id'=>$request['configuration_id'],
                'material_id'=>$request['material_id'], 'prestretch'=>$request['prestretch'], 'layer'=>$request['layer'], 'page_num'=>2]);
    }


    public static function searchDea($dimension_id, $configuration_id, $material_id, $prestretch, $layer){
        $dimensions = Dimension::orderBy('id','asc')->get();
        $configurations = Configuration::orderBy('id','asc')->get();
        $materials = Material::orderBy('id','asc')->get();
        $prestretches = Dea::distinct()->get(['prestretch']);
        $layers = Dea::distinct()->get(['layer']);

        if ($prestretch==-1){
            $prestretch = '%';
        }
        if ($layer==-1){
            $layer = '%';
        }

        $deas;
        if ($dimension_id!=-1&&$configuration_id!=-1&&$material_id!=-1){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('configuration_id','like',$configuration_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id==-1&&$configuration_id!=-1 &&$material_id!=-1){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('configuration_id','like',$configuration_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id!=-1&&$configuration_id==-1&&$material_id!=-1){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id!=-1&&$configuration_id!=-1&&$material_id==-1){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('configuration_id','like',$configuration_id)
                ->get();
        }else if($dimension_id==-1&&$configuration_id==-1&&$material_id!=-1){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('material_id','like',$material_id)
                ->get();
        }else if(($dimension_id==-1&&$configuration_id!=-1&&$material_id==-1)){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('configuration_id','like',$configuration_id)
                ->get();
        }else if(($dimension_id!=-1&&$configuration_id==-1&&$material_id==-1)){
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->get();
        }else{
            $deas = Dea::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->get();
        }

       return  ['dimensions'=>$dimensions,'configurations'=>$configurations
            ,'materials'=>$materials,'prestretches'=>$prestretches,'layers'=>$layers, 'deas'=>$deas];
    }


    //Logic to create DEA
    public function postCreateDea(Request $request)
    {

        //validation
        //$this->validate($request, [
        //    'body' => 'required|max:1000'
        //]);
        $dea = new Dea();


        if ($request['dimension']!=-1){
            $dea->dimension_id = $request['dimension'];
        }
        if ($request['configuration']!=-1){
            $dea->configuration_id=$request['configuration'];
        }
        if ($request['material']!=-1){
            $dea->material_id=$request['material'];
        }
        if ($request['prestretch']!=-1){
            $dea->prestretch = $request['prestretch'];
        }
        if ($request['layer']!=-1){
            $dea->layer = $request['layer'];
        }
        $message = 'There was an error';

        if($dea -> save()){
            $message = 'DEA successfully created';
        };

        return redirect()->route('deaDashboard',['dimension_id'=>-1,'configuration_id'=>-1
            ,'material_id'=>-1,'prestretch'=>-1,'layer'=>-1,'page_number'=>'2'])->with(['message'=> $message]);
    }


    //logic to delete DEA
    public function postDeleteDea(Request $request){
        $dea = Dea::where('id', $request['deId'])->first();  //find($post_id) == where('id', $post_id)
        $dea->delete();
        return response()->json(200);
    }


    /*
     * DEG Related
     */
    public function getDegDashboard($dimension_id, $configuration_id, $material_id, $prestretch, $layer ,$page_number){
        $data = DeController::searchDeg($dimension_id,$configuration_id,$material_id,$prestretch,$layer);
        return view('deg-dashboard', ['dimensions'=>$data['dimensions'],'configurations'=>$data['configurations'],'materials'=>$data['materials'],
            'prestretches'=>$data['prestretches'],'layers'=>$data['layers'], 'degs'=> $data['degs'], 'page_number' => $page_number]);
    }


    //update deg dashboard using search

    public function postSearchDeg(Request $request){
        return redirect()->route('degDashboard',['dimension_id'=>$request['dimension_id'],'configuration_id'=>$request['configuration_id'],
            'material_id'=>$request['material_id'], 'prestretch'=>$request['prestretch'], 'layer'=>$request['layer'], 'page_num'=>2]);
    }

    public static function searchDeg($dimension_id, $configuration_id, $material_id, $prestretch, $layer){
        $dimensions = Dimension::orderBy('id','asc')->get();
        $configurations = Configuration::orderBy('id','asc')->get();
        $materials = Material::orderBy('id','asc')->get();
        $prestretches = Deg::distinct()->get(['prestretch']);
        $layers = Deg::distinct()->get(['layer']);

        if ($prestretch==-1){
            $prestretch = '%';
        }
        if ($layer==-1){
            $layer = '%';
        }

        $deas;
        if ($dimension_id!=-1&&$configuration_id!=-1&&$material_id!=-1){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('configuration_id','like',$configuration_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id==-1&&$configuration_id!=-1 &&$material_id!=-1){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('configuration_id','like',$configuration_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id!=-1&&$configuration_id==-1&&$material_id!=-1){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('material_id','like',$material_id)
                ->get();
        }else if($dimension_id!=-1&&$configuration_id!=-1&&$material_id==-1){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->where('configuration_id','like',$configuration_id)
                ->get();
        }else if($dimension_id==-1&&$configuration_id==-1&&$material_id!=-1){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('material_id','like',$material_id)
                ->get();
        }else if(($dimension_id==-1&&$configuration_id!=-1&&$material_id==-1)){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('configuration_id','like',$configuration_id)
                ->get();
        }else if(($dimension_id!=-1&&$configuration_id==-1&&$material_id==-1)){
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->where('dimension_id','like',$dimension_id)
                ->get();
        }else{
            $degs = Deg::
            where('prestretch', 'like',strval($prestretch)."%")
                ->where('layer','like', $layer)
                ->get();
        }

        return  ['dimensions'=>$dimensions,'configurations'=>$configurations
            ,'materials'=>$materials,'prestretches'=>$prestretches,'layers'=>$layers, 'degs'=>$degs];
    }



    //Logic to create DEA
    public function postCreateDeg(Request $request)
    {

        //validation
        //$this->validate($request, [
        //    'body' => 'required|max:1000'
        //]);
        $deg = new Deg();


        if ($request['dimension']!=-1){
            $deg->dimension_id = $request['dimension'];
        }
        if ($request['configuration']!=-1){
            $deg->configuration_id=$request['configuration'];
        }
        if ($request['material']!=-1){
            $deg->material_id=$request['material'];
        }
        if ($request['prestretch']!=-1){
            $deg->prestretch = $request['prestretch'];
        }
        if ($request['layer']!=-1){
            $deg->layer = $request['layer'];
        }
        $message = 'There was an error';

        if($deg -> save()){
            $message = 'DEG successfully created';
        };

        return redirect()->route('degDashboard',['dimension_id'=>-1,'configuration_id'=>-1
            ,'material_id'=>-1,'prestretch'=>-1,'layer'=>-1,'page_number'=>'2'])->with(['message'=> $message]);
    }


    //logic to delete DEA
    public function postDeleteDeg(Request $request){
        $dea = Deg::where('id', $request['deId'])->first();  //find($post_id) == where('id', $post_id)
        $dea->delete();
        return response()->json(200);
    }



    /*
     * Following functions are used for adding new parameters for DEA/DEG
     */
    /* Dimension */
    public function postAddDimension(Request $request){
        $dimension = new Dimension();
        $dimension -> name = $request['name'];
        $dimension -> description = $request['description'];
        $dimension -> save();

        return response()->json(['id'=>$dimension->id, 'name'=>$dimension->name, 'description'=>$dimension->description],200);
    }
    public function postEditDimension(Request $request){
        $dimension = Dimension::where('id', $request['id'])->first();
        $dimension->name = $request['name'];
        $dimension->description = $request['description'];
        $dimension->update();
        return response()->json(['new_name' => $dimension->name, 'new_description'=>$dimension->description],200);
    }
    public function postDeleteDimension(Request $request){
        $dimension = Dimension::where('id', $request['id'])->first();
        $dimension->delete();
        return response()->json(200);
    }

    /* Configuration */
    public function postAddConfiguration(Request $request){
        $configuration = new Configuration();
        $configuration->name = $request['name'];
        $configuration->description = $request['description'];
        $configuration-> save();
        return response()->json(['id'=>$configuration->id, 'name'=>$configuration->name, 'description'=>$configuration->description],200);
    }
    public function postEditConfiguration(Request $request){
        $configuration = Configuration::where('id', $request['id'])->first();
        $configuration->name = $request['name'];
        $configuration->description = $request['description'];
        $configuration->update();
        return response()->json(['new_name' => $configuration->name, 'new_description'=>$configuration->description],200);
    }
    public function postDeleteConfiguration(Request $request){
        $configuration = Configuration::where('id', $request['id'])->first();
        $configuration->delete();
        return response()->json(200);
    }

    /* Material */
    public function postAddMaterial(Request $request){
        $material = new Material();
        $material->name = $request['name'];
        $material->description = $request['description'];
        $material->save();
        return response()->json(['id'=>$material->id, 'name'=>$material->name, 'description'=>$material->description],200);
    }
    public function postEditMaterial(Request $request){
        $material = Material::where('id', $request['id'])->first();
        $material->name = $request['name'];
        $material->description = $request['description'];
        $material->update();
        return response()->json(['new_name' => $material->name, 'new_description'=>$material->description],200);
    }
    public function postDeleteMaterial(Request $request){
        $material = Material::where('id', $request['id'])->first();
        $material->delete();
        return response()->json(200);
    }
}


?>