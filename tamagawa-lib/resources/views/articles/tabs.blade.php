<div class="my-3">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link text-muted {{ $dispLatest ? 'active' : '' }}" 
                href="/"
            >
                最新の投稿
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted {{ $dispLibrary ? 'active' : '' }}" 
                href="{{ route('articles.library') }}"
            >
                図鑑を見る
            </a>
        </li>
    </ul>
</div>
