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
        $articles = Article::all()->sortByDesc('created_at');
        
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
            $this->deleteOldImg($user_id, $old_img);

            // 変更後の画像ファイル処理
            $file_name    = $this->saveImage($request->file('img'), $user_id);
            $article->img = $file_name;
        }

        $article->save();
        return redirect()->route('articles.index');
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

    // 記事更新時にストレージから旧画像を削除
    private function deleteOldImg(int $user_id, string $old_img): void
    {
        $user_dir = 'images/' . $user_id . '/' . $old_img;
        Storage::disk('public')->delete($user_dir); // 本番環境ではs3に変更する
    }

}
