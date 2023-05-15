@extends('layouts.app')
@section('content')

    @include('layouts.top-header', [
    'title' => __('Users Report'),
    'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Users Report') }}</span>
                    </div>

                    <form action="{{ url('/admin/report/user') }}" method="post" class="ml-4"
                        id="filter_revene_form">
                        @csrf
                        <div class="row rtl-date-filter-row">
                            <div class="form-group col-3">
                                <input type="text" id="filter_date" value="{{ $pass }}" name="filter_date"
                                    class="form-control" placeholder="{{ __('-- Select Date --') }}">

                                @if ($errors->any())
                                    <h4 class="text-center text-red mt-2">{{ $errors->first() }}</h4>
                                @else
                                    <h4 class="text-center text-red mt-2"></h4>
                                @endif
                            </div>
                            <div class="form-group col-3">
                                <button type="submit" id="filter_btn"
                                    class="btn btn-primary rtl-date-filter-btn">{{ __('Apply') }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="dataTable" class="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col" class="sort">{{ __('Image') }}</th>
                                    <th scope="col" class="sort">{{ __('Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Email') }}</th>
                                    <th scope="col" class="sort">{{ __('Phone') }}</th>
                                    <th scope="col" class="sort">{{ __('Appointments') }}</th>
                                    <th scope="col" class="sort">{{ __('Registered date') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($users as $user)
                                    @php
                                        $appointment = 0;
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <img alt="Image placeholder" class="tableimage rounded"
                                                src="{{ asset('storage/images/users/' . $user->image) }}">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->code }}{{ $user->phone }}</td>
                                        <td>
                                            {{ $user->appointment }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                                        <td class="table-actions">
                                            <a href="{{ url('admin/users/' . $user->id) }}"
                                                class="table-action text-warning" data-toggle="tooltip"
                                                data-original-title="{{ __('View User') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
