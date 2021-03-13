<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasArticles ? 'active' : '' }}" 
            href="{{ route('users.show', ['user' => $user]) }}"
        >
            投稿した記事
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{ $hasLikes ? 'active' : '' }}" 
            href="{{ route('users.likes', ['user' => $user]) }}"
        >
            いいねした記事
        </a>
    </li>
</ul>
