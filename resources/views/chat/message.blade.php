@extends('app')

@section('title', 'チャットルーム')

@section('content')
<div class="bg-white vh-100">
    @include('nav')
    <div class="d-flex container-position">
        <div class="user col-md-3">
            @foreach($follow_each as $person)
                @include('chat.user')
            @endforeach
        </div>
        <div class="border-end border-dark border-height"></div>
        <div class="chat col-md-9">
            @include('chat.room')
        </div>
    </div>
</div>
@endsection