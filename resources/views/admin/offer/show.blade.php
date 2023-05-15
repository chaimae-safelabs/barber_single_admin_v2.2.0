<div class="container-fluid  sidebar_open" id="show_offer_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Offer')}}</span>
                    <button type="button" class="show_offer_close close">&times;</button>
                </div>
                <div class="card card-profile shadow ">
                    <div class="card-body p-2">
                        <div class="text-center">
                            
                            <div id="offer_title"></div>
                            <img src="" class="salon_size my-3">
                            <div>{{__('Discount :')}} <span id="offer_discount"></span>%</div>
                            
                            <div class="text-center">
                                <button type="button" onclick="" class="btn edit_offer_btn rtl-float-none rtl-float-none btn-primary mt-4 mb-5">{{ __('Edit Offer') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>