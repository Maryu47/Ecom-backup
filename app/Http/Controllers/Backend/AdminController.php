<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard() {
        
        $todayOrder = Order::whereDate('created_at', Carbon::today())->count();

        $todayPendingOrder = Order::whereDate('created_at', Carbon::today())
        ->where('order_status', 'pending')->count();

        $totalOrder = Order::count();

        $totalPendingOrder = Order::where('order_status', 'pending')->count();

        $totalCanceledOrder = Order::where('order_status', 'canceled')->count();

        $totalCompletedOrder = Order::where('order_status', 'delivered')->count();

        $todayEarnings = Order::whereDate('created_at', Carbon::today())
        ->where('order_status','!=', 'canceled')->sum('amount');

        $monthEarnings = Order::whereMonth('created_at', Carbon::now()->month)
        ->where('order_status','!=', 'canceled')->sum('amount');

        $yearEarnings = Order::whereYear('created_at', Carbon::now()->year)
        ->where('order_status','!=', 'canceled')->sum('amount');

        $totalReviews = ProductReview::count();

        $totalBrands = Brand::count();

        $totalCategories = Category::count();

        $totalBlogs = Blog::count();

        $totalSubscribers = NewsletterSubscriber::count();

        $totalVendors = User::where('role', 'vendor')->count();
        
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.dashboard', compact(
            'todayOrder', 
            'todayPendingOrder',
            'totalOrder',
            'totalPendingOrder',
            'totalCanceledOrder',
            'totalCompletedOrder',
            'todayEarnings',
            'monthEarnings',
            'yearEarnings',
            'totalReviews',
            'totalBrands',
            'totalCategories',
            'totalBlogs',
            'totalSubscribers',
            'totalVendors',
            'totalUsers'));
        
    }

    public function login() {
        
        return view('admin.auth.login');
    }
}
