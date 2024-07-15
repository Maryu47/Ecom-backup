<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProducReviewsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorProductReviewController extends Controller
{
    public function index(VendorProducReviewsDataTable $dataTable) {
        
        return $dataTable->render('vendor.review.index');
    }
}
