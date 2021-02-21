<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
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
        $article->fish_kind = $request->fish_kind;
        $article->spot      = $request->spot;
        $article->body      = $request->body;
        $article->user_id   = $request->user()->id;

        // 画像の処理
        $fileName           = $this->saveImage($request->file('img'));
        $article->img       = $fileName;

        $article->save();
        return redirect()->route('articles.index'); 
    }

    /**
      * 画像保存用
      * ユーザーidごとに画像用ディレクトリを作成する。
      * 投稿用画像をリサイズして保存する。
      *
      * @param UploadedFile $file アップロードされたアバター画像
      * @return string ファイル名
      */
    private function saveImage(UploadedFile $file,  Article $article): string
    {
        $tempPath = $this->makeTempPath();
        Image::make($file)->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($tempPath);

        // 本番環境ではs3に変更する
        $filePath = Storage::disk('public')
            ->putFile('images', new File($tempPath));

        return basename($filePath);
    }

    /**
      * 画像保存用
      * 一時的なファイルを生成してパスを返す。
      *
      * @return string ファイルパス
      */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);

        return $meta['uri'];
    }

    /**
      * 画像保存用
      * 一時的なファイルを生成してパスを返す。
      *
      * @return string ファイルパス
      */
    private function makeDir(Article $article): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);

        return $meta['uri'];
    }
}
