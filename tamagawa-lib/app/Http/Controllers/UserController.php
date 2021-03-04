<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
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
