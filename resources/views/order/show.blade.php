<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
     {{--CSRF Token--}}
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Bkash Payment</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        {{ $order->product_name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $order->product_name }}</h5>
                        <p class="card-text">{{ $order->amount }}</p>
                        <p class="card-text">{{ $order->invoice }}</p>
                        @if($order->status === 'Pending')
                            <button class="btn btn-success" id="bkash-button">Pay with bKash</button>
                        @else 
                            <h4><span class="badge badge-success">Paid</span></h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"
  integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8="
  crossorigin="anonymous"></script>
  
    <script id = "myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{!! route('token') !!}",
                type: 'POST',
                contentType: 'application/json',
                success: function (data) {
                    console.log('got data from token  ..');
                    console.log(JSON.stringify(data));
                    
                    accessToken=JSON.stringify(data);
                },
                error: function(){
                            console.log('error');
                            
                }
            });
        });
    </script>
  </body>
</html>