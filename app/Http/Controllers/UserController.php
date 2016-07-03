<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function  postSignIn(Request$request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])){
            return redirect()->route('welcome');
        }
        return redirect()->route('welcome');
    }





    public function getLogout(){

        Auth::logout();
        return redirect()->route('welcome');
    }


/*
    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email|unique:users',
            'first_name'=>'required|max:120',
            'password'=>'required|min:4'
        ]);

        $email = $request['email'];
        $first_name = $request['first_name'];
        $password =bcrypt($request['password']);


        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->password = $password;

        $user->save();



       return redirect()->back();
    }
*/

    public function getAccount(){
        return view('account', ['user' => Auth::user()]);
    }
    public function postSaveAccount(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:120'
        ]);
        //

        //
        $user = Auth::user();
        $user->first_name = $request['first_name'];
        $user->update();  //overriding old one, so not create()
        $file = $request->file('image'); //
        $filename = $request['first_name'].'-'. $user->id . '.jpg';
        print_r($file.$filename);
        if ($file){
            print_r($file);  
            Storage::disk('local')->put($filename, File::get($file));
            print_r('stored');
        }

        return redirect()->route('account');
    }

    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        print_r($file.'here');
        return new Response($file, 200);
    }
}
?>