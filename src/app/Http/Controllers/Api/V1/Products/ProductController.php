<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $productQuery = Product::where('active', true);

        $categoryId = $request->get('category_id');
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }

        $priceFrom = $request->get('price_from');
        if ($priceFrom) {
            $productQuery->where('price', '>', $priceFrom);
        }

        $priceTo = $request->get('price_to');
        if ($priceTo) {
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

        $products = $productQuery->get();

        $prodCollection = ProductResource::collection($products);
        return $prodCollection;
    }

    public function view(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->only('name', 'code', 'price', 'category_id', 'description'));
        $product->active = true;
        $product->stock = 1;

        $product->save();

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }
}
