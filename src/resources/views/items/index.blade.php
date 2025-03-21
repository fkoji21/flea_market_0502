@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="container-sm mt-4">
    <h1>おすすめ商品</h1>
    <div class="row">
        @foreach ($items as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $item->image_url }}" class="card-img-top" alt="商品画像">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ number_format($item->price) }}円</p>
                        <a href="/item/{{ $item->id }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- ページネーション（検索キーワード引き継ぎあり） --}}
        <div class="d-flex justify-content-center">
            {{ $items->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
