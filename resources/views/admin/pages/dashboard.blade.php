@extends('layouts.app')
@section('content')

{{-- Top 4 cards --}}
<?php $bg_img = \App\AdminSetting::find(1)->bg_img; ?>
<div class="header pt-9" style="background-image: url({{asset('storage/images/app/'.$bg_img)}}); background-size: cover; background-position: center center;padding-bottom: 50px;"> 
    <span class="mask bg-gradient-dark opacity-7"></span>
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Users')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{count($users)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Services')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{count($services)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="ni ni-scissors"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Income')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$setting->currency_symbol}}{{ceil($payment)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Category')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$categories}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-nowrap">{{__('Since app launch')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Users Charts --}}
<div class="container-fluid mt--4">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('New Registered')}}</h6>
                            <h2 class="text-default mb-0">{{__('User')}}</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#users_chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab" id="adminWeekUser">
                                        <span class="d-none d-md-block">{{__('Week')}}</span>
                                        <span class="d-md-none">{{__('W')}}</span>
                                    </a>
                                </li>
                                                                                                                        
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#users_chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="adminMonthUser">
                                        <span class="d-none d-md-block">{{__('Month')}}</span>
                                        <span class="d-md-none">{{__('M')}}</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#users_chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="adminYearUser">
                                        <span class="d-none d-md-block">{{__('Year')}}</span>
                                        <span class="d-md-none">{{__('Y')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="users_chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Revenue Charts --}}
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('Income')}}</h6>
                            <h2 class="text-default mb-0">{{__('Revenue')}}</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab" id="adminWeekRevenue">
                                        <span class="d-none d-md-block">{{__('Week')}}</span>
                                        <span class="d-md-none">{{__('W')}}</span>
                                    </a>
                                </li>
                                                                                                                        
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="adminMonthRevenue">
                                        <span class="d-none d-md-block">{{__('Month')}}</span>
                                        <span class="d-md-none">{{__('M')}}</span>
                                    </a>
                                </li>
                                
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#revenue_chart" data-prefix="a">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab" id="adminYearRevenue">
                                        <span class="d-none d-md-block">{{__('Year')}}</span>
                                        <span class="d-md-none">{{__('Y')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="revenue_chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- User table  &  Cat table--}}
<div class="container-fluid mt-4 mb-4">
    <div class="row">      
        <div class="col-xl-5">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('New Registered')}}</h6>
                            <h3 class="mb-0">{{__('Categories')}}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('/admin/categories')}}" class="btn btn-sm btn-primary">{{__('See all')}}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">{{__('#')}}</th>
                            <th scope="col" class="sort">{{__('Image')}}</th>
                            <th scope="col" class="sort">{{__('Category')}}</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @if (count($table_cat) != 0)
                            <?php $num = 1; ?>
                            @foreach ($table_cat as $category)
                                @if ($num == 6)
                                    @break
                                @endif
                                <tr>
                                    <th>{{$num}}</th>
                                    <td>
                                        <img alt="Image placeholder" class="tableimage_cat rounded" src="{{asset('storage/images/categories/'.$category->image)}}">
                                    </td>
                                    <td>{{$category->name}}</td>
                                </tr>
                                <?php $num++; ?>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="3" class="text-center">{{__('No Categories')}}</th>
                            </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
         
        <div class="col-xl-7">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">{{__('New Registered')}}</h6>
                            <h3 class="mb-0">{{__('Users')}}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('/admin/users')}}" class="btn btn-sm btn-primary">{{__('See all')}}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">{{__('#')}}</th>
                            <th scope="col" class="sort">{{__('Image')}}</th>
                            <th scope="col" class="sort">{{__('Name')}}</th>
                            <th scope="col" class="sort">{{__('Email')}}</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        @if (count($users) != 0)
                            <?php $num = 1; ?>
                            @foreach ($users as $user)
                                @if ($num == 6)
                                    @break
                                @endif
                                <tr>
                                    <th>{{$num}}</th>
                                    <td>
                                        <img alt="Image placeholder" class="tableimage_cat rounded" src="{{asset('storage/images/users/'.$user->image)}}">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <?php $num++; ?>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="4" class="text-center">{{__('No Users')}}</th>
                            </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-4 mb-4">
    {{-- Tables --}}
    <div class="row">
        <!-- Service table -->
        <div class="col-xl-4 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('Top Services')}}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{url('/admin/services')}}" class="btn btn-sm btn-primary">{{__('See all')}}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('#')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Category')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($services))
                                @if(count($top_services) != 0)
                                    @foreach ($top_services as $service)
                                        <tr>
                                            <th>{{$loop->iteration}}</th>
                                            <td>
                                                <img src="{{asset('storage/images/services/'.$service->image)}}" class="icon rounded-circle">
                                            </td>
                                            <td>{{$service->name}}</td>
                                            <td>{{$service->category->name}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">{{__('Service not booked by any client')}}</th>
                                    </tr>
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Booking table --}}
        <div class="col-xl-8">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('Upcoming Approved Appointments')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('Booking Id')}}</th>
                                <th scope="col">{{__('User Name')}}</th>
                                <th scope="col">{{__('Service')}}</th>
                                <th scope="col">{{__('Date')}}</th>
                                <th scope="col">{{__('Time')}}</th>
                                <th scope="col">{{__('Payment')}}</th>
                                <th scope="col">{{__('Payment Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                                @if (count($upcommings) != 0)
                                    @foreach ($upcommings as $upcomming)
                                        <tr>
                                            <th>{{$upcomming->booking_id}}</th>
                                            <td>{{$upcomming->user->name}}</td>
                                            <td>
                                                <div class="avatar-group">
                                                    @foreach ($upcomming->services as $service)
                                                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$service->name}}">
                                                            <img alt="service" class="service_icon" src="{{asset('storage/images/services/'.$service->image)}}">
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{$upcomming->date}}</td>
                                            <td>{{$upcomming->start_time}}</td>
                                            <td>{{$symbol}}{{$upcomming->payment}}</td>
                                            <td class="text-center">
                                                @if ($upcomming->payment_status == 1)
                                                    <span class="badge badge-pill badge-success">{{__('Paid')}}</span>
                                                @elseif($upcomming->payment_status == 0)
                                                    <span class="badge badge-pill badge-warning">{{__('Unpaid')}}</span>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">{{__('No Upcomming Appointments')}}</th>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
