@extends('app')

@section('title', 'お知らせ')

@section('content')

<div class="fixed-top">
@include('nav')
</div>
<div class="container container-position">
@foreach($notices as $notice)
@include('notices.list')
@endforeach
</div>
@endsection
