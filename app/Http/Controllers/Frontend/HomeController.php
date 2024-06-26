<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategories = HomePageSetting::where('key','popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        return view('frontend.home.home', 
        compact(
            'sliders',
            'flashSaleDate',
            'flashSaleItems',
            'popularCategories',
            'brands',
            'typeBaseProducts',
            'categoryProductSliderSectionOne',
            'categoryProductSliderSectionTwo'
        ));
    }

    public function  getTypeBaseProduct() {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approve' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type' => 'featured_product', 'is_approve' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type' => 'top_product', 'is_approve' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type' => 'best_product', 'is_approve' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }
}
