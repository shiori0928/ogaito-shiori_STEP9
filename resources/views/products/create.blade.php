@extends('layouts.app')

@section('title', '商品登録')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">商品登録</h2>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="mb-3">
            <label class="form-label">商品名</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <!-- 価格 -->
        <div class="mb-3">
            <label class="form-label">価格</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <!-- 商品説明 -->
        <div class="mb-3">
            <label class="form-label">商品説明</label>
            <textarea name="description" rows="4" class="form-control"></textarea>
        </div>

        <!-- 在庫 -->
        <div class="mb-3">
            <label class="form-label">在庫数</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <!-- 画像 -->
        <div class="mb-4">
            <label class="form-label">商品画像</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- ボタン -->
        <div class="d-flex gap-2">
            <a href="{{ route('mypage.index') }}" class="btn btn-secondary">
                戻る
            </a>

            <button type="submit" class="btn btn-success">
                登録
            </button>
        </div>

    </form>

</div>

@endsection