@extends('app')

@section('title', $user->name . 'の設定を編集')

@section('content')

<div class="fixed-top">
@include('nav')
</div>

<div class="container user-container-position">
    <form method="POST" action="{{ route('users.update',['name' => $user->name]) }}">
    @csrf
        <div class="user-name md-form pt-2">
            <label class="pt-2">name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="tag">
            <?php
                $i = 0;
                $will = 'will';
                $now = 'now';
                $delay = 'delay';
                $start = 'start';
            ?>
            @if ($user->status()->exists())
            @foreach ($user->status as $status)
            <div class="d-flex flex-row">
                <div class="category md-form flex-fill my-1">
                    <label>category</label>
                    <input type="text" name="status{{$i}}" class="form-control" value="{{ old('name', mb_strstr( $status->name, ':', true)) }}">
                </div>
                <div class="form-group status">
                    <select name="status_name{{$i}}" class="form-control">
                        <option style="margin-left: 5px;" value=":will"
                        @if(Str::after($status->name, ':') == $will) selected @endif>:will</option>
                        <option style="margin-left: 5px;" value=":now"
                        @if(Str::after($status->name, ':') == $now) selected @endif>:now</option>
                        <option style="margin-left: 5px;" value=":delay"
                        @if(Str::after($status->name, ':') == $delay) selected @endif>:delay</option>
                        <option style="margin-left: 5px;" value=":start"
                        @if(Str::after($status->name, ':') == $start) selected @endif>:start</option>
                    </select>
                </div>
                <?php
                    $i++;
                ?>
            </div>
            @endforeach
            @if($i < 5)
                @for($i; $i < 5 ; $i++)
                <div class="d-flex flex-row">
                    <div class="category md-form flex-fill my-1">
                        <label>category</label>
                        <input type="text" name="status{{$i}}" class="form-control">
                    </div>
                    <div class="form-group status">
                        <select name="status_name{{$i}}" class="form-control">
                            <option style="margin-left: 5px;" value=":now">:now</option>
                            <option style="margin-left: 5px;" value=":will">:will</option>
                            <option style="margin-left: 5px;" value=":delay">:delay</option>
                            <option style="margin-left: 5px;" value=":start">:start</option>
                        </select>
                    </div>
                </div>
                @endfor
            @endif
            @else
            @for($i = 0; $i < 5 ; $i++)
            <div class="d-flex flex-row">
                <div class="category md-form flex-fill my-1">
                    <label>category</label>
                    <input type="text" name="status{{$i}}" class="form-control">
                </div>
                <div class="form-group status">
                    <select name="status_name{{$i}}" class="form-control">
                        <option style="margin-left: 5px;" value=":now">:now</option>
                        <option style="margin-left: 5px;" value=":will">:will</option>
                        <option style="margin-left: 5px;" value=":delay">:delay</option>
                        <option style="margin-left: 5px;" value=":start">:start</option>
                    </select>
                </div>
            </div>
            @endfor
            @endif
        </div>
        <button type="submit" class="btn bg-success btn-block text-white mt-5">編集する</button>
    </form>
</div>
@endsection