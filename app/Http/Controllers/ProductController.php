<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateReq;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class ProductController extends Controller
{
    function index()
    {
        Gate::authorize('view', 'products');
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        Gate::authorize('view', 'products');
        return new ProductResource($product);
    }

    public function store(ProductCreateReq $request)
    {
        Gate::authorize('edit', 'products');
        $product = Product::create($request->only('title','description','image','price'));
        return response($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('edit', 'products');
        $product->update($request->only('title','description','image','price'));
        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        Gate::authorize('edit', 'products');
        if ($product->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json(null, Response::HTTP_BAD_REQUEST);
    }
}
