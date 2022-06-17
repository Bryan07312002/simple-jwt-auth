<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(){
        $this->post = new Post();
    }
    public function index(Request $request){
        $with = explode(',',$request->with);
        if ($with[0] != ''){
            return response()->json([
                'status' => 'success',
                'posts' => Post::with($with)->get(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'posts' => Post::all(),
        ]);
    }

    public function store(Request $request, Post $post){
        $request->validate($post->rules());
        
        if($request->post_id || $request->post_id != null){
            $post->add_comment_number($request->post_id);
            $post->post_id = $request->post_id;
        }

        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->has_img = $request->has_img;
        $post->comment_number = 0;
        $post->like_number = 0;
        $post->retweet_number = 0;
        $post->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show($id,Request $request){
        $with = explode(',',$request->with);
        if($with[0] != ''){
            return response()->json([
                'status' => 'success',
                'posts' => Post::where('id', $id)->with($with)->get(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'post'=> Post::where('id',$id)->with(['comments','retweets','likes'])->get(),
        ]);
    }

    public function update(){
        return response()->json([
            'status' => 'error',
            'message' => 'can not update a post'
        ]);
    }

    public function destroy($id){
        $postDestroy = Post::find($id);
        if(Auth::user()->id != $postDestroy->user_id){
            return response()->json([
                'status' => 'error',
                'message' => 'can not delete another user post'
            ]);
        }

        if($postDestroy->post_id){
            $this->post->sub_comment_number($postDestroy->post_id);
        }
        $postDestroy->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'post deleted'
        ]);
    }
}
