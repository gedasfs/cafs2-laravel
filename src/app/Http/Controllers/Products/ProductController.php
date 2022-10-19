<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', compact('products'));
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


    public function countAll()
    {
        $prodCount = DB::table('products')->count();

        dd($prodCount);
    }

    public function countByColWithVal(Request $request)
    {
        $prodQuery = DB::table('products');

        $action = $request->route()->hasParameter('action') ? $request->route()->parameter('action') : '=';
        $colName = $request->route()->parameter('colName');
        $colVal = $request->route()->parameter('colVal');

        $prodCount = $prodQuery->where($colName, $action, $colVal)->count();

        dd($prodCount);
    }

    public function filterOrderByName(Request $request)
    {
        $sorting = $request->route()->hasParameter('sorting') ? $request->route()->parameter('sorting') : 'desc';

        $prodQuery = DB::table('products')->orderBy('name', $sorting);

        $products = $prodQuery->get();

        dd($products);
    }

    public function filterOrderByActiveWithLimit(Request $request)
    {
        $sorting = $request->route()->hasParameter('sorting') ? $request->route()->parameter('sorting') : 'desc';

        $prodQuery = DB::table('products')->orderBy('active', $sorting)->limit($request->route()->parameter('limit'));

        $products = $prodQuery->get();

        dd($products);
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
