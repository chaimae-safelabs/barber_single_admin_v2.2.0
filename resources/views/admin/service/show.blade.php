<div class="container-fluid  sidebar_open" id="show_service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Service')}}</span>
                    <button type="button" class="show_service_close close">&times;</button>
                </div>
                <div class="card card-profile shadow ">
                    <div class="card-body p-2">
                        <div class="text-center">
                            
                            <div class="h3" id="service_name"></div>
                            <img src="" class="salon_size my-3 w-50 h-50">
                            
                            <div class="table1">
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right">{{__('Category :')}}</div>
                                    <div class="col text-left" id="cat_name"></div>
                                </div>  
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right">{{__('Price :')}}</div>
                                    <div class="col text-left" id="service_price"></div>
                                </div>  
                                <div class="row mt-1 mb-1">
                                    <div class="col h4 text-right">{{__('Time :')}}</div>
                                    <div class="col text-left" id="service_time"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>