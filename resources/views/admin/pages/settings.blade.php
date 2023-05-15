@extends('layouts.app')
@section('content_setting')


@include('layouts.top-header', [
        'title' => __('Settings'),
        'class' => 'col-lg-7'
    ])

<div class="container-fluid mt--6 mb-5">
    <div class="row">
        <div class="col">
            <div class="card pb-6">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{__('Admin Settings')}}</span>
                    <?php $license_status = \App\AdminSetting::find(1)->license_status; ?>
                </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="nav-wrapper settings">
                                <ul class="nav navbar-nav nav-pills setting nav-fill" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $license_status == 1 ? 'active': '' }}" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-user mr-2"></i> {{__('OTP Verification')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-map-marker-alt mr-2"></i> {{__('Map')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-money-bill-alt mr-2"></i>{{__('Currency')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fa fa-bell mr-2"></i>{{__('Push Notification')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailShow" id="tabs-icons-text-11-tab" data-toggle="tab" href="#tabs-icons-text-11" role="tab" aria-controls="tabs-icons-text-11" aria-selected="false"><i class="far fa-envelope mr-2"></i>{{__('Email Settings')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-12-tab" data-toggle="tab" href="#tabs-icons-text-12" role="tab" aria-controls="tabs-icons-text-12" aria-selected="false"><i class="fas fa-sms mr-2"></i>{{__('SMS Gateway')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="far fa-credit-card mr-2"></i>{{__('Payment Gateway')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false"><i class="fa fa-gavel mr-2"></i>{{__('Terms & Condition')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-7-tab" data-toggle="tab" href="#tabs-icons-text-7" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false"><i class="fa fa-lock mr-2"></i>{{__('Privacy Policy')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-9-tab" data-toggle="tab" href="#tabs-icons-text-9" role="tab" aria-controls="tabs-icons-text-9" aria-selected="false"><i class="fa fa-cube mr-2"></i>{{__('App Settings')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-14-tab" data-toggle="tab" href="#tabs-icons-text-14" role="tab" aria-controls="tabs-icons-text-14" aria-selected="false"><i class="fa fa-share-alt mr-2"></i>{{__('App Sharing Settings')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left mailHide" id="tabs-icons-text-10-tab" data-toggle="tab" href="#tabs-icons-text-10" role="tab" aria-controls="tabs-icons-text-10" aria-selected="false"><i class="fas fa-users-cog mr-2"></i>{{__('Admin Settings')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-left {{ $license_status == 0 ? 'active': '' }}" id="tabs-icons-text-13-tab" data-toggle="tab" href="#tabs-icons-text-13" role="tab" aria-controls="tabs-icons-text-13" aria-selected="true"><i class="fa fa-id-card mr-2"></i> {{__('License')}} </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-8">
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error!</strong> {{$errors->first()}}
                            </div>
                        @endif
                        <form class="form-horizontal form" id="settingform" action="{{url('/admin/settings/update/'.$setting->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                
                                        {{-- Tab 1 OTP Verification --}}
                                        <div class="tab-pane fade {{ $license_status == 1 ? 'active show': '' }}" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <h4 class="card-title">{{__('OTP Verification')}}</h4>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="user_verify">{{__('OTP Verification')}} </label>
                                                <div class="col-sm-9 mt-2">
                                                    
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="user_verify" value="1" name="user_verify" <?php if($setting->user_verify == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="user_verify_sms">{{__('SMS')}} </label>
                                                <div class="col-sm-9 mt-2">
                                                    
                                                    <label class="custom-toggle">
                                                        <input type="checkbox"id="user_verify_sms" value="1" name="user_verify_sms" <?php if($setting->sms == 0){ echo "disabled"; } ?> <?php if($setting->user_verify_sms == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="user_verify_email">{{__('Email')}} </label>
                                                <div class="col-sm-9 mt-2">
                                                    
                                                    <label class="custom-toggle">
                                                        <input type="checkbox"id="user_verify_email" value="1" name="user_verify_email" <?php if($setting->mail == 0){ echo "disabled"; } ?> <?php if($setting->user_verify_email == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tab 2 Map --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <div class="d-flex">
                                                <h4 class="card-title mr-1">{{__('Map')}}</h4>
                                                <a href="https://developers.google.com/maps/documentation" target="_blank"class="" data-toggle="tooltip" data-placement="top" title="Help">
                                                    <i class="fa fa-info-circle customFont"  aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">{{__('Map Key')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('mapkey', $setting->mapkey)}}" name="mapkey" id="mapkey" placeholder="{{__('Mapkey')}}">
                                                    @error('mapkey')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="radius">{{__('Radius')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('radius', $setting->radius)}}" name="radius" id="radius" placeholder="{{__('Radius')}}" >
                                                    @error('radius')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="latitude">{{__('Latitude')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('latitude', $setting->lat)}}" name="latitude" id="latitude" placeholder="{{__('Latitude')}}" >
                                                    @error('latitude')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="longitude">{{__('Longitude')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('longitude', $setting->lang)}}" name="longitude" id="longitude" placeholder="{{__('Longitude')}}" >
                                                    @error('longitude')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>

                                        {{-- Tab 3 Currency --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                            <h4 class="card-title">{{__('Currency')}}</h4>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">{{__('Select Currency')}}</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2" name="currency" id="currency" dir="{{ session()->has('direction')&& session('direction') == 'rtl'? 'rtl':''}}">
                                                        @foreach ($currency as $cur)
                                                            <option value="{{$cur->code}}" {{ (collect(old('currency'))->contains($cur->code)) ? 'selected':'' }} <?php if( $cur->code == $setting->currency){ echo "selected"; } ?>>{{$cur->currency}} ({{$cur->symbol}} - {{$cur->code}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tab 4 Notification --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                            <div class="d-flex">
                                                <h4 class="card-title mr-1">{{__('Push Notification')}}</h4>
                                                <a href="https://documentation.onesignal.com/docs/accounts-and-keys" target="_blank"class="" data-toggle="tooltip" data-placement="top" title="Help">
                                                    <i class="fa fa-info-circle customFont"  aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group row my-3">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="notification">{{__('Notification')}}</label>
                                                <div class="col-sm-9 mt-2">
                                                    
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="notification" value="1" name="notification" <?php if($setting->notification == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="app_id">{{__('App ID')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('app_id', $setting->app_id)}}" name="app_id" id="app_id" placeholder="{{__('App ID')}}">
                                                    @error('app_id')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="api_key">{{__('Api Key')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('api_key', $setting->api_key)}}" name="api_key" id="api_key" placeholder="{{__('Api Key')}}">
                                                    @error('api_key')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="auth_key">{{__('Auth Key')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('auth_key', $setting->auth_key)}}" name="auth_key" id="auth_key" placeholder="{{__('Auth Key')}}">
                                                    @error('auth_key')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="project_no">{{__('Project Number')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('project_no', $setting->project_no)}}" name="project_no" id="project_no" placeholder="{{__('Project Number')}}">
                                                    @error('project_no')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    
                                        {{-- Tab 11 Mail --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-11" role="tabpanel" aria-labelledby="tabs-icons-text-11-tab">
                                            <div class="d-flex">
                                                <h4 class="card-title mr-1">{{__('Email Settings')}}</h4>
                                                <a href="https://sendgrid.com/blog/what-is-an-smtp-server/" target="_blank"class="" data-toggle="tooltip" data-placement="top" title="Help">
                                                    <i class="fa fa-info-circle customFont"  aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <div class="form-group row my-3">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="mail">{{__('Email')}}</label>
                                                <div class="col-sm-9 mt-2">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="mail" value="1" name="mail" <?php if($setting->mail == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="mail_host">{{__('Mail Host')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('mail_host', $setting->mail_host)}}" name="mail_host" id="mail_host" placeholder="{{__('Mail Host')}}">
                                                    @error('mail_host')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="mail_port">{{__('Mail Port')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('mail_port', $setting->mail_port)}}" name="mail_port" id="mail_port" placeholder="{{__('Mail Port')}}">
                                                    @error('mail_port')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="mail_username">{{__('Mail UserName')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('mail_username', $setting->mail_username)}}" name="mail_username" id="mail_username" placeholder="{{__('Mail UserName')}}">
                                                    @error('mail_username')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="mail_password">{{__('Mail Password')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('mail_password', $setting->mail_password)}}" name="mail_password" id="mail_password" placeholder="{{__('Mail Password')}}">
                                                    @error('mail_password')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="sender_email">{{__('Sender Email ID')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('sender_email', $setting->sender_email)}}" name="sender_email" id="sender_email" placeholder="{{__('Sender Email ID')}}">
                                                    @error('sender_email')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       
                                        {{-- Tab 12 SMS --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-12" role="tabpanel" aria-labelledby="tabs-icons-text-12-tab">
                                            <div class="d-flex">
                                                <h4 class="card-title mr-1">{{__('SMS Gateway')}}</h4>
                                                <a href="https://www.twilio.com/docs/glossary/what-is-an-api-key" target="_blank"class="" data-toggle="tooltip" data-placement="top" title="Help">
                                                    <i class="fa fa-info-circle customFont"  aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <div class="form-group row my-3">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="sms">{{__('Enable SMS Notification')}}</label>
                                                <div class="col-sm-9 mt-2">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="sms" value="1" name="sms" <?php if($setting->sms == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="twilio_acc_id">{{__('Twilio Account ID')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('twilio_acc_id', $setting->twilio_acc_id)}}" name="twilio_acc_id" id="twilio_acc_id" placeholder="{{__('Twilio Account ID')}}">
                                                    @error('twilio_acc_id')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="twilio_auth_token">{{__('Twilio Auth Token')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('twilio_auth_token', $setting->twilio_auth_token)}}" name="twilio_auth_token" id="twilio_auth_token" placeholder="{{__('Twilio Auth Token')}}">
                                                    @error('twilio_auth_token')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="twilio_phone_no">{{__('Twilio Phone Number')}} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('twilio_phone_no', $setting->twilio_phone_no)}}" name="twilio_phone_no" id="twilio_phone_no" placeholder="{{__('Twilio Phone Number')}}">
                                                    @error('twilio_phone_no')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                        </div>


                                        {{-- Tab 5 Payment --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                            <div class="d-flex mr-1">
                                                <h4 class="card-title">{{__('Payment Gateway')}}</h4>
                                                <a href="https://stripe.com/docs/keys#obtain-api-keys" target="_blank"class="" data-toggle="tooltip" data-placement="top" title="Help">
                                                    <i class="fa fa-info-circle customFont"  aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="form-group row my-3">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="cod">COD {{__('(Cash On Delivery)')}}</label>
                                                <div class="col-sm-9 mt-2">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="cod" value="1" name="cod" <?php if($payment->cod == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group row my-3">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="stripe">{{__('Stripe')}}</label>
                                                <div class="col-sm-9 mt-2">
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" id="stripe" value="1" name="stripe" <?php if($payment->stripe == 1){ echo "checked"; } ?>>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                    </label>
                                                </div>
                                            </div>
                                       
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="stripe_public_key">{{__('Stripe Public key')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('stripe_public_key', $payment->stripe_public_key)}}" name="stripe_public_key" id="stripe_public_key" placeholder="{{__('Stripe Public key')}}">
                                                    @error('stripe_public_key')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label" for="stripe_secret_key">{{__('Stripe Secret key')}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control w-75" value="{{old('stripe_secret_key', $payment->stripe_secret_key)}}" name="stripe_secret_key" id="stripe_secret_key" placeholder="{{__('Stripe Secret key')}}">
                                                    @error('stripe_secret_key')                                    
                                                        <div class="invalid-div">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tab 6 Terms & Condition --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                            <h4 class="card-title">{{__('Terms & Condition')}}</h4>
                                            <textarea class="terms_conditions form-control" name="terms_conditions">{{$setting->terms_conditions}}</textarea>
                                        </div>

                                        {{-- Tab 7 Privacy Policy --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
                                            <h4 class="card-title">{{__('Privacy Policy')}}</h4>
                                            <textarea class="privacy_policy form-control" name="privacy_policy">{{$setting->privacy_policy}}</textarea>
                                        </div>

                                        {{-- Tab 9 App --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-9" role="tabpanel" aria-labelledby="tabs-icons-text-9-tab">
                                            <h4 class="card-title">{{__('App Settings')}}</h4>
                                            <div class="form-group">
                                                <label class="form-control-label" for="app_name">{{__('App Name')}}</label>
                                                <input type="text" name="app_name" value="{{old('app_name', $setting->app_name)}}" id="app_name" class="form-control" placeholder="{{__('Application Name')}}"  autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="app_version">{{__('Version')}}</label>
                                                <input type="text" name="app_version" value="{{old('app_version', $setting->app_version)}}" id="app_version" class="form-control" placeholder="{{__('Application Version')}}" >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="footer1">{{__('Footer 1')}}</label>
                                                <input type="text" name="footer1" value="{{old('footer1', $setting->footer1)}}" id="footer1" class="form-control" placeholder="{{__('Year')}}" >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="footer2">{{__('Footer 2')}}</label>
                                                <input type="text" name="footer2" value="{{old('footer2', $setting->footer2)}}" id="footer2" class="form-control" placeholder="{{__('All rights reserved')}}" >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('Favicon Icon')}} </label><br>
                                                <input type="file" name="favicon_icon" id="favicon_icon" accept="image/*" onchange="loadFile(event)"><br>
                                                <img src="{{asset('storage/images/app/'.$setting->favicon)}}" id="output" class="mt-2 favicon_size">

                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('Black Logo')}} </label><br>
                                                <input type="file" name="black_logo" id="black_logo" accept="image/*" onchange="loadFile1(event)"><br>
                                                <img src="{{asset('storage/images/app/'.$setting->black_logo)}}"  id="black_logo_output" class="mt-2 logo_size">

                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('White Logo')}} </label><br>
                                                <input type="file" name="white_logo" id="white_logo" accept="image/*" onchange="loadFile2(event)"><br>
                                                <img src="{{asset('storage/images/app/'.$setting->white_logo)}}" id="white_logo_output" class="mt-2 logo_size">

                                            </div>
                                        </div>
                                        
                                        {{-- Tab 13 App sharing settings 123 --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-14" role="tabpanel" aria-labelledby="tabs-icons-text-14-tab">
                                            <h4 class="card-title">{{__('App Sharing Settings')}}</h4>

                                            <div class="form-group">
                                                <label class="form-control-label" for="shared_name">{{__('Shared Name')}}</label>
                                                <input type="text" name="shared_name" value="{{old('app_name', $setting->shared_name)}}" id="shared_name" class="form-control" placeholder="{{__('Shared Name')}}"  autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="shared_url">{{__('Shared URL')}}</label>
                                                <input type="text" name="shared_url" value="{{old('shared_url', $setting->shared_url)}}" id="shared_url" class="form-control" placeholder="{{__('Shared URL')}}" >
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('Shared Image')}} </label><br>
                                                <input type="file" name="shared_image" id="shared_image" accept="image/*" onchange="loadFile4(event)"><br>
                                                <img src="{{asset('storage/images/app/'.$setting->shared_image)}}" id="shared_image_output" class="mt-2 bg_img">
                                            </div>
                                        </div>


                                        {{-- Tab 10 Admin --}}
                                        <div class="tab-pane fade" id="tabs-icons-text-10" role="tabpanel" aria-labelledby="tabs-icons-text-10-tab">
                                            <h4 class="card-title">{{__('Admin Settings')}}</h4>
                                            <div class="form-group">
                                                <label class="form-control-label"> {{__('Header Image')}} </label><br>
                                                <input type="file" name="bg_img" id="bg_img" accept="image/*" onchange="loadFile3(event)"><br>
                                                <img src="{{asset('storage/images/app/'.$setting->bg_img)}}" class="mt-5 bg_img" id="bg_img_output">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-color-input" class="form-control-label">{{__('Color')}}</label>
                                                <input class="form-control"  value="{{old('color', $setting->color)}}" type="color" id="color" name="color" id="example-color-input">
                                            </div>
                                        </div>
                                    </form>

                                        {{-- Tab 13 License --}}
                                        <div class="tab-pane fade {{ $license_status == 0 ? 'show active': '' }}" id="tabs-icons-text-13" role="tabpanel" aria-labelledby="tabs-icons-text-13-tab">
                                            <h4 class="card-title">{{__('License')}}</h4>
                                            <form class="form-horizontal form" id="settingform" action="{{url('/admin/license/update/'.$setting->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="license_code">{{__('License Code')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control w-75" value="{{old('license_code', $setting->license_code)}}" name="license_code" id="license_code" placeholder="{{__('License Code')}}" {{$license_status == 1 ? 'disabled':''}}>
                                                        @error('license_code')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 text-right control-label col-form-label" for="license_client_name">{{__('Client Name')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control w-75" value="{{old('license_client_name', $setting->license_client_name)}}" name="license_client_name" id="license_client_name" placeholder="{{__('Client Name')}}" {{$license_status == 1 ? 'disabled':''}}>
                                                        @error('license_client_name')                                    
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                @if(session('status'))
                                                    <h4 class="text-center text-red">{{ session('status') }}</h4>
                                                @endif

                                                @if ($license_status == 0)
                                                    <div class="border-top">
                                                        <div class="card-body text-center">
                                                            <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        @if ($license_status == 1)
                                            <div class="border-top">
                                                <div class="card-body text-center d-flex">
                                                    <div class="mr-2" style="display: none" id="test">
                                                        <input type="button" value="{{__('Test Mail')}}" data-toggle="modal" data-target="#exampleModalCenter" class=" btn btn-primary">
                                                    </div>
                                                    <div>
                                                        <input type="submit" class="btn btn-primary rtl-float-none" value="{{__('Submit')}}">
                                                    </div>                                                    
                                                </div>  
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">   
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{__('Test Mail')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <label class="col-form-label">{{__('Recipient Email for SMTP Testing')}}</label>
                <input type="text" name="mail_to" id="to" value="{{auth()->user()->email}}" required class="form-control @error('mail_to') is-invalid @enderror">
                <span class="text-danger" id="validate"></span>
                @error('mail_to') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-primary" id="TestMail" onclick="demo()">{{__('Send')}}</button>
            </div>
            <div class="emailstatus text-right mr-4"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
function demo(){
    var button = document.getElementById('TestMail');
    var mail_to = $('[name="mail_to"]').val(); 
    console.log(mail_to);
    if(mail_to == "")
    {
        $('#validate').text('Email Field Is Required.');
        return;
    }  else{
        button.addEventListener('click', function (event) {     
            event.preventDefault();
            $('.emailstatus').html('<div class=" mt-3"><h5>Sending...</h5></div>');
            $.ajax({
                type: "GET",
                data:  { to: mail_to },
                url: base_url + '/admin/test_mail',
                success: function (result) {
                    if (result.success == true) {
                        console.log(result);
                        $('#validate').html('');
                        $('.emailstatus').html('');
                        $('.emailstatus').html(' <div class="text-success mt-3"><h5>' + result.message + '</h5></div>');
                    } else if (result.success == false) {
                        $('.emailstatus').html('');
                        $('.emailstatus').html(' <div class="text-danger mt-3"><h5>' + result.message + '</h5></div>');
                        $('.emailerror').html(' <div class="text-danger mt-2"><p>' + result.data + '</p></div>');
                    }
                }
            });
        });
    }
}  
$(document).ready(function(){
    $(".mailShow").click(function(){
        $("#test").css("display", "block");
    });
    $(".mailHide").click(function(){
        $("#test").css("display", "none");
    });
});
</script>
@endsection