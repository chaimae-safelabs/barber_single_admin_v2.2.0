<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Service')}}</span>
                    <button type="button" class="add_service close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_service_form" method="post" enctype="multipart/form-data" action="{{url('/admin/service')}}">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Service Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Service Name')}}"  autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" value="{{ old('image') }}" name="image" id="image"  onchange="loadFile(event)" ><br>
                            <img id="output" class="mt-3 offer_size h-50 w-50">
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Service For')}}</label><br>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="customRadio1" name="gender" value="Male" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">{{__('Male')}}</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="customRadio2" name="gender" value="Female" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">{{__('Female')}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="gender" value="Both" class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadio3">{{__('Both')}}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="price">{{__('Service Price')}}</label>
                            <input type="text" value="{{ old('price') }}" name="price" id="price" class="form-control" placeholder="{{__('Service Price')}}" >
                            <div class="invalid-div "><span class="price"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="time">{{__('Service Time (Minutes)')}}</label>
                            <input type="text" value="{{ old('time') }}" name="time" id="time" class="form-control" placeholder="{{__('Service Time')}}" >
                            <div class="invalid-div "><span class="time"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="cat_id">{{__('Select Category')}}</label>
                            <select class="form-control" name="cat_id"  value="{{ old('cat_id') }}">
                                @foreach ($categories as $category)
                                    <option value="{{$category->cat_id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="cat_id"></span></div>
                        </div>
                        
                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_service_form','services')" class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>