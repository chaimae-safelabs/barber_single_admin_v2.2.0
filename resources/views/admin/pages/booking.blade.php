@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Booking'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6">
    <div class="row mb-5">
        <div class="col">
            <div class="card pb-4">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Booking table')}}</span>
                    <div class="">
                        <button class="btn btn-primary addbtn float-right p-2 add_appointment" id="add_appointment"><i class="fas fa-plus mr-1"></i>{{__('Add Appointment')}}</button>
                    </div>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="booking_dt" class="display">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">{{__('#')}}</th>
                                <th scope="col" class="sort">{{__('Booking id')}}</th>
                                <th scope="col" class="sort">{{__('User Name')}}</th>
                                <th scope="col" class="sort">{{__('Services')}}</th>
                                <th scope="col" class="sort">{{__('Date')}}</th>
                                <th scope="col" class="sort">{{__('Emp')}}</th>
                                <th scope="col" class="sort">{{__('Duration')}}</th>
                                <th scope="col" class="sort">{{__('Payment')}}</th>
                                <th scope="col" class="sort">{{__('Paid')}}</th>
                                <th scope="col" class="sort">{{__('Booking Status')}}</th>
                                <th scope="col" class="sort">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($bookings) != 0)
                                @foreach ($bookings as $key => $booking)
                                    <tr>
                                        <th>{{$bookings->firstItem() + $key}}</th>
                                        <td>{{$booking->booking_id}}</td>
                                        <td>{{$booking->user->name}}</td>
                                        <td>
                                            <div class="avatar-group">
                                                @foreach ($booking->services as $service)
                                                    <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$service->name}}">
                                                        <img alt="service" class="service_icon" src="{{asset('storage/images/services/'.$service->image)}}">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>{{$booking->date}}</td>
                                        <td>{{$booking->employee->name}}</td>
                                        <td>{{$booking->start_time}} To {{$booking->end_time}}</td>
                                        <td>{{$symbol}}{{$booking->payment}}</td>
                                        <td class="text-center">
                                            @if ($booking->payment_status == 0)
                                                <span class="badge badge-pill badge-warning">{{__('Unpaid')}}</span>
                                            @else
                                                @if ($booking->payment_type == "LOCAL" || $booking->payment_type == "Local")
                                                    <span class="badge badge-pill badge-success">{{__('Paid')}}</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">{{__('Stripe')}}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <select class="form-control" onchange="changeStatus({{$booking->id}})" name="selector" id="selector{{$booking->id}}" {{$booking->booking_status == "Completed" || $booking->booking_status == "Cancelled"?'disabled': ''}} >
                                                <option value="Pending" {{$booking->booking_status == "Pending"?'selected': ''}} disabled>{{__('Pending')}}</option>
                                                <option value="Cancelled" {{$booking->booking_status == "Cancelled"?'selected': ''}}>{{__('Cancelled')}}</option>
                                                <option value="Approved" {{$booking->booking_status == "Approved"?'selected': ''}}>{{__('Approved')}}</option>
                                                <option value="Completed" {{$booking->booking_status == "Completed"?'selected': ''}}>{{__('Completed')}}</option>
                                            </select>
                                        </td>
                                        <td class="table-actions">
                                            @php
                                                $base_url = url('/');
                                            @endphp
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_booking({{$booking->id}},'{{$base_url}}','booking')" data-toggle="tooltip" data-original-title="{{__('View Appointment')}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{url('/admin/booking/invoice/'.$booking->id)}}" class="text-blue cursor table-action"  data-toggle="tooltip" data-original-title="{{__('View Invoice')}}">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="15" class="text-center">{{__('No Bookings')}}</th>
                                </tr>
                            @endif
                            
                        </tbody>
                    </table>
                    <div class="float-right mr-4 mt-3">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.booking.create')
@include('admin.booking.show')

@endsection