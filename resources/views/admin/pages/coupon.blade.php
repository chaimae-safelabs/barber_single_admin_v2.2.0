@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Coupon'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Coupon table')}}</span>
                    <button class="btn btn-primary addbtn float-right p-2 add_coupon" id="add_coupon"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</button>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">{{__('#')}}</th>
                                <th scope="col" class="sort">{{__('Code')}}</th>
                                <th scope="col" class="sort">{{__('Description')}}</th>
                                <th scope="col" class="sort">{{__('Discount')}}</th>
                                <th scope="col" class="sort">{{__('Status')}}</th>
                                <th scope="col" class="sort">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($coupons) != 0)
                                @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <th>{{$coupons->firstItem() + $key}}</th>
                                        <td>{{$coupon->code}}</td>
                                        <td>{{$coupon->desc}}</td>
                                        <td>
                                            @if ($coupon->type == 'Amount')
                                                {{$symbol}}{{$coupon->discount}}
                                            @else
                                                {{$coupon->discount}}%
                                            @endif 
                                        </td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input type="checkbox"  onchange="hideCoupon({{$coupon->coupon_id}})" {{$coupon->status == 1?'checked': ''}}>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                            </label>
                                        </td>
                                        <td class="table-actions">
                                            @php
                                                $base_url = url('/');
                                            @endphp
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_coupon({{$coupon->coupon_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Coupon')}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_coupon({{$coupon->coupon_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Edit Coupon')}}">
                                                <i class="fas fa-user-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="10" class="text-center">{{__('No Coupons')}}</th>
                                </tr>
                            @endif
                                
                        </tbody>
                    </table>
                    <div class="float-right  mr-4 mb-1">
                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.coupon.create')
@include('admin.coupon.edit')
@include('admin.coupon.show')
@endsection