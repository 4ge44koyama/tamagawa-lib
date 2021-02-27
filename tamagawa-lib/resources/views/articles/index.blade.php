@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')

    @include('articles.search')

    <div class="container">
        @foreach($articles as $article)
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



                <div class="bg-image hover-overlay ripple my-0 mx-auto" data-mdb-ripple-color="light">
                    <img src="/storage/images/{{ $article->user_id . '/' .$article->img }}" class="img-fluid" alt="多摩川で釣れた{{ $article->fish_kind }}の画像">
                    <a href="#">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                    </a>
                </div>

                <div class="card-body pt-0 pb-2 mt-4">
                    <p class="card-text">
                        {!! nl2br(e( $article->body )) !!}
                    </p>
                    <div class="text-right font-weight-lighter">
                        {{ $article->created_at->format('Y/m/d H:i') }} 
                    </div>
                    <div class="text-right">
                        <a href="#" class="">詳細を見る</a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
