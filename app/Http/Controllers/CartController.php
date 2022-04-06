<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{


    public function index()
    {
        $products = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('products'));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');
        $product = \App\Product::whereSlug($productData['slug']);

        if (!$product->count() || $productData['amount'] <= 0)
            return redirect()->route('home');

        $product = array_merge($productData, $product->first(['name', 'price', 'store_id'])->toArray());

        if (session()->has('cart')) {
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if (in_array($product['slug'], $productsSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                session()->push('cart', $product);
            }
        } else {
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto adicionado com sucesso!')->success();
        return redirect()->route('single.product', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart'))
            return redirect()->route('cart.index');

        $products = session()->get('cart');
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);

        flash('Produto removido com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        if (!session()->has('cart')) {
            return redirect()->route('home');
        }

        session()->forget('cart');

        flash('Compra cancelada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}