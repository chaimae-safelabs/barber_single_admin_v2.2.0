<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

   
    <head>
        <!-- title -->
        <?php $app_name = \App\AdminSetting::find(1)->app_name; ?>
        <title> {{$app_name}} </title>
        <?php $color = \App\AdminSetting::find(1)->color; ?>
        <style>
            :root{
                --primary_color : <?php echo $color ?>;
                --primary_color_hover : <?php echo $color.'cc' ?>;
            }
        </style>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
            integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
        
        <!-- Favicon -->
        <?php $favicon = \App\AdminSetting::find(1)->favicon; ?>
        <link href="{{asset('storage/images/app/'.$favicon)}}" rel="icon" type="image/png">
        
        <!-- Icons -->
        <link href="{{ asset('includes/css/nucleo.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/loginStyle.css')}}" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    </head> 

    <body class="{{ $class ?? '' }} login">
        {{-- <div class="preload" id="preload">
            <img src="{{asset('storage/images/app/loader.gif')}}" class="loader" alt="">
        </div> --}}
        <div class="for-loader">
            @auth()
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
            
           
            
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
      
        <script>
            jQuery(".form-control")
            .on("blur", function() {
                if (jQuery(this).val().length <= 0) {
                jQuery(this)
                    .siblings("label")
                    .removeClass("moveUp");
                jQuery(this).removeClass("outline");
                }
            })
            .on("focus", function() {
                if (jQuery(this).val().length >= 0) {
                jQuery(this)
                    .siblings("label")
                    .addClass("moveUp");
                jQuery(this).addClass("outline");
                }
            });

        </script>
    </body>
</html>