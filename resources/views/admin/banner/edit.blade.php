<div class="container-fluid  sidebar_open @if($errors->any()) show_sidebar_edit @endif" id="edit_banner_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Edit Banner')}}</span>
                    <button type="button" class="edit_banner_close close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_banner_form" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Title')}}</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="{{__('Banner Title')}}" autofocus>
                            <div class="invalid-div "><span class="title"></span></div>
                        </div>
                        
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Image')}}</label><br>
                            <input type="file" name="image" id="image"  onchange="loadFile_edit(event)"><br>
                            <img src="" id="output_edit" class="mt-3 banner_size">
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="button" onclick="all_edit('edit_banner_form','banner')" class="btn btn-primary mt-4 mb-5 rtl-float-none">{{__('Save Changes')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>