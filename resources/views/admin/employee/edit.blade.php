@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
    'title' => __('Edit') ,
    'headerData' => __('Employee') ,
    'url' => 'admin/employee' ,
    'class' => 'col-lg-7'
])



<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <img src="{{asset('storage/images/employee/'.$emp->image)}}" class="rounded-circle salon_round">
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body pt-0 pt-md-4">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                <div>
                                    <span class="heading">{{count($emp->services)}}</span>
                                    <span class="description">{{__('Services')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($appointment)}}</span>
                                    <span class="description">{{__('Appointments')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($client)}}</span>
                                    <span class="description">{{__('Clients')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <h3>
                            {{ $emp->name }}<span class="font-weight-light"></span>   
                        </h3>
                        <div>
                            {{__('Phone :')}} {{$emp->phone}}
                            <br>{{__('Email :')}} {{$emp->email}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header border-0">
                    <h3>{{__('Edit Employee')}}</h3>
                </div>
                <div class="card-body">
                    <div class="nav-wrapper rtl-icon">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-single-02 mr-2"></i>{{__('Employee')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-time-alarm mr-2"></i>{{__('Timing')}}</a>
                            </li>
                        </ul>
                    </div>
                    <form class="form-horizontal form" action="{{url('/admin/employee/update/'.$emp->emp_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card shadow">
                            <div class="my-0 mx-auto w-75">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <div class="p-20">

                                                {{-- Image --}}
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Image')}}</label><br>
                                                    <input type="file" id="image" name="image"  onchange="loadFile_edit(event)"><br>
                                                    <img id="output_edit" class="uploadprofileimg mt-3" src="{{asset('storage/images/employee/'.$emp->image)}}"/>
                                                    @error('image')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- name --}}
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">{{__('Name')}}</label>
                                                    <input type="text" value="{{old('name', $emp->name)}}" name="name" id="name" class="form-control" placeholder="{{__('Salon Name')}}"  autofocus>
                                                    @error('name')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- email --}}
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">{{__('Email')}} </label>
                                                    <input type="text" class="form-control" value="{{old('email', $emp->email)}}" name="email" id="email" placeholder="{{__('Employee Email')}}" readonly>
                                                    @error('email')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- Services --}}
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Services')}}</label>
                                                    <select class="form-control select2" multiple="multiple" name="services[]" id="services"  dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" >
                                                        @foreach ($services as $service)
                                                            <option value="{{$service->service_id}}" {{ (collect(old('services'))->contains($service->section_id)) ? 'selected':'' }} <?php if (in_array($service->service_id,json_decode($emp->service_id))) { echo "selected"; } ?> >{{$service->name}}</option>
                                                        @endforeach
                                                    </select> 
                                                    @error('services')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror  
                                                </div>
                        
                                                {{-- Phone no --}}
                                                <div class="form-group">
                                                    <label for="phone" class="form-control-label">{{__('Phone no')}}</label>
                                                    <input type="text" class="form-control" value="{{old('phone', $emp->phone)}}" name="phone" id="phone" placeholder="{{__('Phone no')}}" >
                                                    @error('phone')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="sort">{{('Day Index')}}</th>
                                                        <th scope="col" class="sort">{{('Day Off')}}</th>
                                                        <th scope="col" class="sort">{{('Opening Time')}}</th>
                                                        <th scope="col" class="sort">{{('Closeing Time')}}</th>
                                                    </tr>
                                                </thead>
                                                @foreach($workinghours as $workinghour)
                                                <tbody id="day{{$workinghour->day_index}}" class="tbodyborder">
                                                    <tr>
                                                        <input type="hidden" id="day_index" name="day_index"
                                                            value="{{$workinghour->day_index}}">
                                                        <td>{{$workinghour->day_index}}</td>
                                                        <td>
                                                            <label class="custom-toggle">
                                                                <input type="checkbox" name="status{{$workinghour->day_index}}" value="{{$workinghour->status}}"
                                                                    {{$workinghour->status == 1?'checked': ''}}>
                                                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                            </label>
                                                        </td>
                                                        @php
                                                        $periods = json_decode($workinghour->period_list);
                                                        @endphp
                                                        @foreach($periods as $period)
                                                        @if ($loop->iteration == 1)
                                                        <td><input type="text"
                                                                name="start_time_{{$workinghour->day_index}}[]"
                                                                class="timepicker"
                                                                value="{{$period->start_time}}"></td>
                                                        <td><input type="text"
                                                                name="end_time_{{$workinghour->day_index}}[]"
                                                                class="timepicker"
                                                                value="{{$period->end_time}}"></td>
                                                        <td><button type="button" name="add" id="add"
                                                                class="btn btn-primary add"
                                                                onclick="addDay(event,'{{$workinghour->day_index}}')">{{__('Add Hours')}}</button></td>
                                                        @else
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type="text" name="start_time_{{$workinghour->day_index}}[]" class="timepicker w-75"
                                                                value="{{$period->start_time}}"></td>
                                                        <td><input type="text" name="end_time_{{$workinghour->day_index}}[]" class="timepicker w-75"
                                                                value="{{$period->end_time}}"></td>
                                                        <td><button class="btn btn-danger remove" type="button"><i class="fas fa-trash"></i></button></td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body text-center  rtl-float-none">
                                                <input type="submit" class="btn btn-primary  rtl-float-none" value="{{__('Save Changes')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection