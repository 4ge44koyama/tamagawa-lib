<div class="card mt-3">

    <div class="card-header pt-2 px-2 pb-0" style="font-family: serif;">
        <div class="d-flex justify-content-center">
            <h5 class="card-title text-center w-100">{{ $article->fish_kind }}</h5>
            @if( Auth::id() === $article->user_id )
            <!-- dropdown -->
            <div class="card-text">
                <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route("articles.edit", ['article' => $article]) }}">
                            <i class="fas fa-pen mr-1"></i>記事を更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
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
                                {{ $article->fish_kind }}を削除します。よろしいですか？
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-danger">削除する</button>
                                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal -->
            @endif
        </div>

        <h6 class="card-subtitle mb-2 text-muted text-right">
            <span class="small">投稿者: </span>{{ $article->user->name }}<span class="small"> さん</span>
        </h6>
    </div>

    <div class="bg-image my-0 mx-auto">
        <img src="/storage/images/{{ $article->user_id . '/' .$article->img }}" class="img-fluid" alt="多摩川で釣れた{{ $article->fish_kind }}の画像">
    </div>

    <div class="card-body pt-0 pb-2 mt-4">
        <p class="card-text">
            @if( Route::is('articles.index') )
            {{ mb_strimwidth($article->body, 0, 200, '…', 'UTF-8') }}
            @else
            {!! nl2br(e( $article->body )) !!}
            @endif
        </p>
        <div class="d-flex justify-content-between">
            <div class="card-text">
                <!-- ArticleLike.vue -->
                <article-like
                    :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($article->count_likes)'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('articles.like', ['article' => $article]) }}"
                >
                </article-like>
                <!-- ArticleLike.vue -->
            </div>
            <div class="text-right font-weight-lighter">
                {{ $article->created_at->format('Y/m/d H:i') }} 
            </div>
        </div>
        <div class="text-right">
            @if( Route::is('articles.index') )
            <a href="/articles/{{ $article->id }}">詳細を見る</a>
            @else
            <a href="/">戻る</a>
            @endif
        </div>
    </div>

</div>
