@extends('vendor.layouts.master')
@section('title')
{{$settings->site_name}} || Dashboard
@endsection
@section('content')

<section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders')}}">
                    <i class="far fa-address-book"></i>
                    <p>Today's order</p>
                    <h4 style="color:#fff">{{$todayOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('vendor.orders')}}">
                    <i class="far fa-address-book"></i>
                    <p>today Pending Order</p>
                    <h4 style="color:#fff">{{$todayPendingOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('vendor.orders')}}">
                    <i class="far fa-address-book"></i>
                    <p>total Order</p>
                    <h4 style="color:#fff">{{$totalOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('vendor.orders')}}">
                    <i class="far fa-address-book"></i>
                    <p>total pending Order</p>
                    <h4 style="color:#fff">{{$totalPendingOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('vendor.orders')}}">
                    <i class="far fa-address-book"></i>
                    <p>completed Order</p>
                    <h4 style="color:#fff">{{$totalCompletedOrder}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('vendor.products.index')}}">
                    <i class="fas fa-boxes"></i>
                    <p>Total products</p>
                    <h4 style="color:#fff">{{$totalProduct}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="javascript:;">
                    <i class="fas fa-money-bill"></i>
                    <p>Today Earnings</p>
                    <h4 style="color:#fff">{{$settings->currency_icon}}{{$todayEarnings}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="javascript:;">
                    <i class="fas fa-money-bill"></i>
                    <p>This month Earnings</p>
                    <h4 style="color:#fff">{{$settings->currency_icon}}{{$monthEarnings}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="javascript:;">
                    <i class="fas fa-money-bill"></i>
                    <p>This year Earnings</p>
                    <h4 style="color:#fff">{{$settings->currency_icon}}{{$yearEarnings}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="javascript:;">
                    <i class="fas fa-money-bill"></i>
                    <p>Total earnings</p>
                    <h4 style="color:#fff">{{$settings->currency_icon}}{{$totalEarnings}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="{{route('vendor.reviews.index')}}">
                    <i class="fas fa-star"></i>
                    <p>Total reviews</p>
                    <h4 style="color:#fff">{{$totalReviews}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{route('vendor.shop-profile.index')}}">
                    <i class="fas fa-store"></i>
                    <p>shop profile</p>
                    <h4 style="color:#fff">{{$totalReviews}}</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{route('vendor.profile')}}">
                    <i class="fas fa-user-circle"></i>
                    <p>my profile</p>
                    <h4 style="color:#fff">{{$totalReviews}}</h4>
                  </a>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection