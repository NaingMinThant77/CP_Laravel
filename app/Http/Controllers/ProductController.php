<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         try {

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         try {

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         try {

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {

        } catch(Exception $e) {
            return response() -> json([
                'message' => $e->getMessage() || 'Internal Server Error'
            ], 500);
        }
    }
}
