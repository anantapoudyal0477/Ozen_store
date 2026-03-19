<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Log;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    try {
        // Fetch all products
        $productData = Products::paginate(15);


        // Optionally, you can handle empty collection if you want to show a message
        if ($productData->isEmpty()) {
            Log::info('No products found.');
            // You can either show an empty products page or a message in the view
        }

        // Pass product data as optional additionalData
        return $this->renderViewerPage(
            'Viewer.Products.index', // Blade view
            'Products',                 // Page title
            ['productData' => $productData] // Additional data passed to the view
        );

    } catch (\Exception $e) {
        Log::error("Error loading products: " . $e->getMessage());

        return response()->view('Error.Errorpage', [
            'message' => 'Sorry, we are unable to load the products at the moment.'
        ], 500);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    try {
        // Fetch the product by ID
        $productData = Products::find($id);

        // Handle case if product is not found
        if (!$productData) {
            return response()->view('Errorpage', [
                'message' => 'Product not found.'
            ], 404);
        }

        // Use renderViewerPage to safely render the view with common data
        return $this->renderViewerPage(
            'Viewer.Products.show',       // Blade view
            $productData->product_name,   // Page title
            ['productData' => $productData] // Additional data passed to the view
        );

    } catch (\Exception $e) {
        Log::error("Error loading product with ID {$id}: " . $e->getMessage());

        return response()->view('Error.Errorpage', [
            'message' => 'Sorry, we are unable to load this product at the moment.'
        ], 500);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
