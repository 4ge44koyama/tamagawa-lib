@csrf
<div class="md-form">
    <label>魚種（全角カナで入力）</label>
    <input type="text" name="fish_kind" class="form-control" required value="{{ old('fish_kind') }}">
</div>
<div>
    <label class="mb-0">
        <span class="btn btn-blue-grey btn-sm" style="margin: 0; padding: 4px;">
            写真を選ぶ<input type="file" name="img" id="js-img-preview" style="display:none" required>
        </span>
    </label>
    <div class="md-form pt-0" style="margin: 0;">
        <input type="text" id="js-filename-view" class="form-control pt-0" readonly="">
    </div>
</div>
<div class="md-form">
    <label>釣った場所</label>
    <input type="text" name="spot" class="form-control" required value="{{ old('spot') }}">
</div>
<div class="form-group">
    <label>使用した道具・感想など</label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ old('body') }}</textarea>
</div>