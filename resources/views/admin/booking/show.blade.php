<div class="container-fluid  sidebar_open" id="show_booking_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Appointment')}}</span>
                    <button type="button" class="show_booking_close close">&times;</button>
                </div>
                <div class="card card-profile shadow mt-5">
                    <div class="row justify-content-center">
                        <div class="card-profile-image">
                            <img src="" class="rounded-circle user_img owner_img_round">
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4 mt-8">
                        <div class="text-center">
                            <h3 id="user_name"></h3>

                            <div class="h4 font-weight-400" id="user_email"></div>
                            <div class="h4 font-weight-400" id="user_phone"></div>

                            <hr class="my-4" />
                            <div class="table1">
                                <div class="row mt-3 mb-2">
                                    <div class="col h4 text-right">{{__('Booking Id :')}}</div>
                                    <div class="col text-left" id="booking_id_main"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right">{{__('Services :')}}</div>
                                    <div class="col text-left" id="services_all"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right">{{__('Date :')}}</div>
                                    <div class="col text-left" id="app_date"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right">{{__('Duration :')}}</div>
                                    <div class="col text-left" id="service_time"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right">{{__('Payment :')}}</div>
                                    <div class="col text-left" id="app_payment"></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col h4 text-right">{{__('Employee Name :')}}</div>
                                    <div class="col text-left" id="emp_name"></div>
                                </div>
                            </div>
                            
                            <hr class="my-4" />

                            <div class="text-center">
                                <a href="#" class="btn btn-primary mt-4 mb-5 rtl-float-none view_invoice">{{ __('View Invoice') }}</a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>