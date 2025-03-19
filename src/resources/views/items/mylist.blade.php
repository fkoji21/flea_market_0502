@extends('layouts.app')

@section('content')
    <h1>マイリスト（いいねした商品）</h1>
    <ul>
        @foreach ($likedItems as $item)
            <li>{{ $item->title }} - ¥{{ $item->price }}</li>
        @endforeach
    </ul>
@endsection
