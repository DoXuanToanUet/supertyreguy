<!doctype html>
<html lang="en">
  <head>
    <title>Appointment Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 m-auto">
                <p> Hi {{$data['name']}}, </p>
                <p> This is to confirm that you are booked for {{$data['service_tyre']}} on {{$data['date']}}/{{$data['time']}}.</p>
                <p> Please contact us if you have any questions. </p>
                <p> See you soon! </p>
                <p> Warm regards,</p>
                <p> Super Tyre Guy Team </p>
            </div>
        </div>
    </div>
  </body>
</html>