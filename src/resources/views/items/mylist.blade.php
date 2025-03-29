@extends('layouts.app')

@section('title', 'マイリスト')

@section('content')
<div class="container-sm mt-4">
    <h1>マイリスト（いいねした商品）</h1>
    <div class="row">
        @forelse ($likedItems as $item)
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <img src="{{  $item->image_url }}" class="card-img-top" alt="商品画像">
                    @if ($item->is_sold)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">SOLD</span>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ number_format($item->price) }}円</p>
                        <a href="/item/{{ $item->id }}" class="btn btn-primary @if($item->status === 'sold') disabled @endif">詳細を見る</a>
                    </div>
                </div>
            </div>
        @empty
            <p>まだいいねした商品はありません。</p>
        @endforelse
    </div>

    {{-- ページネーション --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $likedItems->links() }}
    </div>
</div>
@endsection
