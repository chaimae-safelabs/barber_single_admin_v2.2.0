@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Service'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Services table')}}</span>
                    <button class="btn btn-primary addbtn float-right p-2 add_service" id="add_service"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</button>

                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort">{{__('#')}}</th>
                            <th scope="col" class="sort">{{__('Image')}}</th>
                            <th scope="col" class="sort">{{__('Name')}}</th>
                            <th scope="col" class="sort">{{__('Category')}}</th>
                            <th scope="col" class="sort">{{__('Time')}}</th>
                            <th scope="col" class="sort">{{__('Price')}}</th>
                            <th scope="col" class="sort">{{__('Status')}}</th>
                            <th scope="col" class="sort">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @if (count($services) != 0)
                            @foreach ($services as $key => $service)
                                <tr>
                                    <th>{{$services->firstItem() + $key}}</th>
                                    <td>
                                        <img src="{{asset('storage/images/services/'.$service->image)}}" class="tableimage rounded">
                                    </td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->category->name}}</td>
                                    <td>{{$service->time}} {{__('Min')}}</td>
                                    <td>{{$symbol}}{{$service->price}}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input type="checkbox"  onchange="hideService({{$service->service_id}})" {{$service->status == 1?'checked': ''}}>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                        </label>
                                    </td>
                                    <td class="table-actions">
                                        @php
                                            $base_url = url('/');
                                        @endphp
                                        <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_service({{$service->service_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Service')}}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_service({{$service->service_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Edit Service')}}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>
                                        <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/services',{{$service->service_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete Service')}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        
                        @else
                            <tr>
                                <th colspan="11" class="text-center">{{__('No Services')}}</th>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
                <div class="float-right mr-4 mb-1">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


@include('admin.service.create')
@include('admin.service.show')
@include('admin.service.edit')
@endsection