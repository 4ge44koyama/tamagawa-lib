<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $articles = $user->articles->sortByDesc('created_at')
            ->load(['user', 'likes']);
        return view('users.show', compact('user', 'articles'));
    }

    public function likes(User $user)
    {
        $articles = $user->likes->sortByDesc('created_at')
            ->load(['user', 'likes']);
        return view('users.likes', compact('user', 'articles'));
    }

    public function followings(User $user)
    {
        $followings = $user->followings->sortByDesc('created_at')
            ->load('followers');
        return view('users.followings', compact('user', 'followings'));
    }
    
    public function followers(User $user)
    {
        $followers = $user->followers->sortByDesc('created_at')
            ->load('followers');
        return view('users.followers', compact('user', 'followers'));
    }

    public function follow(Request $request, int $user_id): array
    {
        $user = User::find($user_id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        $followers = $user->count_followers;
        return ['followers' => $followers];
    }
    
    public function unfollow(Request $request, int $user_id): array
    {
        $user = User::find($user_id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $followers = $user->count_followers;
        return ['followers' => $followers];
    }
}
