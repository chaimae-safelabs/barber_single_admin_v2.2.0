@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
    'title' => __('Salon') ,
    'class' => 'col-lg-7'
])



<div class="container-fluid mt--6  mb-5">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            @if(isset($salon->image))
                                <img src="{{asset('storage/images/salon logos/'.$salon->image)}}" class="rounded-circle salon_round">
                            @endif
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
                                    <span class="heading">{{count($services)}}</span>
                                    <span class="description">{{__('Services')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($emps)}}</span>
                                    <span class="description">{{__('Employee')}}</span>
                                </div>
                                <div>
                                    <span class="heading">{{count($users)}}</span>
                                    <span class="description">{{__('Clients')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        @if(isset($salon))
                        <h3>
                            {{ $salon->name }}<span class="font-weight-light"></span>   
                        </h3>
                        <div>
                            {{__('Phone :')}} {{$salon->phone}}
                            @if ($salon->website != null)
                                <br>{{__('Website :')}} {{$salon->website}}
                            @endif
                        </div>
                        <hr class="my-4" />
                        <p>{{ $salon->desc }}</p>
                        @endif
                        <a class="btn btn-primary text-white" href="{{url('admin/salon/edit')}}"> {{__('Edit Salon')}} </a>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header border-0">
                    <h3>{{__('View Salon')}}</h3>
                </div>
                <div class="card-body">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="false"><i class="ni ni-time-alarm mr-2"></i>{{__('Timing')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-square-pin mr-2"></i>{{__('Contact')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow mx-auto my-0">
                        <div class="my-0 mx-auto w-90">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">

                                    @if(isset($salon))
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <div class="card border-0">
                                                <!-- Card body -->
                                                <div class="table-responsive">
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
                                                                        <input type="checkbox" disabled name="status{{$workinghour->day_index}}" value="{{$workinghour->status}}"
                                                                            {{$workinghour->status == 1?'checked': ''}}>
                                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                                    </label>
                                                                </td>
                                                                @php
                                                                $periods = json_decode($workinghour->period_list);
                                                                @endphp
                                                                @foreach($periods as $period)
                                                                @if ($loop->iteration == 1)
                                                                <td><input type="text" readonly
                                                                        name="start_time_{{$workinghour->day_index}}[]"
                                                                        class="timepicker w-75"
                                                                        value="{{$period->start_time}}"></td>
                                                                <td><input type="text" readonly
                                                                        name="end_time_{{$workinghour->day_index}}[]"
                                                                        class="timepicker w-75"
                                                                        value="{{$period->end_time}}"></td>
                                                                
                                                                @else  
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><input type="text" readonly name="start_time_{{$workinghour->day_index}}[]" class="timepicker w-75"
                                                                            value="{{$period->start_time}}"></td>
                                                                    <td><input type="text" readonly name="end_time_{{$workinghour->day_index}}[]" class="timepicker w-75"
                                                                            value="{{$period->end_time}}"></td>
                                                                </tr>                                                         
                                                            @endif
                                                            @endforeach
                                                            </tr>
                                                        </tbody>
                                                        @endforeach
                                                    </table>
                                                </div>                                                
                                            </div>
                                        </div>
                                    
                                    
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <div class="card">
                                                <!-- Card body -->
                                                <div class="card-body">
                                                    <p class="h3 heading text-muted mb-3">{{__('Contact :')}} </p>
                                                    @if ($salon->website != NULL)
                                                        <span class="font-weight-bold">{{__('Website :')}} </span><span> &numsp;{{$salon->website}}</span><br>
                                                    @endif
                                                    <div class="mt-1"><span class="font-weight-bold">{{__('Phone no :')}} </span><span> &numsp;{{$salon->phone}}</span></div>
                                                    <div class="mt-1"><span class="font-weight-bold">{{__('Address :')}} </span></div>
                                                    <div>{{$salon->address}},</div>
                                                    <div>{{$salon->city}} - <span></span>{{$salon->zipcode}},</div>
                                                    <div>{{$salon->state}},</div>
                                                    <div>{{$salon->country}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection