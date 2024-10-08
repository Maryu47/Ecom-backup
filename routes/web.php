<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\UserVendorRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

//product route
Route::get('show-product-modal/{id}', [HomeController::class,'ShowProductModal'])->name('show-product-modal');

//Product detail routes
Route::get('products/', [FrontProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-detail/{slug}', [FrontProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontProductController::class, 'ChangeListView'])->name('change-product-list-view');

//cart routes
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-sidebar-products', [CartController::class, 'getSidebarProduct'])->name('cart-sidebar-products');
Route::post('cart/remove-sidebar-product}', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total}', [CartController::class, 'cartSidebarTotal'])->name('cart.sidebar-product-total');
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

//News letter routes
Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequest'])->name('newsletter-request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVerify'])->name('newsletter-verify');

// vendors page routes
Route::get('vendor', [HomeController::class, 'vendorPage'])->name('vendor.index');
Route::get('vendor-product/{id}', [HomeController::class, 'vendorProductPage'])->name('vendor.product');

//about pages route
Route::get('about', [PageController::class, 'about'])->name('about');

//terms and condition pages route
Route::get('terms-and-condition', [PageController::class, 'termsAndCondition'])->name('terms-and-condition');

//contact route
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

//product track route
Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-tracking.index');

//blog routes
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetail'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');

//add to wishlist
Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');



Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    //**Message Route */
    Route::get('messages', [UserMessageController::class,'index'])->name('messages.index');
    
    //send message route
    Route::post('send-messages', [UserMessageController::class,'sendMessages'])->name('send-messages');
    Route::get('get-messages', [UserMessageController::class,'getMessages'])->name('get-messages');

    //User Address Routes
    Route::resource('address', UserAddressController::class);

    //Order Routes
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    //Wishlish Routes
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    //Vendor Request Route
    Route::get('vendor-request', [UserVendorRequestController::class, 'index'])->name('vendor-request.index');
    Route::post('vendor-request', [UserVendorRequestController::class, 'create'])->name('vendor-request.create');

    //product review routes
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');

    //blog comment route
    Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog-comment');

    //Checkout route
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    //Payment route
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    //Paypal routes
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    //stripe routes
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

    //cod routes
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');
});
