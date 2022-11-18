<nav class="navbar navbar-expand navbar-dark bg-success">

    <a class="navbar-brand" href="/"><i class="fas fa-chess-board mx-1"></i>CAGE</a>

    <ul class="navbar-nav ml-auto">

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
        </li>
        @endguest

        @guest
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
        </li>
        @endguest
        
        @auth
        <li class="nav-item">
            <a class="nav-link" href="{{ route('notices.show') }}">
                <div class="d-flex flex-row align-items-center">
                    <i class="fas fa-bell mr-1 fa-lg phone"></i>
                    <p class="pc my-auto">お知らせ</p>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('chat.rooms') }}">
                <div class="d-flex flex-row align-items-center">
                    <i class="fas fa-comments mr-1 fa-lg phone"></i>
                    <p class="pc my-auto">チャット</p>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('articles.create') }}">
                <div class="d-flex flex-row align-items-center">
                <i class="fas fa-pen mr-1 fa-lg phone"></i>
                    <p class="pc my-auto">投稿</p>
                </div>
            </a>
        </li>
        @endauth
        
        @auth
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
                マイページ
                </button>
                <div class="dropdown-divider"></div>
                <button form="logout-button" class="dropdown-item" type="submit">
                ログアウト
                </button>
            </div>
        </li>
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
        </form>
        <!-- Dropdown -->
        @endauth

    </ul>

</nav>

