<div class="container-fluid  sidebar_open" id="show_review_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('View Reported Review')}}</span>
                    <button type="button" class="show_review_close close">&times;</button>
                </div>
                <div class="card card-profile shadow mt-5">
                    <div class="row justify-content-center">
                        <div class="card-profile-image">
                            <img src="" class="rounded-circle user_img owner_img_round">
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4 mt-8">
                        <div class="text-left">
                            <h3 class="text-center" id="user_name"></h3>

                            <div class="h4 font-weight-400" id="user_email"></div>
                            <div class="h4 font-weight-400" id="user_phone"></div>

                            <hr class="my-4" />
                            <div class="mb-2">
                                <span class="h3">{{__('Salon :')}} </span> <span id="salon_name"></span>
                            </div>
                            <span class="h3">{{__('Review :')}} </span> <span id="msg"></span>
                            
                            <div id="rate" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>