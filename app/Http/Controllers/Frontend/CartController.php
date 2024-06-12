<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // show cart page
    public function cartDetails() {
        $cartItems = Cart::content();

        if (count($cartItems) == 0) {
            Session::forget('coupon');
            toastr('Cart is empty!' , 'warning', 'Warning');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    //add item to cart
    public function addToCart(Request $request) {
        $product = Product::findOrFail($request->product_id);

        //check product quantity
        if ($product->qty == 0) {
            return response(['status'=> 'error', 'message' => 'Product is out of stock!']);
        }else if ($product->qty < $request->qty) {
            return response(['status'=> 'error', 'message' => 'Quantity is not available in our stock!']);
        }
        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount+= $variantItem->price;
            }
        }
       
        //Check discount
        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice += $product->offer_price; 
        } else {
            $productPrice += $product->price; 
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response(['status'=> 'success', 'message'=>'Added to cart successfully!']);
    }

    //update product quantity
    public function updateProductQty(Request $request) {
        
        $product_id = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($product_id);

        //check product quantity
        if ($product->qty == 0) {
            return response(['status'=> 'error', 'message' => 'Product is out of stock!']);
        }else if ($product->qty < $request->quantity) {
            return response(['status'=> 'error', 'message' => 'Quantity is not available in our stock!']);
        }
        
        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        return response(['status'=> 'success', 'message'=>'Product quantity updated!', 'price_product_total' => $productTotal]);

    }

    //get product total
    public function getProductTotal($rowId) {
        
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    //
    public function cartSidebarTotal() {
    
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }

    //clear all cart product
    public function clearCart() {
        
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart cleared successfully!']);
    }

    //remove product from cart
    public function removeProduct($rowId) {
        
        Cart::remove($rowId);
        toastr('Product have been removed!', 'success', 'Success');
        return redirect()->back();
    }

    //Get cart count
    public function getCartCount() {
        
        return Cart::content()->count();
    }

    //get all cart sidebar product
    public function getSidebarProduct() {
        
        return Cart::content();
    }

    //remove sidebar cart product
    public function removeSidebarProduct(Request $request) {
        
        Cart::remove($request->rowId);
        
        return response(['status'=>'success', 'message' => 'Product removed successfully!']);
    }

    //Apply Coupon
    public function applyCoupon(Request $request) {
        
        if ($request->coupon_code == null) {
            return response(['status'=>'error', 'message' => 'Coupon fill is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code,'status'=> 1])->first();
        
        if ($coupon == null) {
            return response(['status'=>'error', 'message' => 'Coupon  is not exist']);
        }else if ($coupon->start_date > date('Y-m-d')) {
            return response(['status'=>'error', 'message' => 'Coupon  is not exist']);
        }else if ($coupon->end_date < date('Y-m-d')) {
            return response(['status'=>'error', 'message' => 'Coupon  is expired']);
        }else if ($coupon->total_used >= $coupon->quantity) {
            return response(['status'=>'error', 'message' => 'You can not apply this coupon']);
        }

        if ($coupon->discount_type == 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount,
            ]);
        }else if ($coupon->discount_type == 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount,
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    //calculate coupon discount
    public function couponCalculation() {
        
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getSidebarCartTotal();
            if ($coupon['discount_type'] == 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total'=> $total, 'discount' => $coupon['discount']]);    
            }else if ($coupon['discount_type'] == 'percent') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total'=> $total, 'discount' => $discount]);  
            }
        } else {
            $total = getSidebarCartTotal();
            return response(['status' => 'success', 'cart_total'=> $total, 'discount' => 0]);  

        }
    }
}
