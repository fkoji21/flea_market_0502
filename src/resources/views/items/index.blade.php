@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="container-sm mt-4">
    <h1>おすすめ商品</h1>
    <a href="/mylist" class="btn btn-outline-primary mb-3">マイリストを見る</a>
    <div class="row">
        @foreach ($items as $item)
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <img src="{{ $item->image_url }}" class="card-img-top" alt="商品画像">
                    @if ($item->status === 'sold')
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">SOLD</span>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ number_format($item->price) }}円</p>
                        <a href="/item/{{ $item->id }}" class="btn btn-primary @if($item->status === 'sold') disabled @endif">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- ページネーション --}}
    <div class="d-flex justify-content-center">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>
@endsection
