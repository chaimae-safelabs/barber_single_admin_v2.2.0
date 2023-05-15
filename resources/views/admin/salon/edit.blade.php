@extends('layouts.app')
@section('content')


@include('layouts.top-header', [
'title' => __('Salon Edit'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--6 mb-5 pb-5">
    <div class="row">
        <div class="col">
            <div class="card pb-6">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Edit Salon')}}</span>
                </div>
                <form class="form-horizontal form" id="settingform"
                    action="{{url('/admin/salon/update/'.$salon->salon_id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="nav-wrapper settings">
                                <ul class="nav navbar-nav nav-pills setting nav-fill" id="tabs-icons-text"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-left active" id="tabs-icons-text-1-tab"
                                            data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                            aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                                class="ni ni-scissors mr-2"></i> {{__('Salon Basic Details')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left" id="tabs-icons-text-2-tab" data-toggle="tab"
                                            href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                            aria-selected="false"><i class="fas fa-image mr-2"></i> {{__('Salon Logo')}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left" id="tabs-icons-text-3-tab" data-toggle="tab"
                                            href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                            aria-selected="false"><i class="ni ni-time-alarm mr-2"></i> {{__('Salon
                                            Timings')}} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left" id="tabs-icons-text-4-tab" data-toggle="tab"
                                            href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4"
                                            aria-selected="false"><i class="ni ni-square-pin mr-2"></i> {{__('Salon
                                            Address')}} </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-8">
                            @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>{{__('Error!')}}</strong> {{$errors->first()}}
                            </div>
                            @endif
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        {{-- Tab 1 Salon Basic Details --}}
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                            aria-labelledby="tabs-icons-text-1-tab">
                                            <h4 class="card-title">{{__('Salon Basic Details')}}</h4>

                                            <div class="form-group">
                                                <label class="form-control-label" for="name">{{__('Name')}}</label>
                                                <input type="text" value="{{old('name', $salon->name)}}" name="name"
                                                    id="name" class="form-control" placeholder="{{__('Salon Name')}}"
                                                    autofocus>
                                                @error('name')
                                                <div class="invalid-div">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="desc"
                                                    class="form-control-label">{{__('Description')}}</label>
                                                <textarea class="form-control" rows="6" id="desc" name="desc"
                                                    placeholder="{{__('Description of salon')}}">{{old('desc', $salon->desc)}}</textarea>
                                                @error('desc')
                                                <div class="invalid-div">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Gender --}}
                                            <div class="form-group">
                                                <label class="form-control-label">{{__('Salon for')}}</label><br>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="male" name="gender" value="Male" {{
                                                        old('gender',$salon->gender) == "Male" ? 'checked' : '' }}
                                                    class="custom-control-input" >
                                                    <label class="custom-control-label"
                                                        for="male">{{__('Male')}}</label>
                                                    {{-- {{dd(old('gender')== "Female" ? 'checked' : '' )}} --}}
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="female" name="gender" value="Female" {{
                                                        old('gender',$salon->gender) == "Female" ? 'checked' : '' }}
                                                    class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="female">{{__('Female')}}</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-2">
                                                    <input type="radio" id="both" name="gender" value="Both" {{
                                                        old('gender',$salon->gender) == "Both" ? 'checked' : '' }}
                                                    class="custom-control-input" >
                                                    <label class="custom-control-label"
                                                        for="both">{{__("Both")}}</label>
                                                </div>

                                            </div>

                                            {{-- Website --}}
                                            <div class="form-group">
                                                <label for="website" class="form-control-label">{{__('Website
                                                    Name')}}</label>
                                                <input type="text" class="form-control"
                                                    value="{{old('website', $salon->website)}}" name="website"
                                                    id="website" placeholder="{{__('Website name')}}">
                                                @error('website')
                                                <div class="invalid-div">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Phone no --}}
                                            <div class="form-group">
                                                <label for="phone" class="form-control-label">{{__('Phone no')}}</label>
                                                <input type="text" class="form-control"
                                                    value="{{old('phone', $salon->phone)}}" name="phone" id="phone"
                                                    placeholder="{{__('Phone Number')}}">
                                                @error('phone')
                                                <div class="invalid-div">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Tab 2 Salon Logo --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                            aria-labelledby="tabs-icons-text-2-tab">
                                            <h4 class="card-title">{{__('Salon Logo')}}</h4>

                                            {{-- Image --}}
                                            <div class="form-group">
                                                <label class="form-control-label">{{__('Salon Image')}}</label><br>
                                                <input type="file" id="image" name="image" accept="image/*"
                                                    onchange="loadFile(event)"><br>
                                                <img id="output" class="uploadprofileimg mt-3"
                                                    src="{{asset('storage/images/salon logos/'.$salon->image)}}" />
                                            </div>

                                            {{-- Logo --}}
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('Salon Logo')}} </label><br>
                                                <input type="file" name="logo" id="logo" accept="image/*"
                                                    onchange="loadFile1(event)"><br>
                                                <img src="{{asset('storage/images/salon logos/'.$salon->logo)}}"
                                                    id="black_logo_output" class="mt-2 logo_size">
                                            </div>

                                        </div>

                                        {{-- Tab 3 timings --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel"
                                            aria-labelledby="tabs-icons-text-3-tab">
                                            <h4 class="card-title">{{__('Salon Timings')}}</h4>
                                            <div>
                                                @php
                                                $base_url = url('/');
                                                @endphp

                                                {{-- timeslot --}}
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
                                                                        name="start_time_{{$workinghour->day_index}}[]" class="timepicker w-75" 
                                                                        value="{{$period->start_time}}"></td>
                                                                <td><input type="text"
                                                                        name="end_time_{{$workinghour->day_index}}[]" class="timepicker w-75" 
                                                                        value="{{$period->end_time}}"></td>
                                                                <td><button type="button" name="add" id="add-{{$workinghour->day_index}}"
                                                                        class="btn btn-primary add"
                                                                        onclick="addDay(event, '{{$workinghour->day_index}}')">{{__('Add Hours')}}</button></td>
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


                                            </div>
                                        </div>

                                        {{-- Tab 4 Salon Address --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel"
                                            aria-labelledby="tabs-icons-text-4-tab">
                                            <h4 class="card-title">{{__('Salon Address')}}</h4>
                                            <div>

                                                {{-- Address --}}
                                                <div class="form-group">
                                                    <label for="address"
                                                        class="form-control-label">{{__('Address')}}</label>
                                                    <textarea class="form-control" rows="4" id="address" name="address"
                                                        placeholder="{{__('Address of salon')}}">{{old('address', $salon->address)}}</textarea>
                                                    @error('address')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- Zipcode --}}
                                                <div class="form-group">
                                                    <label for="zipcode"
                                                        class="form-control-label">{{__('Zipcode')}}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{old('zipcode', $salon->zipcode)}}" name="zipcode"
                                                        id="zipcode" placeholder="{{__('Zipcode')}}">
                                                    @error('zipcode')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- City --}}
                                                <div class="form-group">
                                                    <label for="city" class="form-control-label">{{__('City')}}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{old('city', $salon->city)}}" name="city" id="city"
                                                        placeholder="{{__('City')}}">
                                                    @error('city')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- State --}}
                                                <div class="form-group">
                                                    <label for="state"
                                                        class="form-control-label">{{__('State')}}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{old('state', $salon->state)}}" name="state" id="state"
                                                        placeholder="{{__('State')}}">
                                                    @error('state')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- Country --}}
                                                <div class="form-group">
                                                    <label for="country"
                                                        class="form-control-label">{{__('Country')}}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{old('country', $salon->country)}}" name="country"
                                                        id="country" placeholder="{{__('Country')}}">
                                                    @error('country')
                                                    <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- Map --}}
                                                <div class="form-group">
                                                    <div class="mapsize my-0 mx-auto mb-4" id="location_map"></div>
                                                </div>

                                                {{-- Letitude --}}
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Latitude')}}</label>
                                                    <input type="text" class="form-control" value="{{$salon->latitude}}"
                                                        name="lat" id="lat" readonly>
                                                </div>

                                                {{-- Longitude --}}
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Longitude')}}</label>
                                                    <input type="text" class="form-control"
                                                        value="{{$salon->longitude}}" name="long" id="long" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="border-top">
                                            <div class="card-body text-center">
                                                <input type="submit" class="btn btn-primary rtl-float-none"
                                                    value="{{__('Submit')}}">
                                            </div>
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
@endsection