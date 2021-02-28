@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('nav')

    @include('articles.search')

    <div class="container">
        @foreach($articles as $article)

            @include('articles.card')

        @endforeach
    </div>
@endsection
