@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
    'title' => __('Create') ,
    'headerData' => __('Employee') ,
    'url' => 'admin/employee' ,
    'class' => 'col-lg-7'
])

<div class="container-fluid mt--5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 text-center">
                    <span class="h3">{{__('Add Employee')}}</span>
                </div>
                <div class="mx-4 ">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-single-02 mr-2"></i>{{__('Employee')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-time-alarm mr-2"></i>{{__('Timing')}}</a>
                            </li>
                        </ul>
                    </div>
                    <form class="form-horizontal form" action="{{url('/admin/employee')}}" method="post" enctype="multipart/form-data">
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
                                                    <input type="file" id="image" name="image"  onchange="loadFile(event)" ><br>
                                                    <img id="output" class="h-25 w-25 mt-3 "/>
                                                    @error('image')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                  
                                                </div>
                        
                                                {{-- name --}}
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">{{__('Name')}}</label>
                                                    <input type="text" value="{{old('name')}}" name="name" id="name" class="form-control" placeholder="{{__('Employee Name')}}"  autofocus>
                                                    @error('name')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- email --}}
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">{{__('Email')}} </label>
                                                    <input type="text" value="{{old('email')}}" class="form-control" name="email" id="email" placeholder="{{__('Employee Email')}}" >
                                                    @error('email')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- Services --}}
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Services')}}</label>
                                                    <select class="form-control select2"  dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}" multiple="multiple" name="services[]" id="services" data-placeholder='{{ __("-- Select Service --")}}' placeholder='{{ __("-- Select Service --")}}' >
                                                        @foreach ($services as $service)
                                                            <option  value="{{$service->service_id}}" {{ (collect(old('services'))->contains($service->service_id)) ? 'selected':'' }}>{{$service->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('services')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                                {{-- Phone no --}}
                                                <div class="form-group">
                                                    <label for="phone" class="form-control-label">{{__('Phone no')}}</label>
                                                    <input type="text" value="{{old('phone')}}" class="form-control" name="phone" id="phone" placeholder="{{__('Phone no')}}" >
                                                    @error('phone')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <div class="p-20">
                                                <div class="row align-items-center mb-4">
                                                    <div class="col">
                                                        <div>{{__('Opening Time')}}</div>
                                                    </div>
                                                    <div class="col">
                                                        <div>{{__('Closing Time')}}</div>
                                                    </div>                                                            
                                                    
                                                </div>
                                                @php
                                                    $base_url = url('/');
                                                @endphp

                                                {{-- time --}}
                                                <div class="form-group row align-items-center ">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{old('start_time')}}" id="start_time">
                                                            </div>
                                                            @error('start_time')
                                                                <div class="invalid-div">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="time" name="end_time" class="form-control  @error('end_time') is-invalid @enderror" value="{{old('end_time')}}" id="end_time">
                                                            </div>
                                                            @error('end_time')                                    
                                                                <div class="invalid-div">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body text-center rtl-float-none">
                                                <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
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