<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class PostController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'title' =>'required|string',
            'content' =>'required|string',
            'react' =>'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);
        $post = Post::create($request->all());
        // $post = Post::create($request->only(['title','content','react','user_id']));
        return response()->json($post,200);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        $response = Gate::inspect('update',$post);
        if( $response->allowed()){
            Post::where('id',$id)->update([
                'title'=> $request->title,
                'content'=>$request->content
            ]);
            return response()->json(['message' => 'Post updated successfully'], 200);
        } else {
            return response()->json(['error' => $response->message()], 403);
        }
    }
}
