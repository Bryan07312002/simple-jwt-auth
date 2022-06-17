<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index(){}

    public function store(Request $request,Like $like){
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        $like->add_like_number($request->post_id);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show(){}

    public function update(){}

    public function delete($id){
        $likeDestroy = Like::find($id);
        if(Auth::user()->id != $likeDestroy->user_id){
            return response()->json([
                'status' => 'error',
                'message' => 'can not delete another user post'
            ]);
        }

        if($likeDestroy->post_id){
            $this->post->sub_like_number($likeDestroy->post_id);
        }
        $likeDestroy->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'post deleted'
        ]);
    }
}
