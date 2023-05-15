<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Title -->
        <?php $app_name = \App\AdminSetting::find(1)->app_name; ?>
        <title>{{$app_name}}</title>

        <!-- Favicon -->
        <?php $favicon = \App\AdminSetting::find(1)->favicon; ?>
        <link href="{{asset('storage/images/app/'.$favicon)}}" rel="icon" type="image/png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    
        <!-- Argon CSS -->
        <link href="{{ asset('includes/css/argon.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/mystyle.css')}}" rel="stylesheet">
        @if (session('direction') == "rtl")
            <link href="{{ asset('includes/css/rtl.css')}}" rel="stylesheet">
        @endif
        <script>
            window.print();
        </script>
    </head>
    <body class="{{ $class ?? '' }}">
        <div class="book">
            <div class="page"> 
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col text-center center">
                                        <h1 class="pt-1 font-size-27">{{__('Invoice')}}</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 text-left">
                                        <h3>{{__('Salon Details')}}</h3>
                                        <div class="font-weight-bold">{{$booking->salon->name}}</div>
                                        <div>{{$booking->salon->address}},</div>
                                        <div>{{$booking->salon->city}} - <span></span>{{$booking->salon->zipcode}},</div>
                                        <div>{{$booking->salon->state}},</div>
                                        <div>{{$booking->salon->country}}</div>
                                    </div>
                                    <div class="col-6 text-right rtl-align-left">
                                        <img src="{{asset('storage/images/salon logos/'.$booking->salon->logo)}}"  id="black_logo_output" class="mt-2 logo_size">
                                    </div>
                                </div>
                                
                                <hr class="my-4" />

                                <div class="row">
                                    <div class="col-6 text-left">
                                        <h3>{{__('Invoice to')}}</h3>
                                        <div class="font-weight-bold">{{$booking->user->name}}</div>
                                        <div>{{$booking->user->email}}</div>
                                        <div>{{$booking->user->code}}{{$booking->user->phone}} </div>
                                    </div>
                                    <div class="col-6 text-right rtl-p">
                                        <p class="strong">{{__('Booking ID :')}} <span class="font-weight-normal">{{$booking->booking_id}}</span> </p>
                                        <p class="strong mt--3">{{__('Booking Date :')}} <span class="font-weight-normal">{{$booking->date}}</span> </p>
                                        <p class="strong mt--3">{{__('Booking Time :')}} <span class="font-weight-normal">{{$booking->start_time}}</span> </p>
                                        <p class="strong mt--3">{{__('Payment Type :')}} <span class="font-weight-normal">{{$booking->payment_type}}</span> </p>
                                        <p class="strong mt--3">{{__('Booking Status :')}} <span class="font-weight-normal">{{$booking->booking_status}}</span> </p>
                                    </div>
                                </div>

                                <div class="table-responsive my-4">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort">{{__('#')}}</th>
                                                <th scope="col" class="sort">{{__('Service Name')}}</th>
                                                <th scope="col" class="sort">{{__('Price')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($booking->services as $service)
                                                <tr>
                                                    <th>{{$loop->iteration}}</th>
                                                    <td>{{$service->name}}</td>
                                                    <td>{{$symbol}}{{$service->price}}</td>
                                                    @php
                                                        $total = $total + $service->price;
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @php
                                    $discount = $total - $booking->payment;
                                    $payment = $total - $discount;
                                @endphp

                                <div class="text-right">
                                    <p class="strong">{{__('Total :')}} <span class="font-weight-normal">{{$symbol}}{{$total}}</span> </p>
                                    <p class="strong mt--3">{{__('Coupon Discount :')}} <span class="font-weight-normal">{{$symbol}}{{$discount}}</span> </p>
                                    <p class="strong mt--3">{{__('Total Payment :')}} <span class="font-weight-normal">{{$symbol}}{{$payment}}</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
