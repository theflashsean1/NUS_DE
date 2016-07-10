<?php

namespace App\Http\Controllers;

use App\Dea;
use App\Deg;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends Controller
{
    public function getContact(){
        $users = User::all();
        return view('contact',['users'=>$users]);
    }
    public function getDeaContent(){
        $deas = Dea::where('visible', '1')->get();
        return view('dea-pub',['deas'=>$deas]);
    }


    public function getDegContent(){
        $degs = Deg::where('visible','1')->get();
        return view('deg-pub',['degs'=>$degs]);
    }



    public function getPublicImage($filename){
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }


}