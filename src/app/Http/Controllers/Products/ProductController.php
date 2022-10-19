<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $orderBy = [
            'date-desc' => 'Newest first',
            'date-asc' => 'Oldest first',
            'name-asc' => 'By Name Asc',
            'name-desc' => 'By Name Desc',
            'price-asc' => 'By Price Asc',
            'price-desc' => 'By Price Desc',
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

    public function edit()
    {
        return view('products.edit');
    }

    public function show()
    {
        return view('products.show');
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
