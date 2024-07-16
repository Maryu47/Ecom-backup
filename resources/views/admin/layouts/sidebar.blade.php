<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>

        </li>
        <li class="menu-header">Starter</li>

        {{-- Website --}}
        <li class="dropdown {{ setActive([
            'admin.slider.*',
            'admin.home-page-setting',
            'admin.vendors-condition.index',
            'admin.about.index',
            'admin.terms-and-condition.index'
        ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive([
              'admin.slider.*'
            ])}}"><a class="nav-link" href="{{route('admin.slider.index')}}">Sliders</a></li>
            <li class="{{setActive([
              'admin.home-page-setting'
            ])}}"><a class="nav-link" href="{{route('admin.home-page-setting')}}">Home Setting</a></li>
            <li class="{{setActive([
              'admin.vendors-condition.index'
            ])}}"><a class="nav-link" href="{{route('admin.vendors-condition.index')}}">Vendor Condition</a></li>
            <li class="{{setActive([
              'admin.admin.about.index'
            ])}}"><a class="nav-link" href="{{route('admin.about.index')}}">About Page</a></li>
            <li class="{{setActive([
              'admin.terms-and-condition.index'
            ])}}"><a class="nav-link" href="{{route('admin.terms-and-condition.index')}}">Terms Page</a></li>
          </ul>
        </li>

        {{-- Footer --}}
        <li class="dropdown {{ setActive([
            'admin.footer-info.index',
            'admin.footer-socials.*',
            'admin.footer-grid-two.*',
            'admin.footer-grid-three.*',
        ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Footer</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive([
              'admin.footer-info.*'
            ])}}"><a class="nav-link" href="{{route('admin.footer-info.index')}}">Footer info</a></li>

            <li class="{{setActive([
              'admin.footer-socials.*'
            ])}}"><a class="nav-link" href="{{route('admin.footer-socials.index')}}">Footer Socials</a></li>

            <li class="{{setActive([
              'admin.footer-grid-two.*'
            ])}}"><a class="nav-link" href="{{route('admin.footer-grid-two.index')}}">Footer Grid Two</a></li>

            <li class="{{setActive([
              'admin.footer-grid-three.*'
            ])}}"><a class="nav-link" href="{{route('admin.footer-grid-three.index')}}">Footer Grid Three</a></li>
          </ul>
        </li>

        {{-- User  --}}
        <li class="dropdown {{ setActive([
            'admin.vendor-requests.index',
            'admin.customers-list.index',
            'admin.vendors-list.index',
        ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>User</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive([
              'admin.customers-list.index'
            ])}}"><a class="nav-link" href="{{route('admin.customers-list.index')}}">Customers</a></li>
            <li class="{{setActive([
              'admin.vendors-list.index'
            ])}}"><a class="nav-link" href="{{route('admin.vendors-list.index')}}">Vendors</a></li>
            <li class="{{setActive([
              'admin.vendor-requests.index'
            ])}}"><a class="nav-link" href="{{route('admin.vendor-requests.index')}}">Pending vendors</a></li>

          </ul>
        </li>

        {{-- Categories --}}
        <li class="dropdown {{setActive([
          'admin.category.*',
          'admin.sub-category.*',
          'admin.child-category.*'
      ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive([
              'admin.category.*'
            ])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Category</a></li>
            <li class="{{setActive([
              'admin.sub-category.*'
            ])}}"><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub Category</a></li>
            <li class="{{setActive([
              'admin.child-category.*'
            ])}}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Child Category</a></li>
          </ul>
        </li>

        <li class="dropdown {{setActive([
          'admin.order.*',
          'admin.pending-orders',
          'admin.processed-orders',
          'admin.dropped-off-orders',
          'admin.shipped-orders-orders',
          'admin.out-for-delivery-orders',
          'admin.deliverd-orders',
          'admin.canceled-orders',
      ])}}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Orders</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive([
              'admin.order.*'
            ])}}"><a class="nav-link" href="{{route('admin.order.index')}}">All Orders</a></li>
            <li class="{{setActive([
              'admin.pending-orders'
            ])}}"><a class="nav-link" href="{{route('admin.pending-orders')}}">All Pending Orders</a></li>
            <li class="{{setActive([
              'admin.processed-orders'
            ])}}"><a class="nav-link" href="{{route('admin.processed-orders')}}">All Processed Orders</a></li>
            <li class="{{setActive([
              'admin.dropped-off-orders'
            ])}}"><a class="nav-link" href="{{route('admin.dropped-off-orders')}}">All Dropped off Orders</a></li>
            <li class="{{setActive([
              'admin.shipped-orders'
            ])}}"><a class="nav-link" href="{{route('admin.shipped-orders')}}">All Shipped Orders</a></li>
            <li class="{{setActive([
              'admin.out-for-delivery-orders'
            ])}}"><a class="nav-link" href="{{route('admin.out-for-delivery-orders')}}">All Out For Delivery  Orders</a></li>
            <li class="{{setActive([
              'admin.deliverd-orders'
            ])}}"><a class="nav-link" href="{{route('admin.delivered-orders')}}">All Deliverd Orders</a></li>
            <li class="{{setActive([
              'admin.canceled-orders'
            ])}}"><a class="nav-link" href="{{route('admin.canceled-orders')}}">All Canceled Orders</a></li>
          </ul>
        </li>

        <li class="{{setActive([
        'admin.transaction'
        ])}}"><a class="nav-link" href="{{route('admin.transaction')}}"><i class="fas fa-book"></i> <span>Transaction</span></a></li>

        {{-- Products --}}
        <li class="dropdown {{ setActive([
          'admin.brand.*',
          'admin.product.*',
          'admin.product-image-gallery.*',
          'admin.product-variant.*',
          'admin.product-variant-item.*',
          'admin.seller-products.*',
          'admin.seller-pending-products.*',
          'admin.reviews.*'
      ])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Products</span></a>
        <ul class="dropdown-menu">
          <li class="{{setActive(['admin.brand.*'])}}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
          <li class="{{setActive([
            'admin.product.*',
            'admin.product-image-gallery.*',
            'admin.product-variant.*',
            'admin.product-variant-item.*'])}}"><a class="nav-link" href="{{route('admin.product.index')}}">Products</a></li>
          <li class="{{setActive(['admin.seller-products.*'])}}"><a class="nav-link" href="{{route('admin.seller-products.index')}}">Seller Products</a></li>
          <li class="{{setActive(['admin.seller-pending-products.*'])}}"><a class="nav-link" href="{{route('admin.seller-pending-products.index')}}">Pending Products</a></li>
          <li class="{{setActive(['admin.reviews.*'])}}"><a class="nav-link" href="{{route('admin.reviews.index')}}">Product Reviews</a></li>
        </ul>
      </li>

      {{-- Ecommerce --}}
        <li class="dropdown {{ setActive([
          'admin.vendor-profile.*',
          'admin.flash-sale.*',
          'admin.coupons.*',
          'admin.shipping-rule.*',
          'admin.payment-settings.*'
      ])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Ecommerce</span></a>
        <ul class="dropdown-menu">
          <li class="{{setActive([
            'admin.flash-sale.*'
          ])}}"><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sale</a></li>
          <li class="{{setActive([
            'admin.vendor-profile.*'
          ])}}"><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
          <li class="{{setActive([
            'admin.coupons.*'
          ])}}"><a class="nav-link" href="{{route('admin.coupons.index')}}">Coupons</a></li>
          <li class="{{setActive([
            'admin.shipping-rule.*'
          ])}}"><a class="nav-link" href="{{route('admin.shipping-rule.index')}}">Shipping Rule</a></li>
          <li class="{{setActive([
            'admin.payment-settings.*'
          ])}}"><a class="nav-link" href="{{route('admin.payment-settings.index')}}">Payment Settings</a></li>
        </ul>
      </li>

      <li class="{{setActive([
        'admin.advertisement.index'
      ])}}"><a class="nav-link" href="{{route('admin.advertisement.index')}}"><i class="fas fa-ad"></i> <span>Advertisement</span></a></li>
      <li class="{{setActive([
        'admin.subscribers.index'
      ])}}"><a class="nav-link" href="{{route('admin.subscribers.index')}}"><i class="fas fa-user-check"></i> <span>Subscribers</span></a></li>
      <li class="{{setActive([
        'admin.settings.index'
      ])}}"><a class="nav-link" href="{{route('admin.settings.index')}}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>

        {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
          </ul>
        </li> --}}

        {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
      </ul>
  </div>