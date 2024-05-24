<?php
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;

//Vendor Routes
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

//Vendor shop profile 
Route::resource('shop-profile', VendorShopProfileController::class);

//Vendor Product routes
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::resource('products', VendorProductController::class);

//Vendor Product Image Route
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

//Vendor Product variant Route
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

//Product variant Item Route
// Route::get('product-variant-item/{productID}/{variantID}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');

// Route::get('product-variant-item/create/{productID}/{variantID}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');

// Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');

// Route::get('product-variant-item-edit/{variantItemID}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');

// Route::put('product-variant-item-update/{variantItemID}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');

// Route::delete('product-variant-item-destroy/{variantItemID}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');

// Route::put('product-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.changeStatus');
