<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php $black_logo = \App\AdminSetting::find(1)->black_logo; ?>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{url('admin/dashboard')}}">
            <img src="{{asset('storage/images/app/'.$black_logo)}}" class="navbar-brand-img sidebar-logo" alt="...">
        </a>
        
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{asset('storage/images/users/'.Auth()->user()->image)}}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{url('/admin/profile/'.Auth::user()->id)}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{__('My profile')}}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('/admin/logout/')}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand pt-0" href="{{url('admin/dashboard')}}">
                            <img src="{{asset('storage/images/app/'.$black_logo)}}" class="navbar-brand-img" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            {{-- Main Admin --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard')  ? 'active' : ''}}" href="{{url('admin/dashboard')}}">
                        <i class="ni ni-tv-2 text-teal"></i>
                        <span class="nav-link-text">{{ __('Dashboard') }}</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/calendar*')  ? 'active' : ''}}" href="{{url('admin/calendar')}}">
                        <i class="ni ni-calendar-grid-58 text-pink"></i>
                        <span class="nav-link-text">{{ __('Calender') }}</span>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/booking*')  ? 'active' : ''}}" href="{{url('admin/booking')}}">
                    <i class="ni ni-collection text-blue"></i>
                    <span class="nav-link-text">{{ __('Booking') }}</span>
                    </a>
                </li>
                
                

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users*')  ? 'active' : ''}}" href="{{url('admin/users')}}">
                    <i class="fa fa-user text-cyan"></i>
                    <span class="nav-link-text">{{__('Client')}}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/categories*')  ? 'active' : ''}}" href="{{url('admin/categories')}}">
                    <i class="fa fa-list text-orange"></i>
                    <span class="nav-link-text">{{__('Category')}}</span>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/services*')  ? 'active' : ''}}" href="{{url('admin/services')}}">
                    <i class="fa fa-magic text-teal"></i>
                    <span class="nav-link-text">{{ __('Services') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/employee*')  ? 'active' : ''}}" href="{{url('admin/employee')}}">
                    <i class="fa fa-users text-orange"></i>
                    <span class="nav-link-text">{{ __('Employee') }}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/banner*')  ? 'active' : ''}}" href="{{url('admin/banner')}}">
                    <i class="fa fa-image  text-purple"></i>
                    <span class="nav-link-text">{{__('Banner')}}</span>
                    </a>
                </li>
                    
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/gallery*')  ? 'active' : ''}}" href="{{url('admin/gallery')}}">
                    <i class="fas fa-images  text-green"></i>
                    <span class="nav-link-text">{{ __('Gallery') }}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/coupon*')  ? 'active' : ''}}" href="{{url('admin/coupon')}}">
                    <i class="fas fa-tag text-orange"></i>
                    <span class="nav-link-text">{{__('Coupon')}}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/offer*')  ? 'active' : ''}}" href="{{url('admin/offer')}}">
                    <i class="fa fa-gift "></i>
                    <span class="nav-link-text">{{__('Offer')}}</span>
                    </a>
                </li>
                    
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/review*')  ? 'active' : ''}}" href="{{url('admin/review')}}">
                    <i class="fas fa-star text-yellow"></i>
                    <span class="nav-link-text">{{ __('Review') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/report*')  ? 'active_text' : ''}}" href="#navbar-examples1" data-toggle="collapse"  aria-expanded=" {{ request()->is('admin/report*')  ? 'true' : ''}}" role="button" aria-controls="navbar-examples">
                        <i class="fa fa-file text-blue"></i>
                        <span class="nav-link-text">{{__('Reports')}}</span>
                    </a>

                    <div class="collapse  {{ request()->is('admin/report*')  ? 'show' : ''}}" id="navbar-examples1">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/report/user*')  ? 'active_text' : ''}}" href="{{url('admin/report/user')}}">{{__('User Report')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/report/revenue*')  ? 'active_text' : ''}}" href="{{url('admin/report/revenue')}}">{{__('Revenue Report')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/notification*')  ? 'active' : ''}}" href="#navbar-examples" data-toggle="collapse"  aria-expanded=" {{ request()->is('admin/notification*')  ? 'true' : ''}}" role="button" aria-controls="navbar-examples">
                        <i class="fa fa-bell text-red"></i>
                        <span class="nav-link-text">{{__('Notification')}}</span>
                    </a>

                    <div class="collapse  {{ request()->is('admin/notification*')  ? 'show' : ''}}" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/notification/template')  ? 'active_text' : ''}}" href="{{url('admin/notification/template')}}">{{__('Template')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/notification/send')  ? 'active_text' : ''}}" href="{{url('admin/notification/send')}}">{{__('Send Notification')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/language*')  ? 'active' : ''}}" href="{{url('admin/language')}}">
                    <i class="fas fa-language text-pink"></i>
                    <span class="nav-link-text">{{__('Language')}}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/settings*')  ? 'active' : ''}}" href="{{url('admin/settings')}}">
                    <i class="fa fa-cog text-green"></i>
                    <span class="nav-link-text">{{__('Settings')}}</span>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>
