<div class="container-fluid  sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Service')}}</span>
                    <button type="button" class="edit_service_close close">&times;</button>
                </div>
                <div class="mx-4">
                    <form class="form-horizontal" id="edit_service_form" action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-0">
                            <div class="form-group">
                                <label class="form-control-label" for="name">{{__('Service Name')}}</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="{{__('Service Nam')}}e"  autofocus>
                                <div class="invalid-div "><span class="name"></span></div>
                            </div>
                             
                            <div class="form-group">
                                <label class="form-control-label" for="cat_id">{{__('Select Category')}}</label>
                                <select class="form-control select2" name="cat_id" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->cat_id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-div "><span class="cat_id"></span></div>
                            </div>  

                            <div class="form-group">
                                <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                                <input type="file" name="image" id="image"  onchange="loadFile_edit(event)"><br>
                                <img src="" id="output_edit" class="mt-3 offer_size h-50 w-50">
                            </div>
                            

                            <div class="form-group">
                                <label class="form-control-label" for="image">{{__('Service For')}}</label><br>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="Male" name="gender" value="Male" class="custom-control-input">
                                    <label class="custom-control-label" for="Male">{{__('Male')}}</label>
                                </div>
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" id="Female" name="gender" value="Female" class="custom-control-input">
                                    <label class="custom-control-label" for="Female">{{__('Female')}}</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="Both" name="gender" value="Both" class="custom-control-input">
                                    <label class="custom-control-label" for="Both">{{__('Both')}}</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-control-label" for="price">{{__('Service Price')}}</label>
                                <input type="text"name="price" id="price" class="form-control" placeholder="{{__('Service Price')}}" >
                                <div class="invalid-div "><span class="price"></span></div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="time">{{__('Service Time (Minutes)')}}</label>
                                <input type="text" name="time" id="time" class="form-control" placeholder="{{__('Service Time')}}" >
                                <div class="invalid-div "><span class="time"></span></div>
                            </div>

                            <input type="hidden" name="id">

                            <div class="text-center">
                                <button type="button" onclick="all_edit('edit_service_form','services')" class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>