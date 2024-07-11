@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    
        <section class="section">
          <div class="section-header">
            <h1>Settings</h1>
          </div>

          <div class="section-body">
           
            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab">Homepage Banner section 1</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Homepage Banner section 2</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Homepage Banner section 3</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Homepage Banner section 4</a>
                            <a class="list-group-item list-group-item-action" id="list-product-list" data-toggle="list" href="#list-product" role="tab">Product page Banner</a>
                            <a class="list-group-item list-group-item-action" id="list-cart-list" data-toggle="list" href="#list-cart" role="tab">Cart page Banner</a>
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="tab-content" id="nav-tabContent">
                            @include('admin.advertisement.homepage-banner-one')

                            @include('admin.advertisement.homepage-banner-two')

                            @include('admin.advertisement.homepage-banner-three')

                            @include('admin.advertisement.homepage-banner-four')

                            @include('admin.advertisement.product-page-banner')

                            @include('admin.advertisement.cart-page-banner')

                            {{-- <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                              Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam commodo elit dolore do labore occaecat laborum sed quis proident fugiat sunt pariatur. Cupidatat ut fugiat anim ut dolore excepteur ut voluptate dolore excepteur mollit commodo. 
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </section>
        
@endsection