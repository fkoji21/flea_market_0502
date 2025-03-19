@extends('layouts.app')

@section('title', '送付先住所変更')

@section('content')
<div class="container-sm mt-4">
    <h2>住所の変更</h2>
    <form action="/purchase/address/{{ $item_id }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">お名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $address->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">郵便番号</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code) }}" placeholder="例: 123-4567" required>
        </div>
        <div class="mb-3">
            <label for="address_line1" class="form-label">住所</label>
            <input type="text" name="address_line1" class="form-control" value="{{ old('address_line1', $address->address_line1) }}" required>
        </div>
        <div class="mb-3">
            <label for="address_line2" class="form-label">建物名</label>
            <input type="text" name="address_line2" class="form-control" value="{{ old('address_line2', $address->address_line2) }}">
        </div>
        <button type="submit" class="btn btn-danger w-100">更新する</button>
    </form>
</div>
@endsection
