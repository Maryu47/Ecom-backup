@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name}} || Became a Vendor Today
@endsection
@section('content')
     <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
     @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Became a Vendor Today</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                  
                

              </div>
            </div>
            <br>
            <div class="wsus__dashboard_profile">
                <div class="wsus__dash_pro_area">
                    <form action="{{route('user.vendor-request.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-image"></i>
                            <input type="file" placeholder="Shop Banner Image" name="shop_image"> 
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" placeholder="Shop name" name="shop_name"> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" placeholder="Shop email" name="shop_email"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="wsus__dash_pro_single">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="text" placeholder="Shop Phone" name="shop_phone"> 
                                </div>
                            </div>
                        </div>
                        <div class="wsus__dash_pro_single">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" placeholder="Shop Address" name="shop_address"> 
                        </div>
                        <div class="wsus__dash_pro_single">
                            <textarea name="about" id="" cols="30" rows="10" placeholder="About Shop"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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