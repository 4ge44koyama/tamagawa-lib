@extends('app')

@section('title', $user->name)

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
    </div>
@endsection