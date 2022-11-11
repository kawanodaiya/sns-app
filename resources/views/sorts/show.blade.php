@extends('app')

@section('title', '検索')

@section('content')
@include('nav')
<div class="container">
    @include('articles.select')
    @if($result)
        @foreach($result as $article)
        @include('articles.card')
        @endforeach
    @endif

</div>
@endsection
