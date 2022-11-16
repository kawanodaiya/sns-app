@extends('app')

@section('title', '記事一覧')

@section('content')

<div class="fixed-top">
@include('nav')
@include('articles.select')
</div>
<div class="container select-container-position">
    @foreach($articles as $article)
    @include('articles.card')
    @endforeach
</div>
@endsection
