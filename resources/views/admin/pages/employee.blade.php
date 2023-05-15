
@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Employee'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Employee table')}}</span>
                    <button class="btn btn-primary addbtn float-right p-2"><a class="color-white" href="{{url('admin/employee/create')}}"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</a></button>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">{{__('#')}}</th>
                            <th scope="col" class="sort">{{__('Image')}}</th>
                            <th scope="col" class="sort">{{__('Name')}}</th>
                            <th scope="col" class="sort">{{__('Service')}}</th>
                            <th scope="col" class="sort">{{__('Status')}}</th>
                            <th scope="col" class="sort">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @if (count($emps) != 0)
                            @foreach ($emps as $key => $emp)
                                <tr>
                                    <th>{{$emps->firstItem() + $key}}</th>
                                    <td>
                                        <img src="{{asset('storage/images/employee/'.$emp->image)}}" class="tableimage rounded">
                                    </td>
                                    <td>{{$emp->name}}</td>
                                    <td>
                                        <div class="avatar-group">
                                            @foreach ($emp->services as $service)
                                                <a href="#" class="avatar avatar-sm rounded-circle " data-toggle="tooltip" data-original-title="{{$service->name}}">
                                                    <img alt="service" class="service_icon" src="{{asset('storage/images/services/'.$service->image)}}">
                                                </a>    
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"  onchange="hideEmp({{$emp->emp_id}})" {{$emp->status == 1?'checked': ''}}>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                        </label>
                                    </td>
                                    <td class="table-actions">
                                        @php
                                            $base_url = url('/');
                                        @endphp
                                        <a href="{{url('admin/employee/'.$emp->emp_id)}}" class="table-action text-warning" data-toggle="tooltip" data-original-title="{{__('View employee')}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{url('admin/employee/edit/'.$emp->emp_id)}}" class="table-action text-info" data-toggle="tooltip" data-original-title="{{__('Edit employee')}}">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/employee',{{$emp->emp_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete employee')}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tr>
                        @else
                            <tr>
                                <th colspan="10" class="text-center">{{__('No employees')}}</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="float-right mr-4 mb-1">
                    {{ $emps->links() }}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection