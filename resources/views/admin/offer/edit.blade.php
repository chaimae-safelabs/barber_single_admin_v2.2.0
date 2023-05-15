<div class="container-fluid  sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_offer_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Offer')}}</span>
                    <button type="button" class="edit_offer_close close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_offer_form" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="title">{{__('Title')}}</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="{{__('Offer Title')}}" autofocus>
                            <div class="invalid-div "><span class="title"></span></div>
                        </div>
                        
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" name="image" id="image" accept="image/*" onchange="loadFile_edit(event)"><br>
                            
                            <img src="" id="output_edit" class="mt-3 offer_size">
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="discount">{{__('Discount')}} (In percentage)</label>
                            <input type="number" name="discount" id="discount" max="100" min="0" class="form-control" placeholder="{{__('Offer Discount')}}">
                            <div class="invalid-div "><span class="discount"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="button" onclick="all_edit('edit_offer_form','offer')" class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Save Changes') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>