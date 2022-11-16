@extends('app')

@section('title', 'チャットルーム')

@section('content')

<div class="fixed-top">
@include('nav')
</div>

<div class="bg-white border-height">
    <div class="d-flex container-position chat-height">
        <div class="user col-md-3 mt-3">
            @foreach($follow_each as $person)
                @include('chat.user')
            @endforeach
        </div>
        <div class="border-end border-dark border-height"></div>
        <div class="chat col-md-9 mt-3">
            @include('chat.room')
        </div>
    </div>
</div>
@endsection