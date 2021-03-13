<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleEditRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    // 投稿一覧画面表示
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at')
                    ->load(['user', 'likes']);
        
        return view('articles.index', ['articles' => $articles]);
    }

    // 新規投稿画面表示
    public function create()
    {
        return view('articles.create'); 
    }

    // 新規投稿保存
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all()); // [fish_kind, spot, body]
        $article->user_id = $request->user()->id;

        // 画像の処理
        $user_id      = $article->user_id;
        $file_name    = $this->saveImage($request->file('img'), $user_id);
        $article->img = $file_name;

        $article->save();
        return redirect()->route('articles.index'); 
    }

    // 投稿編集画面表示
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    // 投稿編集更新処理
    public function update(ArticleEditRequest $request, Article $article)
    {
        $article->fill($request->all()); // [fish_kind, spot, body]
        
        // 画像が変更されている場の処理
        if ($request->file('img')) {

            $user_id = $request->user()->id;
            $old_img = $article->img;

            // 旧画像ファイルをストレージから削除する
            $this->deleteImage($user_id, $old_img);

            // 変更後の画像ファイル処理
            $file_name    = $this->saveImage($request->file('img'), $user_id);
            $article->img = $file_name;
        }

        $article->save();
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $this->deleteImage($article->user_id, $article->img); // 画像ファイルをストレージから削除

        $article->delete(); // DBからレコードを削除
        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    /**
      * 画像保存用
      * ユーザーidごとに画像用ディレクトリを作成する。
      * 投稿用画像をリサイズして保存する。
      *
      * @param UploadedFile $file アップロードされた画像
      * @param int $user_id       投稿ユーザーid
      * @return string ファイル名
      */
    private function saveImage(UploadedFile $file, int $user_id): string
    {
        $temp_path = $this->makeTempPath();
        Image::make($file)->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($temp_path);

        $user_dir  = 'images/' . $user_id;
        $file_path = Storage::disk('public') // 本番環境ではs3に変更する
            ->putFile($user_dir, new File($temp_path));

        return basename($file_path);
    }

    /**
      * 画像保存用
      * 一時的なファイルを生成してパスを返す。
      *
      * @return string ファイルパス
      */
    private function makeTempPath(): string
    {
        $tmp_fp    = tmpfile();
        $meta_data = stream_get_meta_data($tmp_fp);

        return $meta_data['uri'];
    }

    // ストレージから画像ファイルを削除
    private function deleteImage(int $user_id, string $img): void
    {
        $user_dir = 'images/' . $user_id . '/' . $img;
        Storage::disk('public')->delete($user_dir); // 本番環境ではs3に変更する
    }

    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

}
