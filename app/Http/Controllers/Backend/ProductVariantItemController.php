<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productID, $variantID) {
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);
        return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productID,string $variantID) {
        
        $product = Product::findOrFail($productID);
        $variant = ProductVariant::findOrFail($variantID);

        return view('admin.product.product-variant-item.create', compact('variant', 'product'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'variant_id' => ['required','integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required','integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Created successfully!', 'success', 'success');

        return redirect()->route('admin.product-variant-item.index', ['productID' => $request->product_id, 'variantID' => $request->variant_id]);
    }

    public function edit(string $variantItemID) {
        
        $variantItem = ProductVariantItem::findOrFail($variantItemID);
        return view('admin.product.product-variant-item.edit', compact('variantItem'));

    }

    public function update(Request $request, string $variantItemID) {
        
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['required','integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $variantItem = ProductVariantItem::findOrFail($variantItemID);
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;
        $variantItem->save();

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->route('admin.product-variant-item.index', ['productID' => $variantItem->productVariant->product_id, 'variantID' => $variantItem->product_variant_id]);
    }

    public function destroy(string $variantItemID) {
        
        $variantItem = ProductVariantItem::findOrFail($variantItemID);
        $variantItem->delete();
        
        return response(['status'=>'success', 'message'=>'Deleted successfully!']);
    }

    public function changeStatus(Request $request) {
        
        $variantItem = ProductVariantItem::findOrFail($request->id);
        $variantItem->status = $request->status == 'true' ? 1 : 0;
        $variantItem->save();

        return response(['message' => 'Status have been Updated']);
    }
}
