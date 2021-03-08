<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class SearchArticleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            
            $keyword = $request->input('keyword');
            $escaped = '%' . $this->escape($keyword) . '%';

            $query = Article::query();
            $query->where(function ($query) use ($escaped) {
                $query->where('fish_kind', 'LIKE', $escaped);
                $query->orWhere('body', 'LIKE', $escaped);
            });

            // 検索条件に該当する投稿を取得
            $articles = $query->orderBy('created_at', 'DESC')->get()
                        ->load(['user', 'likes']);

            // ビューはTOPと同じ
            return view('articles.index', compact('articles', 'keyword'));
        }

        // キーワード入力が空欄だった場合
        return redirect()->route('articles.index');
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'], 
            ['\\\\', '\\%', '\\_'], 
            $value
        );
    }
}
