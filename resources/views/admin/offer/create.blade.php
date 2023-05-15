<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_offer_sidebar">
    <div class="row">
        <div class="col">            
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Offer')}}</span>
                    <button type="button" class="add_offer close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_offer_form" method="post" enctype="multipart/form-data" action="{{url('/admin/offer')}}">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="title">{{__('Title')}}</label>
                            <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control" placeholder="{{__('Offer Title')}}" autofocus>
                            <div class="invalid-div "><span class="title"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)"><br>
                            <img id="output" class="offer_size mt-3"/>
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="discount">{{__('Discount')}} (In percentage)</label>
                            <input type="number" value="{{ old('discount') }}" min="0" max="100" name="discount" id="discount" class="form-control" placeholder="{{__('Offer Discount')}}">
                            <div class="invalid-div "><span class="discount"></span></div>

                        </div>

                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_offer_form','offer')" class="btn rtl-float-none btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>