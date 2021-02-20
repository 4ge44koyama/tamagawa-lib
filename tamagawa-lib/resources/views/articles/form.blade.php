@csrf
<div class="md-form">
    <label>魚種（全角カナで入力）</label>
    <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
</div>
<div class="md-form">
    <label>
        <span class="btn btn-blue-grey btn-sm" style="margin: 0;">
            写真を選ぶ<input type="file" name="img_file" id ="js-img-preview" style="display:none" accept="image/*">
        </span>
    </label>
    <input type="text" id="js-filename-view" class="form-control" readonly="">
</div>
<div class="md-form">
    <label>釣った場所</label>
    <input type="text" name="spot" class="form-control" required value="{{ old('spot') }}">
</div>
<div class="form-group">
    <label>使用した道具・感想など</label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ old('body') }}</textarea>
</div>