<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Follow;
use App\Models\Status;
use App\Models\StatusUser;
use Illuminate\Http\Request;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }

    public function store(Request $request, Comment $comment)
    {
        $comment->fill($request->all());
        $comment->save();

        return redirect()->route('articles.index');
    }  

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        
        return redirect()->route('articles.index');
    }
}
