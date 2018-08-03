<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function commentAdd(Request $request){

        $comment = new Comment();

        $comment->comment = $request->input('comment');
        $comment->user_id = $request->input('user_id');
        $comment->user_name = $request->input('user_name');
        $comment->article_id = $request->input('article_id');

        if ($comment->save()) {
         return back()->with('success','Вашкомментарий будет добавлен после проверки модератора!');
        }

        return back()->with('error','Не удалось оставить  комментарий, возможно модератор ограничил вас в этих правах!');
    }
}
