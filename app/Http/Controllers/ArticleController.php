<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Follow;
use App\Models\Status;
use App\Models\StatusUser;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }
    
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at')->load('user');
        $statuses = Status::all();
        $user = Auth::user();

        try{
            if($statuses != null){
                $articles = Article::query()->whereIn('status_name',
                    Auth::user()->status()->pluck('name'))
                    ->orderBy('created_at','desc')->get();
            }
        }catch (\Exception $e){
            return view('articles.index',compact('articles','statuses','user'));
        }

        return view('articles.index',compact('articles','statuses','user'));
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('img_path');

        try{
            if($img){        
                $dir = 'image';
                $file_name = $img->getClientOriginalName();
                $img = InterventionImage::make($img);
                $img->orientate();
                $img->resize(
                    600,
                    null,
                    function ($constraint) {
                        // 縦横比を保持したままにする
                        $constraint->aspectRatio();
                        // 小さい画像は大きくしない
                        $constraint->upsize();
                    }
                );
                $request->file('img_path')->storeAs('public/' . $dir, $file_name);
                $img->save('storage/' . $dir . '/' . $file_name);
                $article->img_path = 'storage/' . $dir . '/' . $file_name;
            }else{
                $article->img_path = 'null';
            }
        }catch (\Exception $e){

            return redirect()->route('articles.index');
        }

        $article->save();
        
        return redirect()->route('articles.index');
    }

    public function create()
    {
        $user = Auth::user();

        return view('articles.create',compact('user'));    
    }

    public function edit(Article $article)
    {
        $user = Auth::user();

        return view('articles.edit',compact('article','user'));    
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('img_path');

        if($img){        
            $dir = 'image';
            $file_name = $img->getClientOriginalName();
            $request->file('img_path')->storeAs('public/' . $dir, $file_name);
            $article->img_path = 'storage/' . $dir . '/' . $file_name;
        }

        $article->save();

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }
    
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
