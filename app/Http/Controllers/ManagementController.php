<?php
namespace App\Http\Controllers;

use App\Configuration;
use App\Dimension;
use App\Material;

use App\Equipment;
use App\Parameter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ManagementController extends Controller
{
    public function getManagementDashboard(){
        $dimensions = Dimension::all();
        $configuraitons = Configuration::all();
        $materials = Material::all();
        $equipment = Equipment::all();
        $parameters = Parameter::all();
        return view('management',['configurations'=>$configuraitons, 'dimensions'=>$dimensions, 'materials'=>$materials,
        'equipment'=>$equipment, 'parameters'=>$parameters]);
    }

}
?>