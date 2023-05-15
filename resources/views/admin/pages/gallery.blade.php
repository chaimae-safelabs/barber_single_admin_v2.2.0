@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Gallery'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Gallery table')}}</span>
                    <button class="btn btn-primary addbtn float-right p-2 add_gallery" id="add_gallery"><i class="fas fa-plus mr-1"></i>{{__('Add New')}}</button>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">{{__('#')}}</th>
                                <th scope="col" class="sort">{{__('Image')}}</th>
                                <th scope="col" class="sort">{{__('Created_at')}}</th>
                                <th scope="col" class="sort">{{__('Updated_at')}}</th>
                                <th scope="col" class="sort">{{__('Status')}}</th>
                                <th scope="col" class="sort">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($gallery) != 0)
                                @foreach ($gallery as $key => $image)
                                    <tr>
                                        <th>{{$gallery->firstItem() + $key}}</th>
                                        <td>
                                            <img src="{{asset('storage/images/gallery/'.$image->image)}}" class="tableimage rounded">
                                        </td>
                                        <td>{{$image->created_at}}</td>
                                        <td>{{$image->updated_at}}</td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input type="checkbox"  onchange="hideGallery({{$image->gallery_id}})" {{$image->status == 1?'checked': ''}}>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                            </label>
                                        </td>
                                        <td class="table-actions">
                                            @php
                                                $base_url = url('/');
                                            @endphp
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_gallery({{$image->gallery_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Image')}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/gallery',{{$image->gallery_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete Image')}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-center">{{__('No gallery image')}}</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right mr-4 mb-1">
                        {{ $gallery->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.gallery.create')
@include('admin.gallery.show')
@endsection