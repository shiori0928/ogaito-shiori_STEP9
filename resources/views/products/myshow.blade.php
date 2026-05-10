@extends('layouts.app')

@section('title','出品商品詳細')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">出品商品詳細</h2>

    <!-- 商品名 -->
    <p class="mb-3">
        <strong>商品名：</strong><br>
        {{ $product->name }}
    </p>

    <!-- 説明 -->
    <p class="mb-3">
        <strong>説明：</strong><br>
        {{ $product->description }}
    </p>

    <!-- 画像 -->
    <p>
        <strong>画像：</strong><br>

        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 width="200"
                 class="img-thumbnail">
        @else
            画像なし
        @endif
    </p>

    <hr>

    <!-- 金額 -->
    <p>
        <strong>金額：</strong>
        ¥{{ number_format($product->price) }}
    </p>

    <!-- ボタン -->
    <div class="d-flex gap-2 mt-4">

        <!-- 編集 -->
        <a href="{{ route('products.edit', $product->id) }}"
           class="btn btn-primary">
            編集
        </a>

        <!-- 削除 -->
        <form action="{{ route('products.destroy', $product->id) }}"
              method="POST"
              onsubmit="return confirm('本当に削除しますか？');">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-danger">
                削除する
            </button>

        </form>

        <!-- 戻る -->
        <a href="{{ route('mypage.index') }}"
           class="btn btn-secondary">
            戻る
        </a>

    </div>

</div>

@endsection