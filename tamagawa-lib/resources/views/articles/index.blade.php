@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')

    @include('articles.search')

    @include('articles.tabs', ['dispLatest' => true, 'dispLibrary' => false])

    <div class="container">
        @foreach($articles as $article)

            @include('articles.card')

        @endforeach
    </div>
@endsection
