<div class="container">
    <form method="GET" action="{{ route('articles.search') }}">
        <div class="input-group my-3 mx-auto w-75">
            <div class="w-100 d-flex">
                <div class="form-outline w-100">
                    <input type="search" name="keyword" class="form-control h-100" value="{{ $keyword ?? '' }}" placeholder="全角カナで魚種を検索"/>
                </div>
                <button type="submit" class="btn btn-primary btn-sm m-0 py-0 px-2" style="font-size: x-large;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>