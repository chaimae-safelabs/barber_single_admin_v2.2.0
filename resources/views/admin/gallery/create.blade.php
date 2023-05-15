<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_gallery_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Add Gallery Image')}}</span>
                    <button type="button" class="add_gallery close">&times;</button>
                </div>
                <form class="form-horizontal"  id="create_gallery_form" method="post" enctype="multipart/form-data" action="{{url('/admin/gallery')}}">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" name="image" id="image"  onchange="loadFile(event)"><br>
                            <img id="output" class="banner_size mt-3"/>
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_gallery_form','gallery')" class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Add') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>