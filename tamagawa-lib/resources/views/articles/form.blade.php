@csrf
<div class="md-form">
    <label>魚種（全角カナで入力）</label>
    <input type="text" name="fish_kind" class="form-control" required value="{{ $article->fish_kind ?? old('fish_kind') }}">
</div>
<!-- FileInput.vue -->
<file-input
    :initial-file-name='@json($article->img ?? old("img"))'
    :initial-article-user-id='@json($article->user_id ?? old("user_id"))'
>
</file-input>
<!-- FileInput.vue -->
<div class="md-form">
    <label>釣った場所</label>
    <input type="text" name="spot" class="form-control" required value="{{ $article->spot ?? old('spot') }}">
</div>
<div class="form-group">
    <label>使用した道具・感想など</label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ $article->body ?? old('body') }}</textarea>
</div>