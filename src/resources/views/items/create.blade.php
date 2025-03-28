@extends('layouts.app')

@section('title', '商品出品')

@section('content')
<div class="container-sm mt-4">
    <h2>商品を出品する</h2>
    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image_url" class="form-label">商品画像</label>
            <input type="file" name="image_url" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">商品名</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" rows="4" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">カテゴリー（複数選択可）</label>
            <div class="d-flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <input type="checkbox" class="btn-check" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                <label class="btn btn-outline-danger" for="category{{ $category->id }}">{{ $category->name }}</label>
            @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="condition" class="form-label">商品の状態</label>
            <select name="condition" class="form-select" required>
                <option value="">選択してください</option>
                <option value="新品・未使用">新品・未使用</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">販売価格（円）</label>
            <input type="number" name="price" class="form-control" min="0" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">出品する</button>
    </form>
</div>
@endsection
