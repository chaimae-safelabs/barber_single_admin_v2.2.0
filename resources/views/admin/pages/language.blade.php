@extends('layouts.app')
@section('content')

    @include('layouts.top-header', [
    'title' => __('Language'),
    'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Language table') }}</span>
                        <button class="btn btn-primary addbtn float-right p-2 add_language" id="add_language"><i
                                class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>
                        <a href="{{ url('download-sample') }}"
                            class="btn mr-3 btn-primary float-right p-2">{{ __('Sample .json') }}</a>

                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('Image') }}</th>
                                    <th scope="col" class="sort">{{ __('Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Direction') }}</th>
                                    <th scope="col" class="sort">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($languages) != 0)
                                    @foreach ($languages as $key => $language)
                                        <tr>
                                            <th>{{ $languages->firstItem() + $key }}</th>
                                            <td>
                                                <img alt="Language image" class="tableimage rounded language_flag"
                                                    src="{{ asset('storage/images/language/' . $language->image) }}">
                                            </td>
                                            <td>{{ $language->name }}</td>

                                            <td>
                                                <label class="custom-toggle">
                                                    <input type="checkbox"
                                                        onchange="changeDirection({{ $language->id }})"
                                                        {{ $language->direction == 'rtl' ? 'checked' : '' }}>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="LTR"
                                                        data-label-on="RTL"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="custom-toggle">
                                                    <input type="checkbox" onchange="hideLanguage({{ $language->id }})"
                                                        {{ $language->status == 1 ? 'checked' : '' }}>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="OFF"
                                                        data-label-on="ON"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">{{ __('No Languages') }}</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="float-right mr-4 mb-1">
                            {{ $languages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.language.create')
@endsection
