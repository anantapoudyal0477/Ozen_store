<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;


class Admin_ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->renderAdminViewPage('Administrator.Products.index','Manage Products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->renderAdminViewPage('Administrator.Products.create','Add new Products');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreProductRequest $request)
{
    // Data is already validated here automatically

    $validated = $request->validated();
    // dd($validated);

    // Handle image upload
    $path = null;
if ($request->hasFile('product_image')) {
    $image = $request->file('product_image');
    $filename = time() . '_' . $image->getClientOriginalName(); // unique name
    $image->move(public_path('assets/Images/Glasses'), $filename);
    $path = 'assets/Images/Glasses/' . $filename; // save this path in DB
} else {
    $path = null;
}
// dump( $validated['product_stock']);
// var_dump( (int)$validated['product_stock']);
// dd("as");

    // Create product
    Products::create([
        'product_name'        => $validated['product_name'],
        'product_description' => $validated['product_description'],
        'product_price'       => $validated['product_price'],
        'product_stock'       => $validated['product_stock'],
        'product_image'       => $path,
    ]);

    return redirect()
        ->route('Administrator.Products.index')
        ->with('success', 'Product added successfully!');
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
            return response()->view('error.administrator.Errorpage', [
                'message' => 'Product not found.'
            ], 404);
        }

        // Use renderViewerPage to safely render the view with common data
        return $this->renderAdminViewPage(
            'Administrator.products.show',       // Blade view
            $productData->product_name,   // Page title
            ['productData' => $productData] // Additional data passed to the view
        );

    } catch (\Exception $e) {
        Log::error("Error loading product with ID {$id}: " . $e->getMessage());

        return response()->view('error.administrator.Errorpage', [
            'message' => 'Sorry, we are unable to load this product at the moment.'
        ], 500);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
        // Fetch the product by ID
        $productData = Products::find($id);

        // Handle case if product is not found
        if (!$productData) {
            return response()->view('error.administrator.Errorpage', [
                'message' => 'Product not found.'
            ], 404);
        }

        // Use renderViewerPage to safely render the view with common data
        return $this->renderAdminViewPage(
            'Administrator.products.edit',       // Blade view
            $productData->product_name,   // Page title
            ['productData' => $productData] // Additional data passed to the view
        );

    } catch (\Exception $e) {
        Log::error("Error loading product with ID {$id}: " . $e->getMessage());

        return response()->view('error.administrator.Errorpage', [
            'message' => 'Sorry, we are unable to load this product at the moment.'
        ], 500);
    }
    }

/**
 * Update the specified resource in storage.
 */
public function update(UpdateProductRequest $request, string $id)
{
    // Data is already validated by UpdateProductRequest
    try {
        //code...
        $validated = $request->validated();
    } catch (\Exception $th) {
        dd($th);
        dd($validated);
    }

    // Find the product or fail
    $product = Products::findOrFail($id);


    // Update basic fields
    $product->update([
        'product_name'        => $validated['product_name'],
        'product_description' => $validated['product_description'],
        'product_price'       => $validated['product_price'],
        'product_stock'       => $validated['product_stock'],
    ]);

    // Handle image upload
   if ($request->hasFile('product_image')) {
    // Delete old image if exists
    if ($product->product_image && file_exists(public_path($product->product_image))) {
        unlink(public_path($product->product_image));
    }

    $image = $request->file('product_image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('assets/Images/Glasses'), $filename);
    $product->update(['product_image' => 'assets/Images/Glasses/' . $filename]);
}


    return redirect()
        ->route('Administrator.Products.index')
        ->with('success', 'Product updated successfully!');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    try {
        // Find the product
        $product = Products::findOrFail($id);

        // Delete image if exists
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        // Delete the product
        $product->delete();

        return redirect()
            ->route('Administrator.Products.index')
            ->with('success', 'Product deleted successfully!');
    } catch (\Exception $e) {
        Log::error("Error deleting product with ID {$id}: " . $e->getMessage());

        return redirect()
            ->route('Administrator.Products.index')
            ->with('error', 'Failed to delete the product.');
    }
}
public function bulkDelete(Request $request)
{
    dd($request->all());
    $request->validate([
        'selected_products' => 'required|array',
        'selected_products.*' => 'exists:products,id',
    ]);


    Products::whereIn('id', $request->selected_products);

    return redirect()->route('Administrator.Products.index')
                     ->with('success', 'Selected products deleted successfully!');
}


}
