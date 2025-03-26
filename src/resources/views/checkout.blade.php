@extends('layouts.app')

@section('title', '決済確認')

@section('content')
<div class="container mt-5">
    <h2>決済確認</h2>
    <p>商品名: {{ $item->title }}</p>
    <p>金額: {{ number_format($item->price) }} 円</p>

    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">

        <div class="mb-3">
            <label for="payment_method" class="form-label">支払い方法</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="">選択してください</option>
                <option value="クレジットカード" {{ old('payment_method', Auth::user()->payment_method) == 'クレジットカード' ? 'selected' : '' }}>クレジットカード</option>
                <option value="コンビニ払い" {{ old('payment_method', Auth::user()->payment_method) == 'コンビニ払い' ? 'selected' : '' }}>コンビニ払い</option>
                <option value="銀行振込" {{ old('payment_method', Auth::user()->payment_method) == '銀行振込' ? 'selected' : '' }}>銀行振込</option>
            </select>
            @error('payment_method')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger w-100">支払いを確定する</button>
    </form>
</div>
@endsection
