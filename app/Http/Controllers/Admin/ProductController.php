<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $stores = \App\Store::all(['id', 'name']);

        return view('admin.products.create', compact('stores'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $store = auth()->user()->store;
        $store->products()->create($data);

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function show($product)
    {
        //
    }

    public function edit($product)
    {
        $product = $this->product->find($product);

        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);

        flash('Produto atualizado com sucesso!')->success();

        return redirect()->route('admin.products.index');
    }

    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso!')->success();

        return redirect()->route('admin.products.index');
    }
}
