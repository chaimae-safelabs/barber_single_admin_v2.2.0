<div class="container-fluid  sidebar_open" id="show_coupon_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Coupon')}}</span>
                    <button type="button" class="show_coupon_close close">&times;</button>
                </div>
                <div class="table1">
                    <div class="row mt-3 mb-2">
                        <div class="col h4 text-right">{{__('Code :')}}</div>
                        <div class="col" id="coupon_code"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Description :')}}</div>
                        <div class="col" id="coupon_desc"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Maximum use :')}}</div>
                        <div class="col" id="coupon_max_use"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Used :')}}</div>
                        <div class="col" id="coupon_use_count"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Type :')}}</div>
                        <div class="col" id="coupon_type"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Discount :')}}</div>
                        <div class="col" id="coupon_discount"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{__('Start date :')}}</div>
                        <div class="col" id="coupon_start_date"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col h4 text-right">{{('End date :')}}</div>
                        <div class="col" id="coupon_end_date"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>