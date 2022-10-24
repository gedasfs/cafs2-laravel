<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $orderBy = [
            'date-desc' => 'Newest first',
            'date-asc' => 'Oldest first',
            'name-asc' => 'Name Asc',
            'name-desc' => 'Name Desc',
            'price-asc' => 'Price Asc',
            'price-desc' => 'Price Desc',
        ];

        $categoryId = $request->get('category_id');

        $productQuery = Product::where('active', true);

        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }

        $priceFrom = $request->get('price_from');
        $priceTo   = $request->get('price_to');

        if ($priceFrom && $priceTo) {
            $productQuery->where('price', '>', $priceFrom);
            $productQuery->where('price', '<', $priceTo);
        }

        switch ($request->get('order_by')) {
            case 'name-asc':
                $productQuery->orderBy('name');
                break;
            case 'name-desc':
                $productQuery->orderBy('name', 'desc');
                break;
            case 'price-asc':
                $productQuery->orderBy('price');
                break;
            case 'price-desc':
                $productQuery->orderBy('price', 'desc');
                break;
            case 'date-asc':
                $productQuery->oldest();
                break;
            case 'date-desc':
            default:
                $productQuery->latest();
                break;
        }

        $categories = Category::get();
        $products = $productQuery->get();


        return view('products.index', compact('products', 'categories', 'orderBy'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->only('name', 'code', 'price', 'category_id', 'description'));
        $product->active = true;
        $product->stock = 1;

        $product->save();

        return redirect()->route('products.show', $product->id);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->save();

        return redirect()->route('products.show', $product->id);
    }



    public function filter(Request $request)
    {
        $prodQuery = DB::table('products');

        if ($request->has('by-count')) {
            if ($request->has('colName') && $request->has('value')) {
                $action = $request->get('action') ?? '=';
                $prodQuery->where($request->get('colName'), $action, $request->get('value'));
            }

            $prodQuery->dump();
            dd($prodQuery->count());
        } else if ($request->has('by-order')) {
            $sorting = $request->get('sorting') ?? 'desc';

            if ($request->has('limit')) {
                $prodQuery->take($request->get('limit'));
            }

            if ($request->has('colName') && $request->get('colName')) {
                $prodQuery->orderBy($request->get('colName'), $sorting);
            }

            $prodQuery->dump();
            dd($prodQuery->get());
        }
    }
}
