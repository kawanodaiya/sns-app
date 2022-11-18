<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\StatusUser;
use App\Models\Notice;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
                ->load(['articles.user', 'articles.likes', 'articles.status']);

        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
                ->load(['likes.user', 'likes.likes', 'likes.status']);

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
                ->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
                ->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        $notice = new Notice();
        $notice->serve_user_id = $user->id;
        $notice->post_user_id = $request->user()->id;
        $user_name = User::where('id', $notice->post_user_id)->first();
        $notice->message = $user_name->name ."さんがフォローしました。";
        $notice->save();

        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        $articles = $user->articles->sortByDesc('created_at');
        return view('users.user_edit', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255',],
            'status' => ['nullable','string',],
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $input_status = $request->get('status0').$request->get('status_name0').','.
                        $request->get('status1').$request->get('status_name1').','.
                        $request->get('status2').$request->get('status_name2').','.
                        $request->get('status3').$request->get('status_name3').','.
                        $request->get('status4').$request->get('status_name4');
        $status_check = substr_count($input_status, ":");

        if ($status_check < 6) {
            $status_ids = [];
            $statuses = $input_status;
            $statuses = explode(',', $input_status);
            foreach ($statuses as $status) {
                $status = Status::updateOrCreate(
                    [
                        'name' => $status,
                    ]
                );
                $status_ids[] = $status->id;
            }
            $user->status()->sync($status_ids);
        }else{
            $notice = new Notice();
            $notice->serve_user_id = $request->user()->id;
            $notice->post_user_id = $request->user()->id;
            $notice->message = "statusの作成に失敗しました。categoryに:は使うことができません。";
            $notice->save();

            return redirect('/');
        }

        return redirect('/');
    }

    public function notice()
    {
        return view('notices.show');
    }
}
