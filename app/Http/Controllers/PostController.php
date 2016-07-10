<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getProgressPublic(){
        $posts = Post::where('type','public')->orderBy('created_at','desc')->get();
        return view('progress-pub',['posts'=>$posts]);
    }
    public function getProgressDea(){
        $posts = Post::where('type','dea')->orderBy('created_at','desc')->get();
        return view('progress-dea',['posts'=>$posts]);
    }
    public function getProgressDeg(){
        $posts = Post::where('type','deg')->orderBy('created_at','desc')->get();
        return view('progress-deg',['posts'=>$posts]);
    }

    //Logic to create post
    public function postCreatePost(Request $request)
    {
        //validation
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $post->type = $request['post-type'];

        //

        //

        if ($request['post_for']!=""){
            $post->post_for = $request['post_for'];
        }

        $message = 'There was an error';
        if ($request->user()->posts()->save($post)){ //key line to store post in posts, which is also related to that user
            $message = 'post successfully created';
        }
        return redirect()->back()->with(['message' => $message]);
    }


    public function getDeletePost($post_id){
        $post = Post::where('id', $post_id)->first();  //find($post_id) == where('id', $post_id)

        $post->delete();
        return redirect()->back()->with(['message'=>'successfully deleted']);
    }

    public function postEditPost(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request['postId']);  //Post instance from database
        $post -> body = $request['body'];
        $post ->update();
        return response() -> json(['new_body' => $post->body],200);
    }



}

?>