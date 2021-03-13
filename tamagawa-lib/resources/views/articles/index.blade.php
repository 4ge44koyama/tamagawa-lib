@extends('app')

@section('title', '記事一覧')

@section('content')
    <div class="header-fixed" style="position: sticky; top: 0; z-index: 2; background-color: white;">
        @include('nav')
        @include('articles.search')
        @include('articles.tabs', ['dispLatest' => true, 'dispLibrary' => false])
    </div>

    <div class="container">
        @foreach($articles as $article)

            @include('articles.card')

        @endforeach
    </div>
@endsection
