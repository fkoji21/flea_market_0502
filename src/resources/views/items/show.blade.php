@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid">
    </div>
    <div class="col-md-6">
        <h3>{{ $item->title }}</h3>
        <p>ブランド: {{ $item->brand ?? 'ブランド不明' }}</p>
        <h4>¥{{ number_format($item->price) }} (税込)</h4>

        <div class="d-flex align-items-center mb-3">
            @if($item->likes->where('user_id', Auth::id())->count())
            <form action="{{ route('item.unlike', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-warning">いいね解除</button>
            </form>
            @else
            <form action="{{ route('item.like', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-warning">いいね</button>
            </form>
            @endif
            </button>
            <span class="ms-3" style="font-size: 1.2rem;">💬 {{ count($item->comments) }}</span>
        </div>

        <!--a href="/purchase/{{ $item->id }}" class="btn btn-danger mb-3">購入手続きへ</a-->
        <a href="{{ route('checkout', ['item_id' => $item->id]) }}" class="btn btn-danger mb-3">購入手続きへ</a>


        <h5>商品説明</h5>
        <p>{{ $item->description }}</p>

        <h5>商品情報</h5>
        <ul>
            <li>カテゴリー: {{ $item->category }}</li>
            <li>商品の状態: {{ $item->condition }}</li>
        </ul>

        <h5>コメント</h5>
        <ul class="list-group mb-3">
            @foreach ($item->comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                </li>
            @endforeach
        </ul>
        @auth
        <form action="{{ route('item.comment', $item->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="comment" rows="3" class="form-control" placeholder="コメントを入力"></textarea>
                @error('comment')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">コメントを送信する</button>
        </form>
        @endauth
    </div>
</div>
@endsection
