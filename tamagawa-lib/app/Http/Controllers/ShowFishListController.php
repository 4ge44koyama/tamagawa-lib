<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowFishListController extends Controller
{
    public function __invoke()
    {
        $articles = DB::table('articles');
        $lists = $articles
                ->selectRaw('fish_kind, count(id) as `count`')
                ->groupByRaw('fish_kind')
                ->orderByRaw('fish_kind')
                ->get();
        return view('articles.library', compact('lists'));
    }
}
