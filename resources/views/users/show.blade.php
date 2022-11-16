@extends('app')

@section('title', $user->name)

@section('content')
<div class="fixed-top">
@include('nav')
</div>
<div class="container user-container-position">
    @include('users.user')
    @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false])
    @foreach($articles as $article)
        @include('articles.card')
    @endforeach
</div>
@endsection
