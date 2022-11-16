<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Follow;
use App\Models\Status;
use App\Models\StatusUser;
use Illuminate\Http\Request;
use Auth;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function search(Request $request)
    {
        $articles = Article::all()->sortByDesc('created_at');
        $statuses = Status::all();
        $user = Auth::user();

        return view('sorts.show',compact('articles','statuses','user'));    
    }

    public function sort(Request $request,string $name)
    {
        $articles = Article::all()->sortByDesc('created_at');
        $statuses = Status::all();
        $user = Auth::user();

        $status_name = $request->input('status_name');
        $search_text = $search_text1 = $request->input('search_text');
        
        $query = Article::query();

        if ($status_name != null) {
            if ($search_text == null){
                $result = $query->where('status_name', $status_name)->orderBy('created_at','desc')->get();
            }else{
                $result = $query->where('status_name', $status_name)
                        ->where(function($query)use($search_text,$search_text1){
                            $query->orWhere('title','like','%'.$search_text.'%')
                                ->orWhere('body','like','%'.$search_text1.'%');
                        })->orderBy('created_at','desc')->get();
            }
        }elseif($status_name == null){
            if ($search_text == null){
                $result = $query->orderBy('created_at','desc')->get();
            }else{
                $result = $query->where(function($query)use($search_text,$search_text1){
                        $query->orWhere('title','like','%'.$search_text.'%')
                            ->orWhere('body','like','%'.$search_text1.'%');
                        })->orderBy('created_at','desc')->get();
            }
        }

        if ($status_name == "フォロー" && $search_text == null) {
            $user = User::where('name', $name)->first();
            if ($search_text == null){
                $result = Article::query()->whereIn('user_id',
                        Auth::user()->followings()->pluck('followee_id'))
                        ->orderBy('created_at','desc')->get();
            }else{
                $result = Article::query()->whereIn('user_id',
                        Auth::user()->followings()->pluck('followee_id'))
                        ->where(function($query)use($search_text,$search_text1){
                            $query->orWhere('title','like','%'.$search_text.'%')
                                ->orWhere('body','like','%'.$search_text1.'%');
                        })->orderBy('created_at','desc')->get();
            }
        }

        return view('sorts.show',
        compact('articles','statuses','user','status_name',
                'result','search_text'));    
    }
}