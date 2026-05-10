@extends('layouts.app')

@section('title','出品商品編集')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">出品商品編集</h2>

    <form method="POST"
          action="{{ route('products.update', $product->id) }}"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- 商品名 -->
        <div class="mb-3">
            <label class="form-label">商品名</label>

            <input type="text"
                   name="name"
                   value="{{ $product->name }}"
                   class="form-control">
        </div>

        <!-- 価格 -->
        <div class="mb-3">
            <label class="form-label">価格</label>

            <input type="number"
                   name="price"
                   value="{{ $product->price }}"
                   class="form-control">
        </div>

        <!-- 商品説明 -->
        <div class="mb-3">
            <label class="form-label">商品説明</label>

            <textarea name="description"
                      rows="4"
                      class="form-control">{{ $product->description }}</textarea>
        </div>

        <!-- 在庫数 -->
        <div class="mb-3">
            <label class="form-label">在庫数</label>

            <input type="number"
                   name="stock"
                   value="{{ $product->stock }}"
                   class="form-control">
        </div>

        <!-- 商品画像 -->
        <div class="mb-4">

            <label class="form-label">商品画像</label><br>

            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}"
                         width="200"
                         class="img-thumbnail">
                </div>
            @endif

            <input type="file"
                   name="image"
                   class="form-control">
        </div>

        <!-- ボタン -->
        <div class="d-flex gap-2">

            <a href="{{ route('mypage.products.show', $product->id) }}"
               class="btn btn-secondary">
                戻る
            </a>

            <button type="submit"
                    class="btn btn-primary">
                更新
            </button>

        </div>

    </form>

</div>

@endsection