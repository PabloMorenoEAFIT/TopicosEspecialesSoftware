<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Product;

class ProductController extends Controller
{
        // Muestra de creacion manual de productos
    // public static $products = [
    //     ['id' => '1', 'name' => 'TV', 'description' => 'Best TV'],
    //     ['id' => '2', 'name' => 'iPhone', 'description' => 'Best iPhone'],
    //     ['id' => '3', 'name' => 'Chromecast', 'description' => 'Best Chromecast'],
    //     ['id' => '4', 'name' => 'Glasses', 'description' => 'Best Glasses'],
    // ];

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData['title'] = $product['name'].' - Online Store';
        $viewData['subtitle'] = $product['name'].' - Product information';
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    // creacion de productos
    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData['title'] = 'Create product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        // dd($request->all());

        Product::create($request->only(["name","price"]));
        return back();
    }
}
