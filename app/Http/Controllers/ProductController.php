<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Order;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();
    
     // 👇 これ追加（自分以外）
    $query->where('user_id', '!=', auth()->id());

    // 商品名検索
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // 最低価格
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    // 最高価格
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->get();

    return view('products.index', compact('products'));
}

    public function show(Product $product)
    {
        $isFavorite = false;

        if (Auth::check()) {
            $isFavorite = Favorite::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('products.show', compact('product', 'isFavorite'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('mypage.index');
    }

    public function myShow(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.myshow', compact('product'));
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('mypage.products.show', $product->id);
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('mypage.index');
    }

    // 購入画面表示
    public function purchaseForm(Product $product)
    {
        return view('products.purchase', compact('product'));
    }

    // 🔥 購入処理（ここが今回のメイン）
    public function purchase(Request $request, Product $product)
    {
        $quantity = $request->input('quantity');

        // 在庫チェック
        if ($product->stock < $quantity) {
            return back()->with('error', '在庫が足りません');
        }

        // 注文作成
        Order::create([
            'user_id' => Auth::id(),
            'total_price' => $product->price * $quantity,
            // 👇 ここ追加
            'product_name' => $product->name,
            'product_description' => $product->description,
            'price' => $product->price,
            'quantity' => $quantity,
        ]);

        // 在庫減らす
        $product->stock -= $quantity;
        $product->save();

        return redirect()->route('products.index')
            ->with('success', '購入完了');
    }

    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}