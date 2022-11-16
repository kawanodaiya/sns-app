@extends('app')

@section('title', 'チャットルーム一覧')

@section('content')

<div class="fixed-top">
@include('nav')
</div>

<div class="bg-white vh-100">
    <div class="d-flex container-position">
        <div class="user col-md-3 mt-3">
            @foreach($follow_each as $person)
                @include('chat.user')
            @endforeach
        </div>
        <div class="chat col-md-9">
        </div>
    </div>
</div>
@endsection