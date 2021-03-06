<nav class="navbar navbar-expand navbar-dark blue mb-2">

    <a class="navbar-brand" href="/">多摩川釣り図鑑</a>

    <ul class="navbar-nav ml-auto">

        @guest
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <button class="dropdown-item" type="button" onclick="location.href='{{ route('register') }}'">
                    ユーザー登録
                </button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item" type="button" onclick="location.href='{{ route('login') }}'">
                    ログイン
                </button>
            </div>
        </li>
        @endguest

        @auth
        <li class="nav-item">
            <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
        </li>
        @endauth

        @auth
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show", ["user" => Auth::user()]) }}'">
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
