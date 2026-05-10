@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">お問い合わせフォーム</h2>

    <form method="POST" action="#">

        @csrf

        <!-- 名前 -->
        <div class="mb-3">
            <label class="form-label">名前</label>
            <input type="text"
                   name="name"
                   class="form-control">
        </div>

        <!-- メールアドレス -->
        <div class="mb-3">
            <label class="form-label">メールアドレス</label>
            <input type="email"
                   name="email"
                   class="form-control">
        </div>

        <!-- お問い合わせ内容 -->
        <div class="mb-4">
            <label class="form-label">お問い合わせ内容</label>
            <textarea name="message"
                      rows="6"
                      class="form-control"></textarea>
        </div>

        <!-- ボタン -->
        <!-- ボタン -->
        <div class="d-flex gap-2">

            <button type="submit"
                    class="btn btn-primary">
                送信
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                戻る
            </a>

         </div>

    </form>

</div>

@endsection