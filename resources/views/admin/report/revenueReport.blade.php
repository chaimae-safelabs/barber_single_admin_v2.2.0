@extends('layouts.app')
@section('content')

    @include('layouts.top-header', [
    'title' => __('Revenue Report'),
    'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Revenue Report') }}</span>
                    </div>
                    <form action="{{ url('/admin/report/revenue') }}" method="post" class="ml-4"
                        id="filter_revene_form">
                        @csrf
                        <div class="row rtl-date-filter-row">
                            <div class="form-group col-3">
                                <input type="text" id="filter_date" value="{{ $pass }}" name="filter_date"
                                    class="form-control" placeholder="{{ __('-- Select Date --') }}">

                                @if ($errors->any())
                                    <h4 class="text-center text-red mt-2">{{ $errors->first() }}</h4>
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
                                    <th></th>
                                    <th scope="col" class="sort">{{ __('Booking id') }}</th>
                                    <th scope="col" class="sort">{{ __('User Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Salon Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Date / Time') }}</th>
                                    <th scope="col" class="sort">{{ __('Payment') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @php
                                    $tot = 0;
                                @endphp
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->booking_id }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->salon->name }}</td>
                                        <td>{{ $booking->date }} {{ $booking->start_time }}</td>
                                        @php
                                            $tot = $tot + $booking->payment;
                                        @endphp
                                        <td>{{ $setting->currency_symbol }}{{ $booking->payment }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="total">
                                    <td colspan="4"></td>
                                    <td>{{ __('Grand Total :') }} </td>
                                    <td>{{ $setting->currency_symbol }}{{ $tot }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
