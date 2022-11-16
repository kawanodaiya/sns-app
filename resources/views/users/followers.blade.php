@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')

<div class="fixed-top">
@include('nav')
</div>

<div class="container user-container-position">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false])
    @foreach($followers as $person)
        @include('users.person')
    @endforeach
</div>
@endsection
