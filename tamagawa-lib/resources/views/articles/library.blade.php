@extends('app')

@section('title', '図鑑')

@section('content')
    @include('nav')

    @include('articles.search')

    @include('articles.tabs', ['dispLatest' => false, 'dispLibrary' => true])

    <div class="container">
        <ul class="list-group">
        @foreach($lists as $list)
            <a href="{{ route('articles.search', 
                ['keyword' => $list->fish_kind]) }}"
            >
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $list->fish_kind }}
                    <span class="badge bg-primary rounded-pill">{{ $list->count }}</span>
                </li>
            </a>
        @endforeach
        </ul>
    </div>
@endsection
