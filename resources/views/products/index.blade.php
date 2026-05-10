@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">商品一覧</h2>

    <!-- 🔍 検索フォーム -->
    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">

        <!-- 商品名 -->
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control"
                   placeholder="商品名を入力"
                   value="{{ request('keyword') }}">
        </div>

        <!-- 最低価格 -->
        <div class="col-md-2">
            <input type="number" name="min_price" class="form-control"
                   placeholder="最低価格"
                   value="{{ request('min_price') }}">
        </div>

        <!-- ～ -->
        <div class="col-md-1 text-center align-self-center">
        ~
        </div>

        <!-- 最高価格 -->
        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control"
                   placeholder="最高価格"
                   value="{{ request('max_price') }}">
        </div>

        <!-- 検索ボタン -->
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">
                検索
            </button>
        </div>

    </form>

    <!-- 📦 商品一覧 -->
    @if ($products->isEmpty())
        <p class="text-muted">商品がありません。</p>
    @else

    <table class="table table-bordered align-middle">

        <thead class="table-light">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->description }}</td>

                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="80">
                    @else
                        なし
                    @endif
                </td>

                <td>¥{{ number_format($product->price) }}</td>

                <td>
                    <a href="{{ route('products.show', $product->id) }}"
                       class="btn btn-primary btn-sm">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>

@endsection