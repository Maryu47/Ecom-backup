@extends('vendor.layouts.master')
@section('title')
{{$settings->site_name}} || Create Withdraw Request
@endsection
@section('content')
     <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
     @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <a href="{{route('vendor.withdraw.index')}}" class="btn btn-warning mb-4"><i class="fas fa-arrow-left"></i> Back</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Withdraw Request</h3>
            <div class="wsus__dashboard_profile">
              <div class="row">
                <div class="wsus__dash_pro_area col-md-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Withdraw method</b></td>
                                <td>{{$wrequest->method}}</td>
                            </tr>
                            <tr>
                                <td><b>Withdraw charge </b></td>
                                <td>{{($wrequest->withdraw_charge / $wrequest->total_amount) * 100}}%</td>
                            </tr>
                            <tr>
                                <td><b>Withdraw charge amount</b></td>
                                <td>{{$settings->currency_icon}}{{$wrequest->withdraw_charge}}</td>
                            </tr>
                            <tr>
                                <td><b>Total amount</b></td>
                                <td>{{$settings->currency_icon}}{{$wrequest->total_amount}}</td>
                            </tr>
                            <tr>
                                <td><b>Withdraw amount</b></td>
                                <td>{{$settings->currency_icon}}{{$wrequest->withdraw_amount}}</td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td>
                                    @if ($wrequest->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                    @elseif ($wrequest->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                    @else
                                    <span class="badge bg-success">Declined</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Account Information</b></td>
                                <td>{!!$wrequest->account_info!!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
