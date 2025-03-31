@extends('layouts.app')

@section('title', 'マイリスト')

@section('content')
<div class="container-sm mt-4">
    {{-- タブ風ナビゲーション --}}
    <div class="border-bottom mb-3">
        <ul class="nav border-0">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.index') ? 'active text-primary fw-bold border-bottom border-primary' : 'text-dark' }}"
                   href="{{ route('items.index') }}">
                    おすすめ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('items.mylist') ? 'active text-danger fw-bold border-bottom border-danger' : 'text-dark' }}"
                   href="{{ route('items.mylist') }}">
                    マイリスト
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        @forelse ($likedItems as $item)
            <div class="col-md-4 mb-4">
                <a href="{{ route('items.show', $item->id) }}" class="item-card-link d-block text-center text-decoration-none text-dark">
                    <div class="item-card">
                        <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid mb-2" style="object-fit: cover;">
                        @if ($item->is_sold)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">SOLD</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                        </div>
                    </div>
                </a>
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
