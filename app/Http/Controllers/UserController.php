<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{    
    public function index(Request $request){
        $with = explode(',',$request->with);
        if ($with[0] != ''){
            return response()->json([
                'status' => 'success',
                'users' => User::with($with)->get(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'users' => User::all(),
        ]);
    }

    public function store(Request $request){
        
    }

    public function show($id, Request $request){
        $with = explode(',',$request->with);
        if($with[0] != ''){
            return response()->json([
                'status' => 'success',
                'users' => User::where('id', $id)->with($with)->get(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'user'=> User::where('id',$id)->get()
        ]);
    }

    public function update(){

    }

    public function destroy($id){
        $userDestroy = User::find($id);
        $userDestroy->delete();
    }
}
