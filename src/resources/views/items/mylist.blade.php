@extends('layouts.app')

@section('title', 'マイリスト')

@section('content')
<div class="container-sm mt-4">
    <h1>マイリスト（いいねした商品）</h1>
    <div class="row">
        @forelse ($likedItems as $item)
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
            {{-- ページネーション（検索キーワード引き継ぎあり） --}}
            <div class="d-flex justify-content-center">
                {{ $likedItems->appends(request()->query())->links() }}
            </div>
        @empty
            <p>まだいいねした商品はありません。</p>
        @endforelse
    </div>
</div>
@endsection
