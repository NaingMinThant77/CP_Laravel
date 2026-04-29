<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use Exception;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        try {
            $categories = Category::all();
            return response()->json([
                'message' => 'Categories fetched successfully',
                'data' => CategoryResource::collection($categories)
            ], 200);
        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    public function show($id) {
        try {
            $category = Category::find($id);
            if(!$category) {
                return response()->json([
                    'message' => 'Category not found'
                ], 404);
            }
            return response()->json([
                'message' => 'Category fetched successfully',
                'data' => CategoryResource::make($category)
            ], 200);
            
        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    public function store(StoreRequest $request) {
        try {
            $category = Category::create($request->validated());
            return response()->json([
                'message' => 'Category created successfully',
                'data' => CategoryResource::make($category)
            ], 201);

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    public function update(UpdateRequest $request, $id) {
        try {
            $category = Category::find($id);
            if(!$category) {
                return response()->json([
                    'message' => 'Category not found'
                ], 404);
            }
            $category->update($request->validated());
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => CategoryResource::make($category)
            ], 200);

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $category = Category::find($id);    
            if(!$category) {
                return response()->json([
                    'message' => 'Category not found'
                ], 404);
            }
            $category->delete();
            return response()->json([
                'message' => 'Category deleted successfully'
            ], 200);
        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }
}