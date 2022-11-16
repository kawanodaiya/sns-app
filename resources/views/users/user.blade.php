<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex flex-row">
            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                <i class="fas fa-user-circle fa-3x"></i>
            </a>
            @if( Auth::id() !== $user->id )
                <follow-button
                class="ml-auto"
                :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                >
                </follow-button>
            @else
            @include('users.user_edit_button')
            @endif
        </div>
        <h2 class="h5 card-title m-0">
            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                {{ $user->name }}
            </a>
        </h2>
    </div>
    <div class="card-body">
        @if ($user->status()->exists())
            @foreach ($user->status as $status)
            @if(Str::before($status->name, ':') != null)
                <span class="ml-1 py-1 px-2 rounded-pill text-white bg-success">{{$status->name}}</span>
            @endif
            @endforeach
        @else
            ステータスの登録がありません
        @endif
    </div>
    <div class="card-body">
        <div class="card-text">
            <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
                フォロー
            </a>
            <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
                フォロワー
            </a>
        </div>
    </div>
</div>
