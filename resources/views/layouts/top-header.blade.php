<?php $bg_img = \App\AdminSetting::find(1)->bg_img; ?>
<div class="header pt-7" style="background-image: url({{asset('storage/images/app/'.$bg_img)}}); background-size: cover; background-position: center center;">
    <span class="mask bg-gradient-dark opacity-7"></span>
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4 pb-7">
          <div class="col-lg-6 col-7">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item text-white"><a href="{{url('admin/dashboard')}}"><i class="fas fa-home text-salon"></i></a></li>
                @if (isset($headerData) && $headerData)
                    <li class="breadcrumb-item text-white"><a href="{{url($url)}}" class="text-salon">{{$headerData}}</a></li>
                @endif
                <li class="breadcrumb-item active text-white" aria-current="page">&nbsp;{{$title}} </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
</div>