@extends('master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection
@section('title')
    {{ __('Home') }}
@endsection
@section('content')


    @php
        function renderStarRating($rating, $maxRating = 5)
        {
            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating ? $rating : $maxRating;

            $fullStarCount = (int) $rating;
            $halfStarCount = ceil($rating) - $fullStarCount;
            $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

            $html = str_repeat($fullStar, $fullStarCount);
            $html .= str_repeat($halfStar, $halfStarCount);
            $html .= str_repeat($emptyStar, $emptyStarCount);
            $html = $html;
            return $html;
        }
    @endphp
  
    @if ($extra_settings->is_t2_slider == 1)
        <div class="slider-area-wrapper pt-3 mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Main Slider-->
                        <div class="hero-slider">
                            <div class="hero-slider-main owl-carousel dots-inside" >
                                @foreach ($sliders as $slider)
                                    <div class="item
                                    @if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
                                    d-flex justify-content-end
                                    @endif
                                    "
                                        style="background: url('{{ asset('assets/images/' . $slider->photo) }}')">
                                        <div class="item-inner">
                                            <div class="from-bottom">
                                                @if ($slider->logo)
                                                    <img class="d-inline-block brand-logo"
                                                    src="{{ asset('assets/images/' . $slider->logo) }}"
                                                    alt="logo">
                                                @endif

                                                <div class="title text-body">{{ $slider->title }}</div>
                                                <div class="subtitle text-body mb-4">{{ $slider->details }}</div>
                                            </div>
                                            <a class="btn btn-primary btn-sm scale-up delay-1"
                                                href="{{ $slider->link }}">{{ __('View Offers') }}
                                                <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- Section slider banner custom --}}
    <section class="banner-custom">
        <div class="container h-100">
            <div class="row h-100 gy-3">
                <div class="col col-lg-6 col-12 d-flex flex-column justify-content-center align-items-start">
                    <h2 class="banner-title main-title banner-desktop">Tyres, Mag/Steel wheels <br/>and more </h2>
                    <h2 class="banner-title main-title banner-mobile">Tyres, Mag/Steel wheels and more </h2>
                    <p class="banner-text pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis.</p>
                    <a href="{{ url('/shop') }}" class="btn-main">Buy Now </a>
                </div>
                <div class="col col-lg-6 col-12 d-flex flex-column justify-content-center align-items-start">
                    <div class="search-tyre w-100">
                        <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                            <li class="nav-item w-50" role="presentation">
                              <button class="nav-link active text-center w-100" id="size-tab" data-bs-toggle="tab" data-bs-target="#size" type="button" role="tab" aria-controls="size" aria-selected="true">By size</button>
                            </li>
                            <li class="nav-item w-50"  role="presentation">
                              <button class="nav-link text-center w-100" id="brand-tab" data-bs-toggle="tab" data-bs-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="false">By car model</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="size" role="tabpanel" aria-labelledby="size-tab">
                                <h3 class="search-title text-center">Tyre Search </h3>
                                <div class="row">
                                    <div class="col col-lg-4 col-md-4 col-ms-4">
                                        <p>Width</p>
                                        <select value="">
                                            <option name="" id="">Width</option>
                                        </select>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-ms-4">
                                        <p>Width</p>
                                        <select value="">
                                            <option name="" id="">Width</option>
                                        </select>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-ms-4">
                                        <p>Width</p>
                                        <select value="">
                                            <option name="" id="">Width</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row search-tyre">
                                    <img class="mx-auto col-lg-6" src="{{ asset('assets/front/custom/images/bysize.png') }}" alt="">
                                </div>
                                
                                <button class="btn-main btn-block">Search for tyres</button>
                            </div>
                            <div class="tab-pane fade" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                                <h3 class="search-title text-center">By car model  </h3>
                                <p>Brand:</p>
                                    <select value="">
                                        <option value="">All product</option>
                                    </select>
                                <div class="row search-tyre">
                                    <img class="mx-auto col-lg-6" src="{{ asset('assets/front/custom/images/bycar.png') }}" alt="">
                                </div>
                                <button class="btn-main btn-block">Search for tyres</button>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    {{-- Section how it work --}}
    <section class="how-work section-common">
        <div class="container">
            <h2 class="main-title text-center">How It Works</h2>
            <div class="row">
                <div class="col col-lg-4 col-md-4 col-12 text-center">
                    <img src="{{ asset('assets/front/custom/images/SearchTyre.png') }}" alt="">
                    <div class="content">
                        <h4>Search</h4>
                        <p>By type size or click “SHOP TYRES” button.</p>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-4 col-12 text-center">
                    <img src="{{ asset('assets/front/custom/images/Click.png') }}" alt="">
                    <div class="content">
                        <h4>Click & Buy</h4>
                        <p>Purchace your selected tyres & pay online</p>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-4 col-12 text-center">
                    <img src="{{ asset('assets/front/custom/images/Date.png') }}" alt="">
                    <div class="content">
                        <h4>Sechedule Fitting</h4>
                        <p>Book date/time for your tyres to be fitted</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Categories --}}
    <section class ="show-category section-common">
        <div class="container">
            <h2 class="main-title text-center">Categories</h2>
            <div class="row gy-3">
                <div class="col col-lg-4 col-md-4 col-12">
                    <a class="bkg-cat" href="{{route('front.catalog').'?category=Tyres'}}">
                        <span>Tyres</span>
                    </a>
                </div>
                <div class="col col-lg-4 col-md-4 col-12">
                    <a class="bkg-cat" href="{{route('front.catalog').'?category=Wheels'}}">
                        <span>Wheels</span>
                    </a>
                </div>
                <div class="col col-lg-4 col-md-4 col-12">
                    <a class="bkg-cat" href="{{route('front.catalog').'?category=Batteries'}}">
                        <span>Batteries</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Section service --}}
    @if ($extra_settings->is_t2_service_section == 1)
        <section class="service-section mt-60 pt-0" style="display:none">
            <div class="container">
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-lg-3 col-sm-6 text-center mb-30">
                            <div class="single-service single-service2">
                                <img src="{{ asset('assets/images/'.$service->photo) }}" alt="Shipping">
                                <div class="content">
                                    <h6 class="mb-2">{{ $service->title }}</h6>
                                    <p class="text-sm text-muted mb-0">{{ $service->details }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_3_column_banner_first == 1)
        <div class="bannner-section mt-30" style="display:none">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl1']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_first['img1']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl2']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_first['img2']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_first['firsturl3']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_first['img3']) }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_flashdeal == 1)
        <div class="flash-sell-area mt-50 theme2">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="section-title section-title2 section-title3">
                            <h2 class="h3">{{__('Flash Deal')}}</h2>
                        </div>
                        <div class="main-content">
                            <div class="features-slider  owl-carousel" >
                                @foreach ($products->orderBy('id','DESC')->get()  as $item)
                                @if ($item->is_type == 'flash_deal' && $item->date != null && $item->discount_price != 0 && $item->stock !=0)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
                                                @if (!$item->is_stock())

                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                                @endif
                                                @if($item->previous_price && $item->previous_price !=0)
                                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                                @endif
                                                <img class="lazy" data-src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
                                                <div class="product-card-inner">
                                                <div class="product-card-body">

                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif

                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                                @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
                                                <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
                                                </div>
                                                @endif
                                            </div>


                                            <div class="product-button-group"><a class="product-button" href="{{route('user.wishlist.store',$item->id)}}"><i class="icon-heart"></i><span>{{__('Wishlist')}}</span></a><a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;"><i class="icon-repeat"></i><span>{{__('Compare')}}</span></a>
                                                @if ($item->is_stock())
                                                <a class="product-button add_to_single_cart"  data-target="{{ $item->id }}" href="javascript:;"  ><i class="icon-shopping-cart"></i><span>{{__('To Cart')}}</span>
                                                </a>
                                                @else
                                                <a class="product-button" href="{{route('front.product',$item->slug)}}"><i class="icon-arrow-right"></i><span>{{__('Details')}}</span></a>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_new_product == 1)
        <section class="selected-product-section section-common mt-50 theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <h2 class="main-title text-center">{{__('New  Products')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12" >

                        <div class="features-slider  owl-carousel" >
                            @foreach ($products->orderBy('id','DESC')->get()  as $item)
                                @if($item->discount_price != 0 && $item->stock !=0)
                                  <div class="slider-item">
                                        <div class="product-card ">
                                            <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @else
                                                @if (intval($item->stock) >= 10)
                                                    <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('Available')}}</div>
                                                @elseif(intval($item->stock) >= 3 && intval($item->stock) <= 9)
                                                    <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('Low Stock')}}</div>
                                                @endif
                                            @endif
                                            
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <!--{{var_dump($item->thumbnail)}}-->
                                            <img class="lazy" data-src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}"><i class="icon-heart"></i><span>{{__('Wishlist')}}</span></a><a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;"><i class="icon-repeat"></i><span>{{__('Compare')}}</span></a>
                                                @if ($item->is_stock())
                                                <a class="product-button add_to_single_cart"  data-target="{{ $item->id }}" href="javascript:;"  ><i class="icon-shopping-cart"></i><span>{{__('To Cart')}}</span>
                                                </a>
                                                @else
                                                <a class="product-button" href="{{route('front.product',$item->slug)}}"><i class="icon-arrow-right"></i><span>{{__('Details')}}</span></a>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if ($extra_settings->is_t2_3_column_banner_second == 1)
        <div class="bannner-section mt-50">
            <div class="container ">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url1']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img1']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url2']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img2']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{$banner_secend['url3']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_secend['img3']) }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_featured_product == 1)
        <section class="selected-product-section section-common mt-50 theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <h2 class="main-title text-center">{{__('Featured Products')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12" >

                        <div class="features-slider  owl-carousel" >
                            @foreach ($products->orderBy('id','DESC')->get()  as $item)
                                @if ($item->is_type == 'feature' && $item->discount_price != 0 && $item->stock !=0)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <img class="lazy" data-src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}"><i class="icon-heart"></i><span>{{__('Wishlist')}}</span></a><a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;"><i class="icon-repeat"></i><span>{{__('Compare')}}</span></a>
                                                @if ($item->is_stock())
                                                <a class="product-button add_to_single_cart"  data-target="{{ $item->id }}" href="javascript:;"  ><i class="icon-shopping-cart"></i><span>{{__('To Cart')}}</span>
                                                </a>
                                                @else
                                                <a class="product-button" href="{{route('front.product',$item->slug)}}"><i class="icon-arrow-right"></i><span>{{__('Details')}}</span></a>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                        <p class="featured-badge">Featured </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    {{-- @if ($extra_settings->is_t2_bestseller_product == 1)
        <section class="selected-product-section mt-50  theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="h3">{{__('Best Seller')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="features-slider  owl-carousel" >
                            @foreach ($products->orderBy('id','DESC')->get()  as $item)
                                @if ($item->is_type == 'best' && $item->discount_price != 0 && $item->stock !=0)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <img class="lazy" data-src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}"><i class="icon-heart"></i><span>{{__('Wishlist')}}</span></a><a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;"><i class="icon-repeat"></i><span>{{__('Compare')}}</span></a>
                                                @if ($item->is_stock())
                                                <a class="product-button add_to_single_cart"  data-target="{{ $item->id }}" href="javascript:;"  ><i class="icon-shopping-cart"></i><span>{{__('To Cart')}}</span>
                                                </a>
                                                @else
                                                <a class="product-button" href="{{route('front.product',$item->slug)}}"><i class="icon-arrow-right"></i><span>{{__('Details')}}</span></a>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if ($extra_settings->is_t2_toprated_product == 1)
        <section class="selected-product-section mt-50  theme2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="main-title text-center">{{__('Top Rated')}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="features-slider  owl-carousel" >
                            @foreach ($products->orderBy('id','DESC')->get()  as $item)
                                @if ($item->is_type == 'top' && $item->discount_price != 0 && $item->stock !=0)
                                    <div class="slider-item">
                                        <div class="product-card ">
                                            <a class="product-thumb" href="{{route('front.product',$item->slug)}}">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <img class="lazy" data-src="{{asset('assets/images/'.$item->thumbnail)}}" alt="Product"></a>
                                            <div class="product-card-inner">
                                            <div class="product-card-body">
                                                <div class="product-category"><a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a></div>
                                                <h3 class="product-title"><a href="{{route('front.product',$item->slug)}}">
                                                    {{ strlen(strip_tags($item->name)) > 35 ? substr(strip_tags($item->name), 0, 35) : strip_tags($item->name) }}
                                                </a></h3>
                                                <div class="rating-stars">
                                                    {!! renderStarRating($item->reviews->avg('rating')) !!}
                                                </div>
                                                <h4 class="product-price">
                                                @if ($item->previous_price != 0)
                                                <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                                                @endif
                                                {{PriceHelper::grandCurrencyPrice($item)}}
                                                </h4>
                                            </div>
                                            <div class="product-button-group"><a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}"><i class="icon-heart"></i><span>{{__('Wishlist')}}</span></a><a data-target="{{route('fornt.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;"><i class="icon-repeat"></i><span>{{__('Compare')}}</span></a>
                                                @if ($item->is_stock())
                                                <a class="product-button add_to_single_cart"  data-target="{{ $item->id }}" href="javascript:;"  ><i class="icon-shopping-cart"></i><span>{{__('To Cart')}}</span>
                                                </a>
                                                @else
                                                <a class="product-button" href="{{route('front.product',$item->slug)}}"><i class="icon-arrow-right"></i><span>{{__('Details')}}</span></a>
                                                @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif --}}

    @if ($extra_settings->is_t2_2_column_banner == 1)
        <div class="bannner-section mt-50">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{$banner_third['url1']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_third['img1']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{$banner_third['url2']}}" class="genius-banner">
                            <img class="lazy" data-src="{{ asset('assets/images/'.$banner_third['img2']) }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_blog_section == 1)
        <div class="blog-section-h page_section mt-50 mb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="h3">{{ __('Our Blog') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="home-blog-slider owl-carousel">
                            @foreach ($posts as $post)
                                <div class="slider-item">
                                    <div class="blog-post">
                                        <a class="post-thumb"
                                            href="{{ route('front.blog.details', $post->slug) }}"><img
                                            class="lazy" data-src="{{ asset('assets/images/' . json_decode($post->photo, true)[array_key_first(json_decode($post->photo, true))]) }}"
                                                alt="Blog Post"></a>
                                        <div class="post-body">

                                            <h3 class="post-title"><a
                                                    href="{{ route('front.blog.details', $post->slug) }}"> {{ strlen(strip_tags($post->title)) > 55 ? substr(strip_tags($post->title), 0, 55) : strip_tags($post->title) }}</a>
                                            </h3>
                                            <ul class="post-meta">

                                                <li><i class="icon-user"></i><a href="javascript:;}">{{ __('Admin') }}</a></li>
                                                <li><i class="icon-tag"></i><a
                                                        href="{{ route('front.blog') . '?category=' . $post->category->slug }}">{{ $post->category->name }}</a>
                                                </li>
                                                <li><i class="icon-clock"></i><a
                                                    href="javascript:;">{{ date('jS F, Y', strtotime($post->created_at)) }}</a>
                                            </li>
                                            </ul>
                                            <p>{{ strlen(strip_tags($post->details)) > 120 ? substr(strip_tags($post->details), 0, 120) : strip_tags($post->details) }}
                                            </p>
                                            <a class="btn btn-outline-primary btn-sm mt-4"
                                                href="{{ route('front.blog.details', $post->slug) }}">{{ __('Read more') }} <i class="icon-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($extra_settings->is_t2_brand_section == 1)
        <section class="brand-section mb-60">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="section-title section-title2  section-title3">
                            <h2 class="h3">{{ __('Popular Brands') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="brand-slider owl-carousel">
                            @foreach ($brands as $brand)
                            <div class="slider-item">
                                <a class="text-center" href="{{ route('front.catalog') . '?brand=' . $brand->slug }}">
                                    <img class="d-block hi-50 lazy"
                                     data-src="{{ asset('assets/images/' . $brand->photo) }}"
                                        alt="{{ $brand->name }}" title="{{ $brand->name }}">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Section Newsletter --}}
    <section class ="newsletter">
        <div class="container">
            <div class="content row mx-auto">
                <h2 class="main-title">Newsletter</h2>
                <p>Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.</p>
                <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                    @csrf
                    <div class="col-sm-12 form-newsletter">
                      <div class="input-group">
                        <input class="form-control" type="email" name="email" placeholder="{{__('Enter email address')}}">
                        {{-- <span class="input-group-addon"><i class="icon-mail"></i></span> </div> --}}
                      <div aria-hidden="true">
                        <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                      </div>
                      <div class="subcribe-button">
                        <button class="btn" type="submit">{{__('Subscribe')}} <i class="fa fa-chevron-right"></i></button>
                      </div>
                    </div>
                </form>
            </div>
          
        </div>
    </section>
@endsection





