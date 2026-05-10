@extends('layouts.app')

@section('title','商品詳細')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">商品詳細</h2>

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

    <!-- 会社 -->
    <p>
        <strong>会社：</strong>
        {{ $product->user->company->company_name ?? '未設定' }}
    </p>

    <!-- ❤️お気に入り -->
    <div class="mb-4">
        <button id="favoriteBtn"
            data-product-id="{{ $product->id }}"
            class="btn btn-outline-danger">

            {{ $isFavorite ? '❤️ お気に入り済み' : '♡ お気に入り' }}

        </button>
    </div>

    <!-- ボタン -->
    <div class="d-flex gap-2">

        <a href="{{ route('products.purchase', $product->id) }}"
           class="btn btn-success">
            カートに追加する
        </a>

        <a href="{{ route('products.index') }}"
           class="btn btn-secondary">
            戻る
        </a>

    </div>

</div>

<!-- ❤️切り替え -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const btn = document.getElementById('favoriteBtn');

    btn.addEventListener('click', function () {

        const productId = btn.dataset.productId;

        fetch("{{ route('favorite.toggle') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(response => response.json())
        .then(data => {

            if (data.status === 'added') {
                btn.textContent = '❤️ お気に入り済み';
            } else {
                btn.textContent = '♡ お気に入り';
            }

        })
        .catch(error => {
            console.error('エラー:', error);
        });

    });

});
</script>

@endsection