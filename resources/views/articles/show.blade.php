@extends('app')

@section('title', '記事詳細')

@section('content')

<div class="fixed-top">
@include('nav')
</div>  

<div class="container card-container-position">
    @include('articles.card')
</div>
@endsection
