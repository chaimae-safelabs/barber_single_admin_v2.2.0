<div class="container-fluid sidebar_open @if($errors->any()) show_sidebar_create @endif" id="add_language_sidebar">
    <div class="row">
        <div class="col">            
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{__('Create Offer')}}</span>
                    <button type="button" class="add_language close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_language_form" method="post" enctype="multipart/form-data" action="{{url('/admin/language')}}">
                    @csrf
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Language Name')}}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control" placeholder="{{__('Language Name')}}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="language_file">{{__('Language JSON File')}}</label><br>
                            <input type="file" name="language_file" id="language_file" accept="application/JSON"><br>
                            <div class="invalid-div "><span class="language_file"></span></div>
                        </div>
                        

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{__('Language Icon')}}</label><br>
                            <input type="file" name="image" id="image"  onchange="loadFile(event)"><br>
                            <img id="output" class="language_size mt-3"/>
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{__('Direction')}}</label>
                            <select name="direction" id="direction" class="form-control">
                                <option value="ltr">{{__('LTR')}}</option>
                                <option value="rtl">{{__('RTL')}}</option>
                            </select>
                            <div class="invalid-div "><span class="discount"></span></div>
                        </div>

                        <div class="text-center">
                            <button type="button" id="create_btn" onclick="all_create('create_language_form','language')" class="btn rtl-float-none btn-primary mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>