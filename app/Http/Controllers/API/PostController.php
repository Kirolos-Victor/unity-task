<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    public function index()
    {
        $data=Post::paginate(10);
        return response()->json($data);
    }


    public function store(Request $request)
    {
        $validator=Validator()->make($request->all(),[
            'title'=>'required',
            'body'=>'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        Post::create($request->all());

    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        $validator=Validator()->make($request->all(),[
            'title'=>'required',
            'body'=>'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $post->update([
           'title'=>$request->title,
            'body'=>$request->body,
        ]);
    }


    public function destroy(Post $post)
    {
        $post->delete();
    }
}
