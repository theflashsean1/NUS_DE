<?php

namespace App\Http\Controllers;

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
        return view('dea-pub');
    }


    public function getDegContent(){
        return view('deg-pub',[]);
    }



    public function getPublicImage($filename){
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }


}