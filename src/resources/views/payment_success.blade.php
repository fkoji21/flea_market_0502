<!-- resources/views/payment_success.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>購入が完了しました！</h1>
    <p>ご利用ありがとうございました。</p>
    <a href="{{ route('items.index') }}" class="btn btn-primary mt-3">商品一覧に戻る</a>
</div>
@endsection
