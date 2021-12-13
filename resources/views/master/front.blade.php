
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{$setting->title}} -@yield('title')</title>
<!-- SEO Meta Tags-->
@yield('meta')
<meta name="author" content="{{$setting->title}}">
<meta name="distribution" content="web">
<!-- Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon Icons-->
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/images/'.$setting->favicon)}}">
<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/plugins.min.css')}}">
<link rel="stylesheet" media="screen" href="{{asset('css/index.css')}}">

@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">
<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/responsive.css')}}">
<link  rel="stylesheet" media="screen" href="{{asset('assets/front/custom/css/custom.css')}}">
<!-- Color css -->
<link href="{{ asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color) }}" rel="stylesheet">

<!-- Modernizr-->
{{-- <script src="{{asset('assets/front/js/modernizr.min.js')}}"></script> --}}

{{-- @if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
@endif --}}

{{-- Google AdSense Start --}}
{{-- @if ($setting->is_google_adsense == '1')
    {!! $setting->google_adsense !!}
@endif --}}
{{-- Google AdSense End --}}

{{-- Google AnalyTics Start --}}
{{-- @if ($setting->is_google_analytics == '1')
    {!! $setting->google_analytics !!}
@endif --}}
{{-- Google AnalyTics End --}}

{{-- Facebook pixel  Start --}}
{{-- @if ($setting->is_facebook_pixel == '1')
    {!! $setting->facebook_pixel !!}
@endif --}}
{{-- Facebook pixel End --}}

</head>
<!-- Body-->
<body class="
@if($setting->theme == 'theme1')
body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4
@endif
">
{{-- @if($setting->is_loader == 1) --}}
<!-- Preloader Start -->
<div id="preloader">
    <img src="{{ asset('assets/images/'.$setting->loader) }}" alt="">
</div>
<!-- Preloader endif -->
{{-- @endif --}}

