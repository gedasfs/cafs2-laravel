<?php

namespace App\Http\Controllers\Api\V1\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $catCollection = CategoryResource::collection($categories);

        return $catCollection;
    }
}
