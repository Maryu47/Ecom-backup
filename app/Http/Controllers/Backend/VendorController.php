<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard() {
        
        $todayOrder = Order::whereDate('created_at', Carbon::today())->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();
        
        $todayPendingOrder = Order::whereDate('created_at', Carbon::today())
        ->where('order_status', 'pending')
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalOrder = Order::whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalPendingOrder = Order::where('order_status', 'pending')->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalCompletedOrder = Order::where('order_status', 'delivered')->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalProduct = Product::where('vendor_id', Auth()->user()->vendor->id)->count();

        $todayEarnings = Order::whereDate('created_at', Carbon::today())
        ->where('payment_status', 1)
        ->where('order_status', 'delivered')->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('amount');

        $monthEarnings = Order::whereMonth('created_at', Carbon::now()->month)
        ->where('payment_status', 1)
        ->where('order_status', 'delivered')->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('amount');

        $yearEarnings = Order::whereYear('created_at', Carbon::now()->year)
        ->where('payment_status', 1)
        ->where('order_status', 'delivered')->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('amount');

        $totalEarnings = Order::where('order_status', 'delivered')
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->sum('amount');

        $totalReviews = ProductReview::whereHas('product', function($query){
            $query->where('vendor_id', Auth()->user()->vendor->id);
        })->count();

        return view('vendor.dashboard.dashboard', compact(
            'todayOrder',
            'todayPendingOrder',
            'totalOrder',
            'totalPendingOrder',
            'totalCompletedOrder',
            'totalProduct',
            'todayEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalEarnings',
            'totalReviews'));
    }
}
