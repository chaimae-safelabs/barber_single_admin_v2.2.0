<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_cat_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Category')}}</span>
                    <button type="button" class="add_cat close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_cat_form" action="{{url('/admin/categories')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Category Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" name="image" id="image" onchange="loadFile(event)" ><br>
                            <img id="output" class="cat_size mt-3  "/>
                            <div class="invalid-div "><span class="image"></span></div>                           
                        </div>

                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_cat_form','categories')" class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>