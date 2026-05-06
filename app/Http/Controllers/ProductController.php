<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\CloudinaryFileUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         try {
            $products = Product::with('category')->get();

            return response()->json([
                'message' => 'Products fetched successfully',
                'data' => ProductResource::collection($products)
            ], 200);
        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
         try {
            $data = $request -> validated();
            if($request->hasFile('image_url')) {
                $cloudinaryService = new CloudinaryFileUploadService();
                $data['image_url'] = $cloudinaryService->upload($request->file('image_url'), 'products');
            }
            $product = Product::create($data);
            return response()->json([
                'message' => 'Product created successfully',
                'data' => ProductResource::make($product)
            ], 201);

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         try {
            $product = Product::find($id);
            if(!$product) {
                return response() -> json([
                    'message' => 'Product not found'
                ], 404);
            } 
            return response()->json([
                'message' => 'Product fetched successfully',
                'data' => ProductResource::make($product)
            ], 200);
            
        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
         try {
            $product = Product::find($id);
            if(!$product) {
                return response() -> json([
                    'message' => 'Product not found'
                ], 404);
            }
            
            $data = $request -> validated();
            if($request->hasFile('image_url')) {
                $cloudinaryService = new CloudinaryFileUploadService();
                if($product->image_url) {
                    $cloudinaryService->delete($product->image_url);
                }
                $data['image_url'] = $cloudinaryService->upload($request->file('image_url'), 'products');
            }
            $product->update($data);
            return response()->json([
                'message' => 'Product updated successfully',
                'data' => ProductResource::make($product)
            ], 200);

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $product = Product::find($id);
            if(!$product) {
                return response() -> json([
                    'message' => 'Product not found'
                ], 404);
            }
            if($product->image_url) {
                 $cloudinaryService = new CloudinaryFileUploadService();
                 $cloudinaryService->delete($product->image_url);
            }
            $product->delete();
            
            return response()->json([
                'message' => 'Product deleted successfully'
            ], 200);

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }
}