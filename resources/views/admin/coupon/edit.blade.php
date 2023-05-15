<div class="container-fluid  sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_coupon_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Coupon')}}</span>
                    <button type="button" class="edit_coupon_close close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_coupon_form" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="my-0">

                        <div class="form-group">
                            <label for="desc" class="form-control-label">{{__('Description')}}</label>
                            <textarea class="form-control" rows="6" id="desc" name="desc" placeholder="Description of coupon" ></textarea>
                            <div class="invalid-div "><span class="desc"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{__('Type')}}</label><br>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="Percentage" name="type" value="Percentage" class="custom-control-input">
                                <label class="custom-control-label" for="Percentage">{{__('Percentage')}}</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="Amount" name="type" value="Amount" class="custom-control-input">
                                <label class="custom-control-label" for="Amount">{{__('Amount')}}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="discount">{{__('Discount')}}</label>
                            <input type="number" class="form-control" name="discount" id="discount" placeholder="Coupon Discount" >
                            <div class="invalid-div "><span class="discount"></span></div>
                        </div>

                        <div class="form-group">
                            <label for="max_use" class="form-control-label">{{__('Maximum use')}}</label>
                            <input type="number" class="form-control" name="max_use" id="max_use" placeholder="Maximum Use" >
                            <div class="invalid-div "><span class="max_use"></span></div>
                        </div>
                    
                        <div class="form-group">
                            <label for="start_date" class="form-control-label">{{__('Start date')}}</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start date" >
                            <div class="invalid-div "><span class="start_date"></span></div>
                        </div>

                        <div class="form-group">
                            <label for="end_date" class="form-control-label">{{__('End date')}}</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Start date" >
                            <div class="invalid-div "><span class="end_date"></span></div>
                        </div>
                        
                        <input type="hidden" name="id">

                        <div class="text-center">
                            <button type="button" onclick="all_edit('edit_coupon_form','coupon')" class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>