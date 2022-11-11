<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\comments;

class TimelineController extends Controller
{
    
    public function showTimelinePage()
    {
        $contents = Comments::latest()->get();  // <--- 追加
        return view('home', compact('contents'));   //resource/views/layouts/app.blade.phpを表示する compact('contents')とすることで、$contentsをビューに送っています。
    }

    public function postComments(Request $request) //ここはあとで実装します。(Requestはpostリクエストを取得するためのものです。)
    {
        $validator = $request->validate([ // これだけでバリデーションできるLaravelすごい！
            'content' => 'max:256', // 必須・文字であること・280文字まで（ツイッターに合わせた）というバリデーションをします（ビューでも軽く説明します。）
        ]);
        Comments::create([ // commentsテーブルに追加
            'user_id' => Auth::user()->id, // Auth::user()は、現在ログインしている人（つまりコメントしたユーザー）
            'name' => Auth::user()->name,
            'content' => $request->content, // コメント内容
        ]);
        return back(); // リクエスト送ったページに戻る（つまり、/timelineにリダイレクトする）
    }
}
