<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProductController extends Controller
{
    public function purchase(Request $request, $id)
    {
        $product = Product::find($id);

        $quantity = $request->input('quantity');

        // 在庫チェック
        if ($product->stock < $quantity) {
            return response()->json([
                'message' => '在庫が足りません'
            ], 400);
        }

        // 注文作成
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $product->price * $quantity,
            'product_name' => $product->name,
            'product_description' => $product->description,
            'price' => $product->price,
            'quantity' => $quantity,
        ]);

        // 在庫減らす
        $product->stock -= $quantity;
        $product->save();

        return response()->json([
            'message' => '購入完了',
            'order' => $order
        ]);
    }
}