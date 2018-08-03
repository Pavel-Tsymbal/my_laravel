<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Comment;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(10);
        $count = 0;
        return view('admin.comments.index', ['comments' => $comments, 'count' => $count]);
    }

    public function commentAgree(int $id)
    {
        $comment = Comment::find($id);
        if(!$comment){
            return back()->with('error', 'Комментарий не найден!');
        }
        if ($comment->commentAgree()) {
            return back()->with('success', 'Комментарий опубликован!');
        }
        return back()->with('error', 'Не удалось опубликовать!');
    }

    public function commentDisagree(int $id)
    {
        $comment = Comment::find($id);
        if(!$comment){
            return back()->with('error', 'Комментарий не найден!');
        }
        if ($comment->commentDisagree()) {
            return back()->with('success', 'Комментарий снят с публикации!');
        }
        return back()->with('error', 'Не удалось снять с публикации!');
    }

    public function deleteComment(int $id)
    {
        $comment = Comment::find($id);
        if($comment->delete()){
            return redirect(route('comments'))->with('success', 'Комментарий успешно удален!');
        }
        return redirect(route('comments'))->with('error', 'Не удалось удалить комментарий!');
    }
}
