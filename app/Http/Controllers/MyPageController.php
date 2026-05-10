<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order; // ← これ追加

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 出品商品
        $products = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        // 🔥 購入履歴（これ追加）
        $orders = Order::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('mypage.index', compact('user', 'products', 'orders'));
    }
}