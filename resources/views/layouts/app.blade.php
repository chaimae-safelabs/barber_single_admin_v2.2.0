<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base_url" content="{{ url('/') }}">

        <?php $color = \App\AdminSetting::find(1)->color; ?>
        <style>
            :root{
                --primary_color : <?php echo $color ?>;
                --primary_color_hover : <?php echo $color.'cc' ?>;
            }
        </style>

        <!-- Title -->
        <?php $app_name = \App\AdminSetting::find(1)->app_name; ?>
        <title>{{$app_name}}</title>

        <!-- Favicon -->
        <?php $favicon = \App\AdminSetting::find(1)->favicon; ?>
        <link href="{{asset('storage/images/app/'.$favicon)}}" rel="icon" type="image/png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- CSS -->
        <link href="{{ asset('includes/css/nucleo.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/sweetalert2.scss')}}">
        <link href="{{ asset('includes/css/jquery.timepicker.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet' />
        <!-- Argon CSS -->
        <link href="{{ asset('includes/css/argon.css')}}" rel="stylesheet">
        <link href="{{ asset('includes/css/mystyle.css')}}" rel="stylesheet">
        @if (session('direction') == "rtl")
            <link href="{{ asset('includes/css/rtl.css')}}" rel="stylesheet">
        @endif

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
        @if (Request::url() != url('/admin/calendar'))
            <div class="preload">
                <img src="{{asset('storage/images/app/loader.gif')}}" class="loader" alt="">
            </div>
            <div class="for-loader">
        @endif
            @auth()
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @include('layouts.sidebar')
            @endauth

            <div class="main-content">
                @include('layouts.navbar')

                <?php $license_status = \App\AdminSetting::find(1)->license_status; ?>
                @if ($license_status == 1 || Auth::user()->role == 2)
                @include('layouts.msg')
                    @yield('content')
                    @yield('content_setting')
                @else
                    <script>
                        var base_url = $('meta[name=base_url]').attr("content");
                        var curr_url = window.location.href;
                        var set_url = base_url+'/admin/settings';
                        if (curr_url != set_url)
                        {
                            setTimeout(() => {
                                Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Your License has been deactivated...!!',
                                onClose: () => {
                                    window.location.replace(set_url);
                                    }
                                })
                            }, 1000);
                        }
                    </script>
                    @yield('content_setting')
                @endif
            </div>

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


            <script src="{{ asset('includes/js/Chart.min.js') }}"></script>
            <script src="{{ asset('includes/js/Chart.extension.js') }}"></script>
            <script src="{{ asset('includes/js/jquery.min.js') }}"></script>
            <script src="{{ asset('includes/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('includes/js/argon.js') }}"></script>
            <script src="{{ asset('includes/js/jquery.scrollbar.min.js') }}"></script>
            <script src="{{ asset('includes/js/jquery-scrollLock.min.js') }}"></script>
            <script src="{{ asset('includes/js/sweetalert.all.js') }}"></script>
            <script src="{{ asset('includes/js/jquery.timepicker.js') }}"></script>


            <script src="{{asset('includes/js/map.js')}}"></script>
            <?php $mapkey = \App\AdminSetting::find(1)->mapkey; ?>
            <script src="https://maps.googleapis.com/maps/api/js?key={{$mapkey}}" async defer></script>

            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"> </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            <script src="{{ asset('includes/js/myjavascript.js') }}"></script>

            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
            @stack('js')

            <!-- Argon JS -->
        @if (Request::url() != url('/admin/calendar'))
        </div>
        @endif
    </body>
</html>
