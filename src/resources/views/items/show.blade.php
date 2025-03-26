@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid border">
            @if($item->status === 'sold')
                <span class="badge bg-danger position-absolute m-2">SOLD</span>
            @endif
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $item->title }}</h2>
            <p class="text-muted">ブランド名: {{ $item->brand ?? '未設定' }}</p>
            <h4 class="text-danger">¥{{ number_format($item->price) }} <small class="text-muted">(税込)</small></h4>

            <div class="d-flex align-items-center my-3">
                <span class="me-3">⭐ {{ $item->likes->count() }}</span>
                <span>💬 {{ $item->comments->count() }}</span>
            </div>

            @if($item->status !== 'sold')
                <a href="{{ route('checkout', ['item_id' => $item->id]) }}" class="btn btn-danger w-100 mb-4">購入手続きへ</a>
            @else
                <p class="text-danger fw-bold">この商品は売り切れです。</p>
            @endif

            <h5>商品説明</h5>
            <p>{{ $item->description }}</p>
            <p><strong>カラー:</strong> {{ $item->color ?? '未設定' }}</p>
            <p><strong>商品の状態:</strong> {{ $item->condition }}</p>

            <h5>商品情報</h5>
            <p>
                カテゴリー:
                @foreach ($item->categories as $category)
                    <span class="badge bg-secondary">{{ $category->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <hr class="my-4">

    <div>
        <h4>コメント ({{ $item->comments->count() }})</h4>
        @foreach ($item->comments as $comment)
            <div class="border rounded p-2 mb-2">
                <strong>{{ $comment->user->name }}</strong>
                <p class="mb-0">{{ $comment->comment }}</p>
            </div>
        @endforeach

        @auth
            <form action="{{ route('item.comment', $item->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="商品のコメントを入力"></textarea>
                    @error('comment')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-danger w-100">コメントを送信する</button>
            </form>
        @endauth
    </div>
</div>
@endsection
