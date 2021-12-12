@extends('master.front')
@section('title')
    {{__('Cart')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')

<!-- style -->
@section('styleplugins')
<style>
  .checkout-select{
    display: flex;
    align-items: center;
  }
  .checkout-select ul li{
    list-style-type:none;
    display: flex;
    align-items: center;
  }
  .checkout-select ul{
    padding-left: 0px;
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: space-evenly;
  }
  .checkout-select ul li span{
    font-size: 14px;
    padding-left: 5px;
    line-height: 15px;
    text-transform: capitalize;
  }
  @media screen and (max-width:576px) {
    .checkout-select ul{
      flex-direction: column;
      align-items: flex-start;
    }
    .checkout-select ul li{
      margin: 7px 10px;
    }
  }
</style>
@endsection
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Cart')}}</li>
                  </ul>
            </div>
        </div>
    </div>
  </div>
  @if(Session::has('cart') && count(Session::get('cart')) > 0)
  <div class="container padding-bottom-3x mb-1">

    <!-- Shopping Cart-->
    <div id="view_cart_load">
        @include('includes.cart')
    </div>

</div>
  @else
  <div class="container padding-bottom-3x mb-1">
    <div class="card text-center">
      <div class="card-body padding-top-2x">
        <h3 class="card-title">{{__('Your shopping cart is empty.')}}</h3>

       <a class="btn btn-outline-primary m-4" href="{{route('front.catalog')}}"><i class="icon-package pr-2"></i>{{__('View our products')}}</a></div>
      </div>
    </div>
  @endif
  <!-- Page Content-->



@endsection

@section('script')
    <script>
      $(document).ready(function(){
        $("#checkoutCheckAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
      });
      let result="";
      console.log(result);
        $('#checkoutCheckAll,#checkoutCheck').click(function(){
            if($(this).prop("checked") == true){
              let serviceVal = $(this).val();
              result=$(this).siblings('span').text().replace(/ /g, "-");
              console.log(result);
              $.ajax({
                type: "GET",
                url: "{{ route('product.service') }}",
                data:{'select_item':serviceVal,'select_text':result},
                success: function (data) {
                    console.log(data);
                },
              });
            }
            else if($(this).prop("checked") == false){
              let serviceVal = 0;
              result=$(this).siblings('span').text();
              console.log(result);
              $.ajax({
                type: "GET",
                url: "{{ route('product.service') }}",
                data:{'select_item':serviceVal,'select_text':result.replace(/ /g, "-")},
                success: function (data) {
                    console.log(data);
                },
              });
            }
        });
    });
      
    </script>
@endsection

