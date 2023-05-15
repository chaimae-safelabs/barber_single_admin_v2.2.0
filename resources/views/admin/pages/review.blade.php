@extends('layouts.app')
@section('content')

@include('layouts.top-header', [
        'title' => __('Review'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Review table')}}</span>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th scope="col" class="sort">{{__('Image')}}</th>
                                <th scope="col" class="sort">{{__('User Name')}}</th>
                                <th scope="col" class="sort">{{__('Message')}}</th>
                                <th scope="col" class="sort">{{__('Rate')}}</th>
                                <th scope="col" class="sort">{{__('Created_at')}}</th>
                                <th scope="col" class="sort">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @if (count($reviews) != 0)
                                @foreach ($reviews as $key => $review)
                                    <tr>
                                        <th>{{$reviews->firstItem() + $key}}</th>
                                        <td>
                                            <img src="{{asset('storage/images/users/'.$review->user->image)}}" class="tableimage rounded">
                                        </td>
                                        <td>{{$review->user->name}}</td>
                                        <td>{{ substr($review->message,0,30)}} {{ strlen($review->message) > 30 ? '....' : ""}}</td>
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star  {{$i<=$review->rate ? 'activerate' : ''}}"></i>
                                            @endfor
                                        </td>
                                        <td>{{$review->created_at}}</td>
                                       
                                        <td class="table-actions">
                                            @php
                                                $base_url = url('/');
                                            @endphp
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white" onclick="show_review({{$review->review_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('View Review')}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" onclick="deleteData('admin/review',{{$review->review_id}},'{{$base_url}}')" data-toggle="tooltip" data-original-title="{{__('Delete Review')}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="7" class="text-center">{{__('No review')}}</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right py-3">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.review.show')

@endsection