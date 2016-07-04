<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function getContact(){
        $users = User::all();
        return view('contact',['users'=>$users]);
    }
}