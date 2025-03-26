@extends('layouts.app')

@section('title', '商品購入')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4">商品購入</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid mb-3">
            <h4>{{ $item->title }}</h4>
            <p class="fs-5 text-danger">¥{{ number_format($item->price) }}</p>
        </div>
        <div class="col-md-6">
            <form action="/purchase/{{ $item->id }}" method="POST">
                @csrf
                <h5>支払い方法</h5>
                <div class="mb-3">
                    <select name="payment_method" class="form-select" required>
                        <option value="">選択してください</option>
                        <option value="コンビニ払い">コンビニ払い</option>
                        <option value="カード支払い">カード支払い</option>
                    </select>
                    @error('payment_method')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <h5 class="mt-4">配送先</h5>
                @if($address)
                    <p>〒{{ $address->postal_code }}<br>{{ $address->address_line1 }} {{ $address->address_line2 }}</p>
                    <a href="/purchase/address/{{ $item->id }}" class="text-primary">変更する</a>
                @else
                    <p>住所情報が登録されていません。</p>
                    <a href="/purchase/address/{{ $item->id }}" class="text-primary">住所を登録する</a>
                @endif

                <div class="mt-4">
                    <table class="table">
                        <tr>
                            <th>商品代金</th>
                            <td>¥{{ number_format($item->price) }}</td>
                        </tr>
                        <tr>
                            <th>支払い方法</th>
                            <td id="selected-payment">選択なし</td>
                        </tr>
                    </table>
                </div>

                <button type="submit" class="btn btn-danger w-100 mt-3">購入する</button>
            </form>
        </div>
    </div>
</div>

<script>
    // 支払い方法が選択されたら表に反映
    document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
        document.getElementById('selected-payment').textContent = this.value || '選択なし';
    });
</script>
@endsection
