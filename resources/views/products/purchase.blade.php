@extends('layouts.app')

@section('title','購入画面')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">購入画面</h2>

    <p>
        <strong>商品名：</strong>
        {{ $product->name }}
    </p>

    <p>
        <strong>説明：</strong><br>
        {{ $product->description }}
    </p>

    <!-- 商品画像 -->
    <div class="mb-3">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 width="200"
                 class="img-thumbnail">
        @else
            画像なし
        @endif
    </div>

    <hr>

    <p>
        <strong>金額：</strong>
        ¥{{ number_format($product->price) }}
    </p>

    <p>
        <strong>残り：</strong>
        {{ $product->stock }}
    </p>

    <p>
        <strong>会社：</strong>
        {{ $product->user->company->company_name ?? '未設定' }}
    </p>

    <hr>

    <!-- エラーメッセージ -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($product->stock > 0)

    <form action="{{ route('products.purchase.store', $product->id) }}"
          method="POST">

        @csrf

        <!-- 数量 -->
        <div class="mb-4">

            <label class="form-label">
                数量
            </label>

            <input type="number"
                   name="quantity"
                   min="1"
                   max="{{ $product->stock }}"
                   value="1"
                   class="form-control"
                   style="width:120px;">

        </div>

        <!-- ボタン -->
        <div class="d-flex gap-2">

            <button type="submit"
                    class="btn btn-primary">
                購入する
            </button>

            <a href="{{ route('products.show', $product->id) }}"
               class="btn btn-secondary">
                戻る
            </a>

        </div>

    </form>

    @else

        <p class="text-danger">
            <strong>売り切れです</strong>
        </p>

        <a href="{{ route('products.show', $product->id) }}"
           class="btn btn-secondary">
            戻る
        </a>

    @endif

</div>

@endsection