@csrf
<div class="md-form">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">
        {{ $article->body ?? old('body') }}
    </textarea>
    <div class="img">
        <div class="img_input">
            <input type="file" name="img_path">
        </div>
        <div class="img_output">
        @if(Request::is('*/edit'))
            @if ($article->img_path != null)
                <img src="{{ url($article->img_path) }}">
            @endif
        @endif
        </div>
    </div>
    <div class="form-group flex-fill">
        <select name="status_name" class="form-control">
        @auth
        @if ($user->status()->exists())
            @foreach ($user->status as $status)
            @if(Str::before($status->name, ':') != null)
            <option style="margin-left: 5px;"
            @if(Request::is('*/edit'))
            @if($article->status_name == $status->name) selected @endif
            @endif>{{$status->name}}</option>
            @endif
            @endforeach
        @endif
        @endauth
        </select>
    </div>
</div>
