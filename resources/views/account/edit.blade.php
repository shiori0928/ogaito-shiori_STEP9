@extends('layouts.app')

@section('title', 'アカウント編集')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="mb-4">アカウント情報編集</h2>

    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')

        <!-- ユーザー名 -->
        <div class="mb-3">
            <label class="form-label">ユーザー名</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <!-- Eメール -->
        <div class="mb-3">
            <label class="form-label">Eメール</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <!-- 名前（漢字） -->
        <div class="mb-3">
            <label class="form-label">名前</label>
            <input type="text" name="name_kanji" value="{{ $user->name_kanji }}" class="form-control">
        </div>

        <!-- カナ -->
        <div class="mb-4">
            <label class="form-label">カナ</label>
            <input type="text" name="name_kana" value="{{ $user->name_kana }}" class="form-control">
        </div>

        <!-- ボタン -->
        <div class="d-flex gap-2">
            <a href="{{ route('mypage.index') }}" class="btn btn-secondary">
                戻る
            </a>

            <button type="submit" class="btn btn-primary">
                更新
            </button>
        </div>

    </form>

</div>

@endsection