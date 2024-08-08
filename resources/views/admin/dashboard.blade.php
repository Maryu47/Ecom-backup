@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Today's Order</h4>
            </div>
            <div class="card-body">
              {{$todayOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Today's Pending Order</h4>
            </div>
            <div class="card-body">
              {{$todayPendingOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary  ">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Order</h4>
            </div>
            <div class="card-body">
              {{$totalOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pending Order</h4>
            </div>
            <div class="card-body">
              {{$totalPendingOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Canceled Order</h4>
            </div>
            <div class="card-body">
              {{$totalCanceledOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Completed Order</h4>
            </div>
            <div class="card-body">
              {{$totalCompletedOrder}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Today Earnings</h4>
            </div>
            <div class="card-body">
              {{$settings->currency_icon}}{{$todayEarnings}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>This Month Earnings</h4>
            </div>
            <div class="card-body">
              {{$settings->currency_icon}}{{$monthEarnings}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>This Year Earnings</h4>
            </div>
            <div class="card-body">
              {{$settings->currency_icon}}{{$yearEarnings}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-star"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total review</h4>
            </div>
            <div class="card-body">
              {{$totalReviews}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-copyright"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total ຶ້Brand</h4>
            </div>
            <div class="card-body">
              {{$totalBrands}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Categories</h4>
            </div>
            <div class="card-body">
              {{$totalCategories}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Blogs</h4>
            </div>
            <div class="card-body">
              {{$totalBlogs}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-list"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Subcriber</h4>
            </div>
            <div class="card-body">
              {{$totalSubscribers}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Vendors</h4>
            </div>
            <div class="card-body">
              {{$totalVendors}}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Users</h4>
            </div>
            <div class="card-body">
              {{$totalUsers}}
            </div>
          </div>
        </div>
      </div>
                     
    </div>  
  </section>
@endsection