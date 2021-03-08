@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
    @include('nav')
    <div class="container">

        <user-card
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            :check-self='@json($user->checkSelf(Auth::user(), $user))'
            :user-name='@json($user->name)'
            :initial-followings='@json($user->count_followings)'
            :initial-followers='@json($user->count_followers )'
            show-user-path="{{ route('users.show', ['user' => $user]) }}"
            followings-path="{{ route('users.followings', ['user' => $user]) }}"
            followers-path="{{ route('users.followers', ['user' => $user]) }}"
            endpoint="{{ route('users.follow', ['user' => $user]) }}"
        >
        </user-card>
        
        @foreach($followers as $person)
            @include('users.person')
        @endforeach
    </div>
@endsection
