@extends('master.front')

@section('title')
    Order Booking
@endsection

@section('styleplugins')
    <link rel="stylesheet" href="{{asset('assets/back/css/order_booking.css')}}">
@endsection

@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
          <li class="separator"></li>
          <li>Booking</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
    <div class="card text-center booking-system-wrapper">
      <div class="card-body booking-system-body">
        <form class="booking-system-form" action="{{route('front.checkout.order.submit')}}" method="POST">
          @csrf
          <!-- @method('post') -->
          <div class="order-select-body">
            <h4>Booking Appointment</h4>
            <div class="form-group">
              <select name="booking_type" class="form-control" id="exampleFormControlSelect1" required>
                <option value="">Select option</option>
                @foreach($data as $list)
                    <option value="{{ $list->id }}">
                        {{ $list->title }}
                    </option>
                @endforeach
              </select>
            </div>

            <div class="order-time-select">
              <div class="form-group booking-date-select">
              <i class="fas fa-calendar calender-icon fa-2x" ></i>
                <input type='text' name="booking_date" class="form-control" id='datetimepicker' required />
              </div>
              <div class="form-group">
                <select name="booking_time" class="form-control" id="exampleFormControlSelect1" required>
                  <option value=""> Select time </option>
                  <option value="09:00 AM - 10:00 AM"> 09:00 AM - 10:00 AM </option>
                  <option value="10:00 AM - 11:00 AM"> 10:00 AM - 11:00 AM </option>
                  <option value="11:00 AM - 12:00 PM"> 11:00 AM - 12:00 PM </option>
                  <option value="12:00 PM - 01:00 PM"> 12:00 PM - 01:00 PM </option>
                  <option value="01:00 PM - 02:00 PM"> 01:00 PM - 02:00 PM </option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="booking-btn" >Place Booking</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $('#datetimepicker').datetimepicker({ 
        minDate: new Date(),
        format: 'DD-MM-YYYY'
      });
    });
  </script>
@endsection
