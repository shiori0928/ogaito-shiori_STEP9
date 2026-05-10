@extends('layouts.app')

@section('title', 'マイページ')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">マイページ</h2>

    <!-- アカウント編集 -->
    <div class="mb-4">
        <a href="{{ route('account.edit') }}" class="btn btn-primary btn-sm">
            アカウント編集
        </a>
    </div>

    <!-- ユーザー情報 -->
    <table class="table table-bordered">
    <tr>
        <th>ユーザー名</th>
        <td>{{ $user->name }}</td>
        <th>名前</th>
        <td>{{ $user->name_kanji ?? '未設定' }}</td>
    </tr>
    <tr>
        <th>Eメール</th>
        <td>{{ $user->email }}</td>
        <th>カナ</th>
        <td>{{ $user->name_kana }}</td>
    </tr>
    </table>

    <!-- 出品商品 -->
    <h4 class="mt-5 mb-3">出品商品</h4>

    <div class="text-end mb-2">
        <a href="{{ route('products.create') }}" class="btn btn-success btn-sm">
            新規登録
        </a>
    </div>

    @if ($products->isEmpty())
        <p class="text-muted">まだ商品は登録されていません。</p>
    @else
        <table class="table table-striped">
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>料金</th>
                <th></th>
            </tr>

            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>¥{{ number_format($product->price) }}</td>
                <td>
                    <a href="{{ route('mypage.products.show', $product->id) }}"
                       class="btn btn-info btn-sm">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    @endif

    <!-- 購入商品 -->
    <h4 class="mt-5 mb-3">購入した商品</h4>

    @if ($orders->isEmpty())
        <p class="text-muted">購入した商品はまだありません。</p>
    @else
        <table class="table table-striped">
            <tr>
                <th>商品名</th>
                <th>商品説明</th>
                <th>料金</th>
                <th>個数</th>
            </tr>

            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->product_description }}</td>
                <td>¥{{ number_format($order->price) }}</td>
                <td>{{ $order->quantity }}</td>
            </tr>
            @endforeach
        </table>
    @endif

</div>

@endsection