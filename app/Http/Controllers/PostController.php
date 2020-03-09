<?php

namespace App\Http\Controllers;
use App\Model\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($user_id)
    {
        $posts=Post::orderBy('created_at','desc')->where('user_id',$user_id);
        return PostResource::collection($posts);
    }

    public function createpost(Request $request) {
        $post=$request->isMethod('put')?Post::findOrFail($request->post_id):new Post;
        $post->id=$request->input('post_id');
        $post->user_id=$request->input('user_id');
        $post->title=$request->input('title');
        $post->postcontent=$request->input('postcontent');
        if($post->save()){
            return response()->json($post);
        }  
    }

    public function retrieve() {
        $posts = Post::orderBy('created_at', 'desc')->with("comments")->get();
        return response()->json($posts); 
    }

    public function deletePost($id) {
        $posts = Post::findOrFail($id);
        if($posts->delete()){
            return new PostResource($posts);
        }
    }

    public function editPosts(Request $request) {
        Post::where('id',$request['id'])->update([
            'title'=>$request['title'],
            'postcontent'=>$request['postcontent'],
            ]);
    }
    

}