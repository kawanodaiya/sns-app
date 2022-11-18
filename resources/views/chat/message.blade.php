@extends('app')

@section('title', 'チャットルーム')

@section('content')

<div class="fixed-top">
@include('nav')
</div>

<div class="d-flex container-position">
    <div class = "user col-md-3 user-scroll-type-phone pc">
        <ul class="mt-0 mb-0 pl-0">
            @foreach($follow_each as $person)
                @include('chat.user')
            @endforeach
        </ul>
    </div>
    <div class="border-end border-dark border-height pc"></div>
    <div class="chat col-md-9 mt-3">
        @include('chat.room')
    </div>
</div>
@endsection