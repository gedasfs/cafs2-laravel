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

    public function filterByOrderWithCol(Request $request)
    {
        $prodQuery = DB::table('products');

        $sorting = $request->route()->hasParameter('sorting') ? $request->route()->parameter('sorting') : 'desc';

        if ($request->route()->hasParameter('colname')) {
            $prodQuery->orderBy($request->route()->parameter('colname'), $sorting);
        }

        $products = $prodQuery->get();

        dd($products);
    }

    public function filterByOrderWithColWithLimit(Request $request)
    {
        $prodQuery = DB::table('products');

        $sorting = $request->route()->hasParameter('sorting') ? $request->route()->parameter('sorting') : 'desc';

        if ($request->route()->hasParameter('limit')) {
            $prodQuery->take($request->route()->parameter('limit'));
        }

        if ($request->route()->hasParameter('colname')) {
            $prodQuery->orderBy($request->route()->parameter('colname'), $sorting);
        }

        $products = $prodQuery->get();

        dd($products);
    }
}