<!-- Header-->
<header class="site-header navbar-sticky">
    {{-- <div class="menu-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="t-m-s-a">
                        <a class="track-order-link" href="{{route('front.order.track')}}"><i class="icon-map-pin"></i>{{ __('Track Order') }}</a>
                        <a class="track-order-link compare-mobile d-lg-none" href="{{route('fornt.compare.index')}}">{{ __('Compare') }}</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">

                        <a class="track-order-link wishlist-mobile d-inline-block d-lg-none" href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i>{{ __('Wishlist') }}</a>
                        <div class="t-h-dropdown ">
                            <a class="main-link" href="#">{{ __('Currency') }}<i class="icon-chevron-down"></i></a>
                            <div class="t-h-dropdown-menu">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <a class="{{Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')}}" href="{{route('front.currency.setup',$currency->id)}}"><i class="icon-chevron-right pr-2"></i>{{$currency->name}}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="login-register ">
                            @if(!Auth::user())
                            <a class="track-order-link mr-0" href="{{route('user.login')}}">
                            {{__('Login/Register')}}
                            </a>
                            @else
                            <div class="t-h-dropdown">
                                <div class="main-link">
                                    <i class="icon-user pr-2"></i> <span class="text-label">{{Auth::user()->first_name}}</span>
                                </div>
                                <div class="t-h-dropdown-menu">
                                    <a href="{{route('user.dashboard')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                    <a href="{{route('user.logout')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
  <!-- Topbar-->
    <div class="topbar">
        <div class="container">
            <div class="search-box-wrap d-none d-block d-flex">
                <div class="search-box-inner align-self-center">
                    <div class="search-box d-flex mx-auto">
                        <form class="input-group" action="{{route('front.catalog')}}" method="get">
                            <span class="input-group-btn">
                            <button type="submit"><i class="icon-search"></i></button>
                            </span>
                            <input class="form-control" type="text" name="search" placeholder="{{__('Search by product name')}}">
                        </form>
                        <span class="d-block close-m-search"><i class="icon-x"></i></span>
                    </div>
                   
                </div>
                
            </div>
            <div class="row main-menu">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <!-- Logo-->
                        <div class="site-branding"><a class="site-logo align-self-center" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$setting->logo)}}" alt="{{$setting->title}}"></a></div>
                        <!-- Search / Categories-->
                        {{-- <div class="search-box-wrap d-none d-lg-block d-flex">
                            <div class="search-box-inner align-self-center">
                                <div class="search-box d-flex">
                                    <form class="input-group" action="{{route('front.catalog')}}" method="get">
                                        <span class="input-group-btn">
                                        <button type="submit"><i class="icon-search"></i></button>
                                        </span>
                                        <input class="form-control" type="text" name="search" placeholder="{{__('Search by product name')}}">
                                    </form>
                                </div>
                            </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div> --}}

                        {{-- Narbar --}}
                        <div class="navbar">
                            <div class="">
                                <div class="row g-3 w-100">
                                    <div class="col-lg-12">
                                        <div class="nav-inner">
                                            <nav class="site-menu">
                                                <ul>
                                                    <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                                                    @if ($setting->is_shop == 1)
                                                    <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}">{{__('Shop')}}</a></li>
                                                    @endif
                                                    <li class="menu-categories">
                                                        @include('includes.categories')
                                                    </li>
                                                    @if ($setting->is_campaign == 1)
                                                    <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}">{{__('Campaign')}}</a></li>
                                                    @endif
                                                    @if ($setting->is_brands == 1)
                                                    <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}">{{__('Brand')}}</a></li>
                                                    @endif
                                                    @if ($setting->is_blog == 1)
                                                    <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}">{{__('Blog')}}</a></li>
                                                    @endif
                    
                                                    <!-- <li class="t-h-dropdown">
                                                        <a class="main-link" href="#">{{__('Pages')}} <i class="icon-chevron-down"></i></a>
                                                        <div class="t-h-dropdown-menu">
                                                            @if ($setting->is_faq == 1)
                                                            <a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}" href="{{route('front.faq')}}"><i class="icon-chevron-right pr-2"></i>{{__('Faq')}}</a>
                                                            @endif
                                                            @foreach (DB::table('pages')->wherePos(0)->orwhere('pos',2)->get() as $page)
                                                            <a class="{{request()->url() == route('front.page',$page->slug) ? 'active' : ''}} " href="{{route('front.page',$page->slug)}}"><i class="icon-chevron-right pr-2"></i>{{$page->title}}</a>
                                                            @endforeach
                                                        </div>
                                                    </li> -->
                    
                                                  @if ($setting->is_contact == 1)
                                                    <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"><a href="{{route('front.contact')}}">{{__('Contact')}}</a></li>
                                                  @endif
                    
                                                  <li class="{{ request()->routeIs('front.checkout.order') ? 'active' : '' }}"><a href="{{route('front.checkout.order')}}">Booking</a></li>
                                                </ul>
                                            </nav>
                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Toolbar-->
                        <div class="toolbar d-flex">

                        <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#">
                            <div>
                                <i class="icon-search"></i>
                            </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                            <div><i class="icon-menu"></i><span class="text-label">{{__('Menu')}}</span></div>
                            </a>
                        </div>
                        <div class="toolbar-item hidden-on-mobile"><a href="#" title="Search">
                            <div><span class="search-icon">
                                {{-- <i class="icon-repeat"></i> --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10.6699C2 5.88166 5.84034 2 10.5776 2C12.8526 2 15.0343 2.91344 16.6429 4.53936C18.2516 6.16529 19.1553 8.37052 19.1553 10.6699C19.1553 15.4582 15.3149 19.3399 10.5776 19.3399C5.84034 19.3399 2 15.4582 2 10.6699ZM19.0134 17.6543L21.568 19.7164H21.6124C22.1292 20.2388 22.1292 21.0858 21.6124 21.6082C21.0955 22.1306 20.2576 22.1306 19.7407 21.6082L17.6207 19.1785C17.4203 18.9766 17.3076 18.7024 17.3076 18.4164C17.3076 18.1304 17.4203 17.8562 17.6207 17.6543C18.0072 17.2704 18.6268 17.2704 19.0134 17.6543Z" fill="white"/>
                                    </svg>
                                  
                                {{-- <span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span> --}}
                                {{-- <span class="text-label">{{ __('Compare') }}</span> --}}
                            </div>
                            </a>
                        </div>
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('front.order.track')}}">
                            <div><span class="location-icon" title="Order Track">
                                {{-- <i class="icon-repeat"></i> --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 10.3178C3.5 5.71789 7.34388 2 11.9934 2C16.6561 2 20.5 5.71789 20.5 10.3178C20.5 12.6357 19.657 14.7876 18.2695 16.6116C16.7388 18.6235 14.8522 20.3765 12.7285 21.7524C12.2425 22.0704 11.8039 22.0944 11.2704 21.7524C9.13474 20.3765 7.24809 18.6235 5.7305 16.6116C4.34198 14.7876 3.5 12.6357 3.5 10.3178ZM9.19423 10.5768C9.19423 12.1177 10.4517 13.3297 11.9934 13.3297C13.5362 13.3297 14.8058 12.1177 14.8058 10.5768C14.8058 9.0478 13.5362 7.77683 11.9934 7.77683C10.4517 7.77683 9.19423 9.0478 9.19423 10.5768Z" fill="white"/>
                                    </svg>
                                {{-- <span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span> --}}
                                {{-- <span class="text-label">{{ __('Compare') }}</span> --}}
                            </div>
                            </a>
                        </div>
                        {{-- <div class="toolbar-item hidden-on-mobile"><a href="{{route('fornt.compare.index')}}">
                            <div><span class="compare-icon">
                                {{-- <i class="icon-repeat"></i> --}}
                                {{-- <span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span> --}}
                                {{-- <span class="text-label">{{ __('Compare') }}</span> --}}
                            {{-- </div>
                            </a>
                        </div> --}} 
                       
                        @if(Auth::check())
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                            <div><span class="compare-icon">
                                {{-- <i class="icon-heart"></i> --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8498 2.50065C16.4808 2.50065 17.1108 2.58965 17.7098 2.79065C21.4008 3.99065 22.7308 8.04065 21.6198 11.5806C20.9898 13.3896 19.9598 15.0406 18.6108 16.3896C16.6798 18.2596 14.5608 19.9196 12.2798 21.3496L12.0298 21.5006L11.7698 21.3396C9.48077 19.9196 7.34977 18.2596 5.40077 16.3796C4.06077 15.0306 3.02977 13.3896 2.38977 11.5806C1.25977 8.04065 2.58977 3.99065 6.32077 2.76965C6.61077 2.66965 6.90977 2.59965 7.20977 2.56065H7.32977C7.61077 2.51965 7.88977 2.50065 8.16977 2.50065H8.27977C8.90977 2.51965 9.51977 2.62965 10.1108 2.83065H10.1698C10.2098 2.84965 10.2398 2.87065 10.2598 2.88965C10.4808 2.96065 10.6898 3.04065 10.8898 3.15065L11.2698 3.32065C11.3616 3.36962 11.4647 3.44445 11.5537 3.50912C11.6102 3.55009 11.661 3.58699 11.6998 3.61065C11.7161 3.62028 11.7327 3.62996 11.7494 3.63972C11.8351 3.68977 11.9245 3.74191 11.9998 3.79965C13.1108 2.95065 14.4598 2.49065 15.8498 2.50065ZM18.5098 9.70065C18.9198 9.68965 19.2698 9.36065 19.2998 8.93965V8.82065C19.3298 7.41965 18.4808 6.15065 17.1898 5.66065C16.7798 5.51965 16.3298 5.74065 16.1798 6.16065C16.0398 6.58065 16.2598 7.04065 16.6798 7.18965C17.3208 7.42965 17.7498 8.06065 17.7498 8.75965V8.79065C17.7308 9.01965 17.7998 9.24065 17.9398 9.41065C18.0798 9.58065 18.2898 9.67965 18.5098 9.70065Z" fill="white"/>
                                    </svg>
                                    
                                <span class="count-label wishlist_count">{{Auth::user()->wishlists->count()}}</span></span>
                                {{-- <span class="text-label">{{__('Wishlist')}}</span> --}}
                            </div>
                            </a>
                        </div>
                        @else
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                          <div><span class="compare-icon">
                              {{-- <i class="icon-heart"></i> --}}
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8498 2.50065C16.4808 2.50065 17.1108 2.58965 17.7098 2.79065C21.4008 3.99065 22.7308 8.04065 21.6198 11.5806C20.9898 13.3896 19.9598 15.0406 18.6108 16.3896C16.6798 18.2596 14.5608 19.9196 12.2798 21.3496L12.0298 21.5006L11.7698 21.3396C9.48077 19.9196 7.34977 18.2596 5.40077 16.3796C4.06077 15.0306 3.02977 13.3896 2.38977 11.5806C1.25977 8.04065 2.58977 3.99065 6.32077 2.76965C6.61077 2.66965 6.90977 2.59965 7.20977 2.56065H7.32977C7.61077 2.51965 7.88977 2.50065 8.16977 2.50065H8.27977C8.90977 2.51965 9.51977 2.62965 10.1108 2.83065H10.1698C10.2098 2.84965 10.2398 2.87065 10.2598 2.88965C10.4808 2.96065 10.6898 3.04065 10.8898 3.15065L11.2698 3.32065C11.3616 3.36962 11.4647 3.44445 11.5537 3.50912C11.6102 3.55009 11.661 3.58699 11.6998 3.61065C11.7161 3.62028 11.7327 3.62996 11.7494 3.63972C11.8351 3.68977 11.9245 3.74191 11.9998 3.79965C13.1108 2.95065 14.4598 2.49065 15.8498 2.50065ZM18.5098 9.70065C18.9198 9.68965 19.2698 9.36065 19.2998 8.93965V8.82065C19.3298 7.41965 18.4808 6.15065 17.1898 5.66065C16.7798 5.51965 16.3298 5.74065 16.1798 6.16065C16.0398 6.58065 16.2598 7.04065 16.6798 7.18965C17.3208 7.42965 17.7498 8.06065 17.7498 8.75965V8.79065C17.7308 9.01965 17.7998 9.24065 17.9398 9.41065C18.0798 9.58065 18.2898 9.67965 18.5098 9.70065Z" fill="white"/>
                                </svg>
                                
                            </span>
                            {{-- <span class="text-label">{{__('Wishlist')}}</span> --}}
                          </div>
                          </a>
                      </div>
                        @endif
                        <div class="toolbar-item"><a href="{{route('front.cart')}}">
                            <div><span class="cart-icon">
                                {{-- <i class="icon-shopping-cart"></i> --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.1213 11.2331H16.8891C17.3088 11.2331 17.6386 10.8861 17.6386 10.4677C17.6386 10.0391 17.3088 9.70236 16.8891 9.70236H14.1213C13.7016 9.70236 13.3719 10.0391 13.3719 10.4677C13.3719 10.8861 13.7016 11.2331 14.1213 11.2331ZM20.1766 5.92749C20.7861 5.92749 21.1858 6.1418 21.5855 6.61123C21.9852 7.08067 22.0551 7.7542 21.9652 8.36549L21.0159 15.06C20.8361 16.3469 19.7569 17.2949 18.4879 17.2949H7.58639C6.25742 17.2949 5.15828 16.255 5.04837 14.908L4.12908 3.7834L2.62026 3.51807C2.22057 3.44664 1.94079 3.04864 2.01073 2.64043C2.08068 2.22305 2.47038 1.94649 2.88006 2.00874L5.2632 2.3751C5.60293 2.43735 5.85274 2.72207 5.88272 3.06905L6.07257 5.35499C6.10254 5.68257 6.36234 5.92749 6.68209 5.92749H20.1766ZM7.42631 18.9079C6.58697 18.9079 5.9075 19.6018 5.9075 20.459C5.9075 21.3061 6.58697 22 7.42631 22C8.25567 22 8.93514 21.3061 8.93514 20.459C8.93514 19.6018 8.25567 18.9079 7.42631 18.9079ZM18.6676 18.9079C17.8282 18.9079 17.1487 19.6018 17.1487 20.459C17.1487 21.3061 17.8282 22 18.6676 22C19.4969 22 20.1764 21.3061 20.1764 20.459C20.1764 19.6018 19.4969 18.9079 18.6676 18.9079Z" fill="white"/>
                                    </svg>
                                    
                                <span class="count-label cart_count">{{Session::has('cart') ? count(Session::get('cart')) : '0'}} </span></span>
                                {{-- <span class="text-label">{{ __('Cart') }}</span> --}}
                            </div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="{{route('front.header.cart')}}">
                            @include('includes.header_cart')
                            </div>
                        </div>
                        <div class="login-menu d-flex justify-content-center align-items-center ms-3">
                            
                                @if(!Auth::user())
                                <a class=" btn-main"  href="{{route('user.login')}}">
                                {{__('Login/Register')}}
                                </a>
                                @else
                                <div class="t-h-dropdown">
                                    <div class="main-link">
                                        <i class="icon-user pr-2"></i> <span class="text-label">{{Auth::user()->first_name}}</span>
                                    </div>
                                    <div class="t-h-dropdown-menu">
                                        <a href="{{route('user.dashboard')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                        <a href="{{route('user.logout')}}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                    </div>
                                </div>
                                @endif
                            
                        </div>
                        </div>

                        <!-- Mobile Menu-->
                        <div class="mobile-menu">
                            <!-- Slideable (Mobile) Menu-->
                            <div class="mm-heading-area">
                                <h4>{{ __('Navigation') }}</h4>
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                    <a href="#">
                                        <div> <i class="icon-x"></i></div>
                                    </a>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation99">
                                  <span class="active" id="mmenu-tab" data-bs-toggle="tab" data-bs-target="#mmenu"  role="tab" aria-controls="mmenu" aria-selected="true">{{ __('Menu') }}</span>
                                </li>
                                <li class="nav-item" role="presentation99">
                                  <span class="" id="mcat-tab" data-bs-toggle="tab" data-bs-target="#mcat"  role="tab" aria-controls="mcat" aria-selected="false">{{ __('Category') }}</span>
                                </li>

                              </ul>
                              <div class="tab-content p-0" >
                                <div class="tab-pane fade show active" id="mmenu" role="tabpanel" aria-labelledby="mmenu-tab">
                                    <nav class="slideable-menu">
                                        <ul>
                                            <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a href="{{route('front.index')}}"><i class="icon-chevron-right"></i>{{__('Home')}}</a></li>
                                            @if ($setting->is_shop == 1)
                                            <li class="{{ request()->routeIs('front.catalog*')  ? 'active' : '' }}"><a href="{{route('front.catalog')}}"><i class="icon-chevron-right"></i>{{__('Shop')}}</a></li>
                                            @endif
                                            @if ($setting->is_campaign == 1)
                                            <li class="{{ request()->routeIs('front.campaign')  ? 'active' : '' }}"><a href="{{route('front.campaign')}}"><i class="icon-chevron-right"></i>{{__('Campaign')}}</a></li>
                                            @endif
                                            @if ($setting->is_brands == 1)
                                            <li class="{{ request()->routeIs('front.brand')  ? 'active' : '' }}"><a href="{{route('front.brand')}}"><i class="icon-chevron-right"></i>{{__('Brand')}}</a></li>
                                            @endif

                                            @if ($setting->is_blog == 1)
                                            <li class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}"><a href="{{route('front.blog')}}"><i class="icon-chevron-right"></i>{{__('Blog')}}</a></li>
                                            @endif

                                            @if ($setting->is_faq == 1)
                                            <li class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}"><a href="{{route('front.faq')}}"><i class="icon-chevron-right"></i>{{__('Faq')}}</a></li>
                                            @endif


                                        @if ($setting->is_contact == 1)
                                            <li class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"><a href="{{route('front.contact')}}"><i class="icon-chevron-right"></i>{{__('Contact')}}</a></li>
                                        @endif
                                        </ul>
                                    </nav>
                                </div>
                                <div class="tab-pane fade" id="mcat" role="tabpanel" aria-labelledby="mcat-tab">
                                    <nav class="slideable-menu">
                                        @include('includes.mobile-category')

                                    </nav>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Navbar-->
    

</header>
<!-- Page Content-->
@yield('content')

<!--    announcement banner section start   -->
<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
	<a href="{{ $setting->announcement_link }}">
        <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
    </a>
</div>
<!--    announcement banner section end   -->

<!-- Site Footer-->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <!-- Contact Info-->
          <section class="widget widget-light-skin">
            <h3 class="widget-title">{{__('Get In Touch With Us')}}</h3>
            <p class="">{{__('Address')}}: {{$setting->footer_address}}</p>
            <p class="">{{__('Phone')}}: {{$setting->footer_phone}}</p>
            <ul class="list-unstyled text-sm">
              <li><span class="">{{__('Monday-Friday')}}:&nbsp;</span>{{$setting->friday_start}} - {{$setting->friday_end}}</li>
              <li><span class="">{{__('Saturday')}}:&nbsp;</span>{{$setting->satureday_start}} - {{$setting->satureday_end}}</li>
            </ul>
            <p><a class="navi-link" href="javascript">{{$setting->footer_email}}</a></p>

          </section>
        </div>
        <div class="col-lg-4 col-sm-6">
          <!-- Customer Info-->
          <div class="widget widget-links widget-light-skin">
            <h3 class="widget-title">{{__('Usefull Links')}}</h3>
            <ul>
              @foreach (DB::table('pages')->wherePos(2)->orwhere('pos',1)->get() as $page)
              <li><a href="{{route('front.page',$page->slug)}}">{{$page->title}}</a></li>

              @endforeach

            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <!-- Subscription-->
            {{-- <section class="widget">
              <h3 class="widget-title">{{__('Newsletter')}}</h3>
              <form class="row subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                @csrf
                <div class="col-sm-12">
                  <div class="input-group">
                    <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}">
                    <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                  <div aria-hidden="true">
                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                  </div>

                </div>
                <div class="col-sm-12">
                  <button class="btn btn-primary btn-block mt-2" type="submit">{{__('Subscribe')}}</button>
                </div>
                <div class="col-lg-12">
                    <p class="text-sm opacity-80 pt-2">{{__('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.')}}</p>
                </div>
              </form>
              <div class="pt-3"><img class="d-block gateway_image" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}"></div>
            </section> --}}

            {{-- Section Save Payment --}}
            <section class="save-payment">
                <h3 class="widget-title text-center">Save Payment</h3>
                <p class="text-center">We Provide The Following Payment Method</p>
                <div class="content px-5">
                    <div class="item">
                        <div class="img-item"> 
                            <img src="{{ asset('assets/front/custom/images/payment/Paypal.png') }}" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="img-item">
                            <img src="{{ asset('assets/front/custom/images/payment/Visa.png') }}" alt="">
                        </div>
                    </div>
                     <div class="item">
                        <div class="img-item">
                            <img src="{{ asset('assets/front/custom/images/payment/Discover.png') }}" alt="">
                        </div>
                     </div>
                    <div class="item">
                        <div class="img-item">
                            <img src="{{ asset('assets/front/custom/images/payment/Visa(1).png') }}" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="img-item">
                            <img src="{{ asset('assets/front/custom/images/payment/MasterCard.png') }}" alt="">
                        </div>
                    </div>
                    <div class="item">
                        <div class="img-item">
                            <img src="{{ asset('assets/front/custom/images/payment/Maestro.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                   
                </div>
            </section>
          </div>
      </div>
      <!-- Copyright-->
      <p class="footer-copyright mt-3"> {{$setting->copy_right}}</p>
    </div>
  </footer>

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#">
    <i class="icon-chevron-up"></i>
</a>
<!-- Backdrop-->
<div class="site-backdrop"></div>

<script type="text/javascript">
let extra_index_url = '{{route('front.extraindex')}}';
</script>

@php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
@endphp

<script>
    var mainbs = {!! $mainbs !!};
</script>

<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script type="text/javascript" src="{{asset('assets/front/js/plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/scripts.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/myscript.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/custom/js/custom.js')}}"></script>

@yield('script')
{{-- 
@if($setting->is_facebook_messenger	== '1')
 {!!  $setting->facebook_messenger !!}
@endif --}}

<script type="text/javascript">
    let mainurl = '{{route('front.index')}}';

    let view_extra_index = 0;
      // Notifications
      function SuccessNotification(title){
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
                },{
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title){
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
                },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if(Session::has('error'))
    <script>
      $(document).ready(function(){
        DangerNotification('{{Session::get('error')}}')
      })

    </script>
    @endif
    @if(Session::has('success'))
    <script>
      $(document).ready(function(){
        SuccessNotification('{{Session::get('success')}}');
      })

    </script>
    @endif

</body>
</html>
