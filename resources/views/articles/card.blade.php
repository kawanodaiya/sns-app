<div class="card mt-3">
    <div class="card-body d-flex flex-row">
        <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-3x mr-1"></i>
        </a>
        <div>
            <div class="font-weight-bold">
                <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                    {{ $article->user->name }}
                </a>
            </div>
            <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
        </div>

        @if( Auth::id() === $article->user_id )
        <!-- dropdown -->
        <div class="ml-auto card-text">
            <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                        <i class="fa-lg fas fa-pen mr-1"></i>記事を更新する
                    </a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                        <i class="fa-lg fas fa-trash-alt mr-1"></i>記事を削除する
                    </a>
                </div>
            </div>
        </div>
        <!-- dropdown -->

        <!-- modal -->
        <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            {{ $article->title }}を削除します。よろしいですか？
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->
        @endif

    </div>
    <div class="card-body pt-0">
        <h3 class="card-title">
            <a class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
                {{ $article->title }}
            </a>
        </h3>
        @if(Request::is('articles/*'))
            <div class="card-text">
                {!! nl2br(e($article->body)) !!}
            </div>
            @if($article->img_path != 'null')
                <div class="card-image">
                    <img src="{{ asset($article->img_path) }}">
                </div>
            @endif
        @else
            <div class="card-text">
                タイトルをクリックすると内容が表示されます
            </div>
        @endif
    </div>
    <div class="card-body">
        <span class="ml-1 py-1 px-2 rounded-pill text-white bg-success">{{$article->status_name}}</span>
    </div>

    <div class="card-body pt-0 pb-2 pl-3 d-flex flex-row">
        <div class="card-text">
            <article-like
            :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($article->count_likes)'
            :authorized='@json(Auth::check())'
            endpoint="{{ route('articles.like', ['article' => $article]) }}"
            >
            </article-like>
        </div>
        <div class="pl-3 pt-1">
            <a href="{{ route('articles.show', ['article' => $article]) }}">
            <i class="far fa-comment fa-lg text-dark"></i>
            </a>
        </div>
        <div class="pl-3 pt-1">
            <a href="{{ route('articles.show', ['article' => $article]) }}">
                <i class="far fa-eye fa-lg text-dark"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
    @if(Request::is('articles/*'))
    @foreach ($article->comments as $comment) 
    <div class="d-flex justify-content-between align-items-center">
        <div class="comment">
            <span>
                <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark mr-1">
                    {{ $comment->user->name }}
                </a>
            </span>
            <span>{{ $comment->comment }}</span>
        </div>
        @if ($comment->user->id === Auth::user()->id)
        @method('DELETE')
        <div class="delete-comment">
            <form action="{{ route('comment.destroy', ['comment_id'=>$comment->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link"><i class="fas fa-times text-success"></i></button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
    @endif
    </div>
</div>
@if(Request::is('articles/*'))
<div class="card mt-2">
    <div class="row actions" id="comment-form-post-{{ $article->id }}">
        <form id="new_comment" action="/articles/{{ $article->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post">
            <input name="utf8" type="hidden" value="&#x2713;" />
                {{csrf_field()}} 
            <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
            <input value="{{ $article->id }}" type="hidden" name="article_id" />
            <input class="form-control" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
        </form>
    </div>
</div>
@endif