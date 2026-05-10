<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function update(Request $request)
{
    $user = Auth::user();

    // 保存
    $user->name = $request->name ?? $user->name;
    $user->name_kanji = $request->name_kanji ?? $user->name_kanji; // ← 追加
    $user->name_kana = $request->name_kana ?? $user->name_kana;
    $user->save();

    return redirect()->route('mypage.index')
        ->with('success', '更新しました');
}

    public function edit()
    {
     
     
        $user = Auth::user();

    return view('account.edit', compact('user'));
    }
}
