@php
    $categoryProductSliderSectionOne = json_decode($categoryProductSliderSectionOne->value);
    $lastKey = [];
    foreach ($categoryProductSliderSectionOne as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    if (array_keys($lastKey)[0] == 'category') {
        //category model
        $category = \App\Models\Category::find($lastKey['category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        //sub category model
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('sub_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } else {
        //child category model
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('child_category_id', $category->id)
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    }
@endphp

<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{$category->name}}</h3>
                    <a class="see_btn" href="{{route('products.index', ['category' => $category->slug])}}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
            <x-product-card :product="$product"/>
            @endforeach
        </div>
    </div>
</section>

@foreach ($products as $product)
<section class="product_popup_modal">
    <div class="modal fade" id="product-slider-one-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if ($product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true"
                                        data-vbtype="video" href="{{ $product->video_link }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif
                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @if (count($product->productImageGalleries) == 0)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($product->productImageGalleries as $productImage)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($productImage->image) }}"
                                                    alt="{{ $product->name }}" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title" href="#">{{ $product->name }}</a>
                                <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167
                                    item)</p>
                                @if (checkDiscount($product))
                                    <h4>{{ $product->offer_price }}{{ $settings->currency_icon }}<del>{{ $product->price }}{{ $settings->currency_icon }}</del>
                                    </h4>
                                @else
                                    <h4>{{ $product->price }}{{ $settings->currency_icon }}</h4>
                                @endif
                                <p class="review">
                                    @php
                                    $avgRating = $product->reviews()->avg('rating');
                                    $fullRating = round($avgRating)
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullRating)
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                    @endfor
                                    
                                    <span>({{count($product->reviews)}} review)</span>
                                </p>
                                <p class="description">{!! $product->short_description !!}</p>

                                <form class="shopping-cart-form">
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->status != 0)
                                                    <div class="col-xl-6 col-sm-6">
                                                        <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                        <select class="select_2" name="variants_items[]">
                                                            @foreach ($variant->productVariantItems as $variantItem)
                                                                @if ($variantItem->status)
                                                                    <option value="{{ $variantItem->id }}"
                                                                        {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                        {{ $variantItem->name }}
                                                                        ({{ $variantItem->price }}{{ $settings->currency_icon }})
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <div class="select_number">
                                            <input class="number_area" name="qty" type="text"
                                                min="1" max="100" value="1" />
                                        </div>
                                    </div>

                                    <ul class="wsus__button_area">
                                        <li><button type="submit" class="add_cart" href="#">add to
                                                cart</button></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#" class="add_to_wishlist" data-id="{{$product->id}}"><i class="fal fa-heart"></i></a></li>
                                        {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                                    </ul>
                                </form>
                                <p class="brand_model"><span>brand :</span>{{ $product->brand->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
