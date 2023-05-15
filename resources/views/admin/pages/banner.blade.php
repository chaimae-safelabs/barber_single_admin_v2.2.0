@extends('layouts.app')
@section('content')


@include('layouts.top-header', [
        'title' => __('Banner') ,
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header border-0">
            <span class="h3">{{__('Banner table')}}</span>
            <button class="btn btn-primary addbtn float-right p-2 add_banner" id="add_banner"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</button>
          </div>
          <!-- table -->
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort">{{__('#')}}</th>
                    <th scope="col" class="sort">{{__('Image')}}</th>
                    <th scope="col" class="sort">{{__('Title')}}</th>
                    <th scope="col" class="sort">{{__('Created_at')}}</th>
                    <th scope="col" class="sort">{{__('Updated_at')}}</th>
                    <th scope="col" class="sort">{{__('Status')}}</th>
                    <th scope="col" class="sort">{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody class="list">
                @if (count($banners) != 0)
                    @foreach ($banners as $key => $image)
                        <tr>
                            <th>{{$banners->firstItem() + $key}}</th>
                            <td>
                                <img alt="Image placeholder" class="tableimage rounded" src="{{asset('storage/images/banner/'.$image->image)}}">
                            </td>
                            <td>{{$image->title}}</td>
                            <td>{{$image->created_at}}</td>
                            <td>{{$image->updated_at}}</td>
                            <td>
                                <label class="custom-toggle">
                                    <input type="checkbox"  onchange="hideBanner({{$image->id}})" {{$image->status == 1?'checked': ''}}>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                </label>
                            </td>
                            <td class="table-actions">
                            @php
                                $base_url = url('/');
                            @endphp
                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_banner({{$image->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Banner')}}r">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white" onclick="edit_banner({{$image->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Edit Banner')}}">
                                <i class="fas fa-user-edit"></i>
                            </button>
                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/banner',{{$image->id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete Banner')}}">
                                <i class="fas fa-trash"></i>
                            </button>
                            </td>
                        </tr>
                    </div>
                    @endforeach
                @else
                  <tr>
                    <th colspan="10" class="text-center">{{__('No Banners')}}</th>
                  </tr>
                @endif
              </tbody>
            </table>
            <div class="float-right mr-4 mb-1">
                {{ $banners->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@include('admin.banner.create')
@include('admin.banner.show')
@include('admin.banner.edit')
@endsection