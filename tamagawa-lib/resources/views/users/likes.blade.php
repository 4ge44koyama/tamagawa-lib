@extends('app')

@section('title', $user->name . 'のいいねした記事')

@section('content')
    @include('nav')
    <div class="container">

        <user-card
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            :checkself='@json($user->checkSelf(Auth::user(), $user))'
            :username='@json($user->name)'
            :initial-followings='@json($user->count_followings)'
            :initial-followers='@json($user->count_followers )'
            endpoint="{{ route('users.follow', ['user' => $user]) }}"
        >
        </user-card>

        <ul class="nav nav-tabs nav-justified mt-3">
            <li class="nav-item">
                <a class="nav-link text-muted" href="{{ route('users.show', ['user' => $user]) }}">
                    記事
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted active" href="{{ route('users.likes', ['user' => $user]) }}">
                    いいね
                </a>
            </li>
        </ul>

        @foreach($articles as $article)
            @include('articles.card')
        @endforeach
        
    </div>
@endsection