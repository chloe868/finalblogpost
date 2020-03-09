<?php

namespace App\Http\Controllers;
use App\Model\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($user_id)
    {
        $comment=Comment::orderBy('created_at','desc')->where('user_id',$user_id);
        return CommentResource::collection($comment);
    }

    public function createcomment(Request $request) {
        $comment=$request->isMethod('put')?Comment::findOrFail($request->id):new Comment;
        $comment->id=$request->input('id');
        $comment->user_id=$request->input('user_id');
        $comment->postId=$request->input('postId');
        $comment->commentcontent=$request->input('commentcontent');
        if($comment->save()){
            return response()->json($comment);
        }  
    }

    public function retrievecomment() {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return response()->json($comments); 
    }

    public function deleteComment($id) {
        $comments = Comment::findOrFail($id);
        if($comments->delete()){
            return new CommentResource($comments);
        }
    }

    public function editComment(Request $request) {
        Comment::where('id',$request['id'])->update([
            'commentcontent'=>$request['commentcontent'],
            ]);
    }
}
