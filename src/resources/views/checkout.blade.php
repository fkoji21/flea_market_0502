@extends('layouts.app')

@section('content')
<div class="container">
    <h2>決済確認</h2>
    <p>商品名: {{ $item->title }}</p>
    <p>金額: {{ number_format($item->price) }} 円</p>

    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <button type="submit" class="btn btn-primary">カードで支払う</button>
    </form>
</div>
@endsection
