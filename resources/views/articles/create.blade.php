@extends('app')

@section('title', '記事投稿')

<div class="fixed-top">
@include('nav')
</div>  

@section('content')
<div class="container container-position">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body pt-0">
                    @include('error_card_list')
                    <div class="card-text">
                        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                            @include('articles.form')
                            <button type="submit" class="btn bg-success text-white btn-block">投稿する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
