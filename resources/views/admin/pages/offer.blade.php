@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Offer'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <span class="h3">{{__('Offer table')}}</span>
            <button class="btn btn-primary addbtn float-right p-2 add_offer" id="add_offer"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</button>
          </div>
          <!-- table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort">{{__('#')}}</th>
                    <th scope="col" class="sort">{{__('Image')}}</th>
                    <th scope="col" class="sort">{{__('Title')}}</th>
                    <th scope="col" class="sort">{{__('Discount')}}</th>
                    <th scope="col" class="sort">{{__('Created_at')}}</th>
                    <th scope="col" class="sort">{{__('Updated_at')}}</th>
                    <th scope="col" class="sort">{{__('Status')}}</th>
                    <th scope="col" class="sort">{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody class="list">
                @if (count($offers) != 0)
                      @foreach ($offers as $key => $offer)
                          <tr>
                              <th>{{$offers->firstItem() + $key}}</th>
                              <td>
                                  <img alt="Offer image" class="tableimage rounded" src="{{asset('storage/images/offer/'.$offer->image)}}">
                              </td>
                              <td>{{$offer->title}}</td>
                              <td>{{$offer->discount}}%</td>
                              <td>{{$offer->created_at}}</td>
                              <td>{{$offer->updated_at}}</td>
                              <td>
                                <label class="custom-toggle">
                                    <input type="checkbox" onchange="hideOffer({{$offer->id}})" {{$offer->status == 1?'checked': ''}}>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                </label>
                              </td>
                              <td class="table-actions">
                                @php
                                    $base_url = url('/');
                                @endphp
                                <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_offer({{$offer->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Offer')}}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_offer({{$offer->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Edit Offer')}}">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/offer',{{$offer->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete Offer')}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                              </td>
                          </tr>
                      @endforeach
                @else
                  <tr>
                      <th colspan="10" class="text-center">{{__('No Offers')}}</th>
                  </tr>
                @endif
              </tbody>
            </table>
            <div class="float-right mr-4 mb-1">
                {{ $offers->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@include('admin.offer.create')
@include('admin.offer.show')
@include('admin.offer.edit')
@endsection