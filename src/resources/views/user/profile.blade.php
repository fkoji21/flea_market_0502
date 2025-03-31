@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="container-sm mt-4">
    <h2>マイページ</h2>
    <div class="card mb-4">
        <div class="card-body d-flex">
            <img src="{{ $user->image_url ?? 'https://placehold.jp/100x100.png' }}" alt="プロフィール画像" class="rounded-circle me-3" width="100" height="100">
            <div>
                <h4>{{ $user->name }}</h4>
                <p>メール: {{ $user->email }}</p>
                <a href="/mypage/profile" class="btn btn-secondary mt-2">プロフィールを編集する</a>
            </div>
        </div>
    </div>

    <!-- タブ -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $tab === 'buy' ? 'active' : '' }}" href="/mypage?tab=buy">購入履歴</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab === 'sell' ? 'active' : '' }}" href="/mypage?tab=sell">出品商品一覧</a>
        </li>
    </ul>

    @if ($tab === 'buy')
        <h4>購入した商品一覧</h4>
        <div class="row">
            @forelse ($purchasedItems as $item)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p>¥{{ number_format($item->price) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>購入履歴はありません。</p>
            @endforelse
        </div>
    @elseif ($tab === 'sell')
        <h4>出品した商品一覧</h4>
        <div class="row">
            @forelse ($soldItems as $item)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p>¥{{ number_format($item->price) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>出品履歴はありません。</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
