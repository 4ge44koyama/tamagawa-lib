@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')
    <div class="container">
        @foreach($articles as $article)
            <div class="card mt-3">
                <div class="card-header d-flex flex-row">
                    <i class="fas fa-user-circle fa-3x mr-1"></i>
                    <div>
                        <div class="font-weight-bold">
                            {{ $article->user->name }} 
                        </div>
                        <div class="font-weight-lighter">
                            {{ $article->created_at->format('Y/m/d H:i') }} 
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-2 mt-4">
                    <h5 class="card-title">{{ $article->fish_kind }}</h5>
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <img src="/storage/images/{{ $article->img }}" class="img-fluid" alt="多摩川で釣れた{{ $article->fish_kind }}の画像">
                        <a href="#">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                        </a>
                    </div>
                    <p class="card-text">
                        {!! nl2br(e( $article->body )) !!}
                    </p>
                    <a href="#" class="">見る</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
