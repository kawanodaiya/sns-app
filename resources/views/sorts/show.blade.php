@extends('app')

@section('title', '検索')

@section('content')
<div class="fixed-top">
@include('nav')
@include('articles.select')
</div>
<div class="container select-container-position">
    @if($result)
        @foreach($result as $article)
        @include('articles.card')
        @endforeach
    @endif
</div>
@endsection
