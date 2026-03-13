@extends('master.back')
@section('styles')
  <link rel="stylesheet" href="{{asset('assets/back/js/plugin/codemirror/codemirror.css')}}">
  <link rel="stylesheet" href="{{asset('assets/back/js/plugin/codemirror/monokai.css')}}">

  <link rel="stylesheet" href="{{asset('assets/back/js/plugin/Bootstrap-IconPicker/dist/css/bootstrap-iconpicker.min.css')}}">
@endsection
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 bc-title"><b>{{ __('Basic Information') }}</b></h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      @include('alerts.alerts')
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
      <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body ">
          <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-xl-3 col-lg-3">
                <div class="nav flex-column m-3 nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" data-toggle="pill" href="#basic">{{ __('Basic Information') }}</a>
                  <!-- <a class="nav-link" data-toggle="pill" href="#theme">{{ __('Home Page Themes') }}</a> -->
                  <a class="nav-link" data-toggle="pill" href="#media">{{ __('Media') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#seo">{{ __('Seo') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#links">{{ __('Menu') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#custom_css" id="newcss">{{ __('Custom Css') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#google_recaptcha">{{ __('Scripts') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#shop">{{ __('Shop & Checkout Page') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#footer">{{ __('Footer & Contact Page') }}</a>
                  <a class="nav-link" data-toggle="pill" href="#whatsapp">{{ __('WhatsApp') }}</a>
                </div>
              </div>
              <div class="col-xl-9 col-lg-9">
                <input type="hidden" name="is_validate" value="1">
                <div class="">
                  <div id="tabs">
                    <div class="tab-content">
                      <div id="basic" class="tab-pane active"><br>
                        <div class="row justify-content-start">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="title">{{ __('App Name') }} *</label>
                              <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Website Title') }}" value="{{ $setting->title }}" >
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="ruc">{{ __('RUC') }} *</label>
                              <input type="text" name="ruc" class="form-control" id="ruc" placeholder="{{ __('Enter Website RUC') }}" value="{{ $setting->ruc }}" maxlength="11">
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="home_page_title">{{ __('Home Page Title') }} *</label>
                              <input type="text" name="home_page_title" class="form-control" id="home_page_title" placeholder="{{ __('Enter Home Page Title') }}" value="{{ $setting->home_page_title }}" >
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="primary_color">{{ __('Primary Colour Code') }} *</label>
                              <input type="text" data-jscolor="" name="primary_color" class="form-control" id="primary_color" placeholder="{{ __('Enter Website Primary Colour Code') }}" value="{{ $setting->primary_color }}" >
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="is_decimal">{{ __('Decimal Separator') }} *</label>
                              <select name="is_decimal" id="is_decimal" class="form-control">
                                <option value="1" {{$setting->is_decimal == 1 ? 'selected' : ''}}>On</option>
                                <option value="0" {{$setting->is_decimal == 0 ? 'selected' : ''}}>Off</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="currency_direction">{{ __('Currency Direction') }} *</label>
                              <select name="currency_direction" id="currency_direction" class="form-control">
                                <option value="1" {{$setting->currency_direction == 1 ? 'selected' : ''}}>{{__('Left ($100.00)')}}</option>
                                <option value="0" {{$setting->currency_direction == 0 ? 'selected' : ''}}>{{__('Right (100.00$)')}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="decimal_separator">{{ __('Decimal Separator') }} *</label>
                              <select name="decimal_separator" id="decimal_separator" class="form-control">
                                <option value="," {{$setting->decimal_separator == ',' ? 'selected' : ''}}>{{__('Comma (,)')}}</option>
                                <option value="." {{$setting->decimal_separator == '.' ? 'selected' : ''}}>{{__('Dot (.)')}}</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="thousand_separator">{{ __('Thousand Separator') }} *</label>
                              <select name="thousand_separator" id="thousand_separator" class="form-control">
                                <option value="," {{$setting->thousand_separator == ',' ? 'selected' : ''}}>{{__('Comma (,)')}}</option>
                                <option value="." {{$setting->thousand_separator == '.' ? 'selected' : ''}}>{{__('Dot (.)')}}</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="theme" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="select_theme">{{ __('Select Home Page') }} *</label>
                              <select class="form-control" name="theme" id="select_theme">
                                <option value="theme1" {{$setting->theme == 'theme1' ? 'selected' : ''}} >{{__('Home 1')}}</option>
                                <option value="theme2" {{$setting->theme == 'theme2' ? 'selected' : ''}}>{{__('Home 2')}}</option>
                                <option value="theme3" {{$setting->theme == 'theme3' ? 'selected' : ''}}>{{__('Home 3')}}</option>
                                <option value="theme4" {{$setting->theme == 'theme4' ? 'selected' : ''}}>{{__('Home 4')}}</option>
                              </select>
                            </div>
                            <ul class="nav nav-pills nav-justified nav-secondary nav-pills-no-bd">
                              <li class="nav-item">
                                <a class="nav-link {{$setting->theme == 'theme1' ? 'active' : ''}}" data-toggle="pill" href="#theme1">{{ __('Home 1') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link {{$setting->theme == 'theme2' ? 'active' : ''}}" data-toggle="pill" href="#theme2">{{ __('Home 2') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link {{$setting->theme == 'theme3' ? 'active' : ''}}" data-toggle="pill" href="#theme3">{{ __('Home 3') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link {{$setting->theme == 'theme4' ? 'active' : ''}}" data-toggle="pill" href="#theme4">{{ __('Home 4') }}</a>
                              </li>
                            </ul>
                            <div class="tab-content">
                              <div id="theme1" class="container tab-pane {{$setting->theme == 'theme1' ? 'active' : ''}}"><br>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <div class="col-lg-12 pb-1 text-center">
                                      <img class="admin-setting-img" src="{{ asset('assets/back/theme1.png')}}" alt="No Image Found">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="theme2" class="container tab-pane {{$setting->theme == 'theme2' ? 'active' : ''}}"><br>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <div class="col-lg-12 pb-1 text-center">
                                      <img class="admin-setting-img" src="{{ asset('assets/back/theme2.png')}}" alt="No Image Found">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="theme3" class="container tab-pane {{$setting->theme == 'theme3' ? 'active' : ''}}"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <div class="col-lg-12 pb-1 text-center">
                                        <img class="admin-setting-img" src="{{ asset('assets/back/theme3.png')}}" alt="No Image Found">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="theme4" class="container tab-pane {{$setting->theme == 'theme4' ? 'active' : ''}}"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <div class="col-lg-12 pb-1 text-center">
                                        <img class="admin-setting-img" src="{{ asset('assets/back/theme4.png')}}" alt="No Image Found">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="media" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <ul class="nav nav-pills nav-justified nav-secondary nav-pills-no-bd">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#logo">{{ __('Logo') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#favicon">{{ __('Favicon') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#loader">{{ __('Loader') }}</a>
                              </li>
                            </ul>
                            <div class="tab-content">
                              <div id="logo" class="container tab-pane active"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12 ">
                                    <div class="form-group">
                                      <label for="name">{{ __('Current Image') }}</label>
                                      <div class="col-lg-12 pb-1">
                                        <img class="admin-setting-img" src="{{ $setting->logo ? asset('assets/images/'.$setting->logo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
                                      </div>
                                      <span>{{ __('Image Size Should Be 140 x 40.') }}</span>
                                    </div>
                                    <div class="form-group position-relative ">
                                      <label class="file">
                                        <input type="file"  accept="image/*"  class="upload-photo" name="logo" id="file" aria-label="File browser example">
                                        <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="favicon" class="container tab-pane"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label for="name">{{ __('Current Image') }}</label>
                                      <div class="col-lg-12 pb-1">
                                        <img class="admin-setting-img my-mw-100" src="{{ $setting->favicon ? asset('assets/images/'.$setting->favicon) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
                                      </div>
                                      <span>{{ __('Image Size Should Be 16 x 16.') }}</span>
                                    </div>
                                    <div class="form-group position-relative ">
                                      <label class="file">
                                        <input type="file"  accept="image/*"  class="upload-photo" name="favicon" id="file" aria-label="File browser example">
                                        <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="loader" class="container tab-pane"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap " name="is_loader" value="1" {{ $setting->is_loader == 1 ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                        <span class="switch-text">{{ __('Display Loader') }}</span>
                                      </label>
                                    </div>
                                    <div class="form-group">
                                      <label for="name">{{ __('Current Image') }}</label>
                                      <div class="col-lg-12 pb-1">
                                        <img class="admin-setting-img my-mw-100" src="{{ $setting->loader ? asset('assets/images/'.$setting->loader) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
                                      </div>
                                    </div>
                                    <div class="form-group position-relative ">
                                      <label class="file">
                                        <input type="file"  accept="image/*"  class="upload-photo" name="loader" id="file" aria-label="File browser example">
                                        <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                      </label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="seo" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label for="meta_keywords">{{ __('Site Meta Keywords') }} *</label>
                              <input type="text" name="meta_keywords" class="tags" id="meta_keywords" placeholder="{{ __('Site Meta Keywords') }}" value="{{ $setting->meta_keywords }}" >
                            </div>
                            <div class="form-group">
                              <label for="meta_description">{{ __('Site Meta Description') }} *</label>
                              <textarea name="meta_description" id="meta_description" class="form-control" rows="5" placeholder="{{ __('Enter Site Meta Description') }}">{{ $setting->meta_description }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="custom_css" class="tab-pane">
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label>{{ __('Custom Css') }} *</label>
                              <textarea name="custom_css"  class="form-control" id="custom_css_area" placeholder="{{ __('Custom Css') }}">{{ $setting->custom_css }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="links" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_shop" value="1" {{ $setting->is_shop == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Shop') }}</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_blog" value="1" {{ $setting->is_blog == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Blog') }}</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_campaign" value="1" {{ $setting->is_campaign == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Campaign') }}</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_brands" value="1" {{ $setting->is_brands == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Brand') }}</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_faq" value="1" {{ $setting->is_faq == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Faq') }}</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_contact" value="1" {{ $setting->is_contact == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Display Contact') }}</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="footer" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <ul class="nav nav-pills nav-justified nav-secondary nav-pills-no-bd">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#footer_basic">{{ __('Basic') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#footer_link">{{ __('Social Link') }}</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#working_days">{{ __('Working Days') }}</a>
                              </li>
                            </ul>
                            <div class="tab-content">
                              <div id="footer_basic" class="container tab-pane active"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label for="footer_address">{{ __('Store Address') }} *</label>
                                      <input type="text" name="footer_address" class="form-control" id="footer_address" placeholder="{{ __('Store Address') }}" value="{{ $setting->footer_address }}" >
                                    </div>
                                    <div class="form-group">
                                      <label for="footer_phone">{{ __('Store Phone Number') }} *</label>
                                      <input type="text" name="footer_phone" class="form-control" id="footer_phone" placeholder="{{ __('Store Phone Number') }}" value="{{ $setting->footer_phone }}" >
                                    </div>
                                    <div class="form-group">
                                      <label for="footer_email">{{ __('Store Email') }} *</label>
                                      <input type="email" name="footer_email" class="form-control" id="footer_email" placeholder="{{ __('Store Email') }}" value="{{ $setting->footer_email }}" >
                                    </div>
                                    <div class="form-group">
                                      <label for="footer_gateway_img">{{ __('Current Gateway Image') }}</label>
                                      <div class="col-lg-12 pb-1">
                                        <img class="admin-setting-img" src="{{ $setting->footer_gateway_img ? asset('assets/images/'.$setting->footer_gateway_img) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
                                      </div>
                                      <span>{{ __('Image Size Should Be 324 x 31.') }}</span>
                                    </div>
                                    <div class="form-group position-relative ">
                                      <label class="file">
                                        <input type="file"  accept="image/*"  class="upload-photo" name="footer_gateway_img" id="footer_gateway_img" aria-label="File browser example">
                                        <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                      </label>
                                    </div>
                                    <div class="form-group">
                                      <label for="copy_right">{{ __('Copyright') }} *</label>
                                      <textarea name="copy_right" id="copy_right" class="form-control" rows="3" placeholder="{{ __('Copyright') }}">{{ $setting->copy_right }}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="footer_link" class="container tab-pane"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div id="social-section">
                                      @php
                                      $links = json_decode($setting->social_link,true)['links'];
                                      $icons = json_decode($setting->social_link,true)['icons'];
                                      @endphp
                                      @foreach ($links as $link_key => $link)
                                      <div class="d-flex">
                                        <div>
                                          <div class="form-group">
                                            <button class="btn btn-secondary social-picker" name="social_icons[]" data-icon="{{$icons[$link_key]}}" role="iconpicker"></button>
                                          </div>
                                        </div>
                                        <div class="flex-grow-1">
                                          <div class="form-group">
                                            <input type="text" class="form-control" name="social_links[]" placeholder="{{ __('Social Link') }}" value="{{$link}}">
                                          </div>
                                        </div>
                                        <div class="flex-btn">
                                          <button type="button" class="btn btn-danger remove-social"> <i class="fa fa-minus"></i> </button>
                                        </div>
                                      </div>
                                      @endforeach
                                    </div>
                                    <div class="flex-btn">
                                      <button type="button" class="btn btn-success d-block w-100 add-social"><i class="fa fa-plus"></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="working_days" class="container tab-pane"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="friday_start">{{ __('Monday-Friday from') }} *</label>
                                      <input type="text" name="friday_start" class="form-control timepicker" id="friday_start" placeholder="{{ __('Monday-Friday from') }}" value="{{ $setting->friday_start }}" >
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="friday_end">{{ __('Till') }} *</label>
                                      <input type="text" name="friday_end" class="form-control timepicker" id="friday_end" placeholder="{{ __('Till') }}" value="{{ $setting->friday_end }}" >
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="satureday_start">{{ __('Saturday-Sunday from') }} *</label>
                                      <input type="text" name="satureday_start" class="form-control timepicker" id="satureday_start" placeholder="{{ __('Saturday-Sunday from') }}" value="{{ $setting->satureday_start }}" >
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="satureday_end">{{ __('Till') }} *</label>
                                      <input type="text" name="satureday_end" class="form-control timepicker" id="satureday_end" placeholder="{{ __('Till') }}" value="{{ $setting->satureday_end }}" >
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="google_recaptcha" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_google_analytics"  value="1" {{ $setting->is_google_analytics == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Enable Google Analytics') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label >{{ __('Google Analytics') }} *</label>
                              <textarea name="google_analytics" class="form-control" id="" placeholder="{{ __('Google Analytics') }}">{{ $setting->google_analytics }}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_google_adsense" value="1" {{ $setting->is_google_adsense == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Enable Google Adsense Code') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label >{{ __('Google Adsense Code') }} *</label>
                              <textarea name="google_adsense" class="form-control" id="" placeholder="{{ __('Google Adsense Code') }}">{{$setting->google_adsense}}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="recaptcha" value="1" {{ $setting->recaptcha == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Display Google Recaptcha') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label for="google_recaptcha_site_key">{{ __('Google Rechaptcha Site Key') }} *</label>
                              <input type="text" name="google_recaptcha_site_key" class="form-control" id="google_recaptcha_site_key" placeholder="{{ __('Google Rechaptcha Site Key') }}" value="{{ $setting->google_recaptcha_site_key }}" >
                            </div>
                            <div class="form-group">
                              <label for="google_recaptcha_secret_key">{{ __('Google Rechaptcha Secret Key') }}</label>
                              <input type="text" name="google_recaptcha_secret_key" class="form-control" id="google_recaptcha_secret_key" placeholder="{{ __('Google Rechaptcha Secret Key') }}" value="{{ $setting->google_recaptcha_secret_key }}" >
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_pixel" value="1" {{ $setting->is_facebook_pixel == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Display Facebook Pixel') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label>{{ __('Facebook Pixel') }} *</label>
                              <textarea name="facebook_pixel" class="form-control" id="" placeholder="{{ __('Facebook Pixel') }}">{{ $setting->facebook_pixel }}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_messenger" value="1" {{ $setting->is_facebook_messenger == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Display Facebook Messenger') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label>{{ __('Facebook Messenger') }} *</label>
                              <textarea name="facebook_messenger" class="form-control" id="" placeholder="{{ __('Facebook Messenger') }}">{{ $setting->facebook_messenger }}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_disqus" value="1" {{ $setting->is_disqus == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Display Disqus') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label>{{ __('Disqus Script') }} *</label>
                              <textarea name="disqus" class="form-control" id="" placeholder="{{ __('Disqus Script') }}">{{ $setting->disqus }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="shop" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_attribute_search"  value="1" {{ $setting->is_attribute_search == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Enable Filter By Attribute & Attribute Options') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status" name="is_range_search"  value="1" {{ $setting->is_range_search == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text">{{ __('Enable Filter By Price Range') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label for="view_product">{{ __('View Product') }} *</label>
                              <input type="text" name="view_product" class="form-control" id="view_product" placeholder="{{ __('View Product') }}" value="{{ $setting->view_product }}" >
                            </div>
                            <div class="form-group">
                              <label for="max_price">{{ __('Price Range Max') }} *</label>
                              <input type="text" name="max_price" class="form-control" id="max_price" placeholder="{{ __('Price Range Max') }}" value="{{ $setting->max_price }}" >
                            </div>
                            <hr>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_guest_checkout"  value="1" {{ $setting->is_guest_checkout == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Enable Guest Checkout') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label class="switch-primary">
                              <input type="checkbox" class="switch switch-bootstrap status" name="is_privacy_trams"  value="1" {{ $setting->is_privacy_trams == 1 ? 'checked' : '' }}>
                              <span class="switch-body"></span>
                              <span class="switch-text">{{ __('Enable Privacy & Terms Conditions') }}</span>
                              </label>
                            </div>
                            <div class="form-group">
                              <label for="policy_link">{{ __('Privacy Policy Link') }} *</label>
                              <input type="text" name="policy_link" class="form-control" id="policy_link" placeholder="{{ __('Privacy Policy') }}" value="{{ $setting->policy_link }}" >
                            </div>
                            <div class="form-group">
                              <label for="terms_link">{{ __('Terms of Service Link') }} *</label>
                              <input type="text" name="terms_link" class="form-control" id="terms_link" placeholder="{{ __('Terms of Service') }}" value="{{ $setting->terms_link }}" >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="whatsapp" class="tab-pane"><br>
                        <div class="row justify-content-center">
                          <div class="col-lg-8">
                            <div class="tab-content">
                              <div class="container"><br>
                                <div class="row justify-content-center">
                                  <div class="col-lg-12">
                                    <div id="wtspnumbers_number-section" class="cCt_wtpsNmbrs">
                                      <?php
                                        // echo "<pre>";
                                        // print_r($setting->whatsapp_numbers);
                                        // echo "</pre>";
                                      ?>
                                      @if(isset($setting->whatsapp_numbers) && $setting->whatsapp_numbers != "[]" && !empty($setting->whatsapp_numbers))
                                        <?php
                                          $whatsappCollection = json_decode($setting->whatsapp_numbers, TRUE);
                                          $ArrwpsNumbers = "";
                                          $wps_general = [];
                                          $wps_inproducts = [];
                                          if(isset($whatsappCollection['whatsapp_numbers'])){
                                            $ArrwpsNumbers = $whatsappCollection['whatsapp_numbers'];
                                            if(isset($ArrwpsNumbers['general'])){
                                              $wps_general = $ArrwpsNumbers['general'];
                                            }
                                            if(isset($ArrwpsNumbers['in_product'])){
                                              $wps_inproducts = $ArrwpsNumbers['in_product'];
                                            }
                                          }
                                        ?>
                                      <div class="cCt_wtpsNmbrs__c" id="wpsnumbsgadd_1Gdhj5-1lks">
                                        <div class="mb-3 d-flex align-items-center">
                                          <span style="display:inline-block;margin-right:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552" width="30px" height="30px"><defs><linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#57d163"/><stop offset="1" stop-color="#23b33a"/></linearGradient><filter id="a" width="1.115" height="1.114" x="-.057" y="-.057" color-interpolation-filters="sRGB"><feGaussianBlur stdDeviation="3.531"/></filter></defs><path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0" filter="url(#a)"/><path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"/><path fill="url(#linearGradient1780)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z"/><path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"/><path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"/></svg>
                                          </span>
                                          <h2><strong>WhatsApp General</strong></h2>
                                        </div>
                                        @foreach ($wps_general as $k => $v)
                                        <div class="d-flex cCt_wtpsNmbrs__c__m">
                                          <div class="flex-grow-1 cCt_wtpsNmbrs__c__m__i">
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_title[]" placeholder="" value="{{ $v['title'] }}">
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_text[]" placeholder="" value="{{ $v['text'] }}">
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_number[]" placeholder="" data-valformat="withspacesforthreenumbers" maxlength="9" value="{{ $v['number'] }}">
                                            </div>
                                          </div>
                                        </div>
                                        @endforeach
                                      </div>
                                      <br>
                                      <div class="cCt_wtpsNmbrs__c" id="wpsnumbsgadd_1Gdhj5-2lks">
                                        <div class="mb-3 d-flex align-items-center">
                                          <span style="display:inline-block;margin-right:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552" width="30px" height="30px"><defs><linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#57d163"/><stop offset="1" stop-color="#23b33a"/></linearGradient><filter id="a" width="1.115" height="1.114" x="-.057" y="-.057" color-interpolation-filters="sRGB"><feGaussianBlur stdDeviation="3.531"/></filter></defs><path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0" filter="url(#a)"/><path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"/><path fill="url(#linearGradient1780)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z"/><path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"/><path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"/></svg>
                                          </span>
                                          <h2><strong>WhatsApp para Productos</strong></h2>
                                        </div>
                                        <div id="wpsnumbsgadd_cC1Gdhj5-2lks">
                                          @foreach ($wps_inproducts as $k => $v)
                                          <div class="d-flex cCt_wtpsNmbrs__c__m">
                                            <div class="flex-grow-1 cCt_wtpsNmbrs__c__m__i">
                                              <div class="form-group">
                                                <input type="text" class="form-control" name="wtspnumbers_title[]" placeholder="Ingrese el título" value="{{ $v['title'] }}" required>
                                              </div>
                                              <div class="form-group">
                                                <input type="text" class="form-control" name="wtspnumbers_text[]" placeholder="Ingrese el texto" value="{{ $v['text'] }}" required>
                                              </div>
                                              <div class="form-group">
                                                <input type="text" class="form-control" name="wtspnumbers_number[]" placeholder="Ingrese el número" data-valformat="withspacesforthreenumbers" maxlength="9" value="{{ $v['number'] }}" required>
                                              </div>
                                            </div>
                                            <div class="flex-btn pr-2">
                                              <button type="button" class="btn btn-danger remove-social">
                                                <i class="fa fa-minus"></i>
                                              </button>
                                            </div>
                                          </div>
                                          @endforeach
                                        </div>
                                      </div>
                                      @else
                                      <div class="cCt_wtpsNmbrs__c" id="wpsnumbsgadd_1Gdhj5-1lks">
                                        <div class="mb-3 d-flex align-items-center">
                                          <span style="display:inline-block;margin-right:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552" width="30px" height="30px"><defs><linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#57d163"/><stop offset="1" stop-color="#23b33a"/></linearGradient><filter id="a" width="1.115" height="1.114" x="-.057" y="-.057" color-interpolation-filters="sRGB"><feGaussianBlur stdDeviation="3.531"/></filter></defs><path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0" filter="url(#a)"/><path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"/><path fill="url(#linearGradient1780)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z"/><path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"/><path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"/></svg>
                                          </span>
                                          <h2><strong>WhatsApp General</strong></h2>
                                        </div>
                                        <div class="d-flex cCt_wtpsNmbrs__c__m">
                                          <div class="flex-grow-1 cCt_wtpsNmbrs__c__m__i">
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_title[]" placeholder="Ingrese el título" value="">
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_text[]" placeholder="Ingrese el texto" value="">
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="form-control" name="wtspnumbersgeneral_number[]" placeholder="Ingrese el número" data-valformat="withspacesforthreenumbers" maxlength="9" value="">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <br>
                                      <div class="cCt_wtpsNmbrs__c" id="wpsnumbsgadd_1Gdhj5-2lks">
                                        <div class="mb-3 d-flex align-items-center">
                                          <span style="display:inline-block;margin-right:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552" width="30px" height="30px"><defs><linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#57d163"/><stop offset="1" stop-color="#23b33a"/></linearGradient><filter id="a" width="1.115" height="1.114" x="-.057" y="-.057" color-interpolation-filters="sRGB"><feGaussianBlur stdDeviation="3.531"/></filter></defs><path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0" filter="url(#a)"/><path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"/><path fill="url(#linearGradient1780)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z"/><path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"/><path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"/></svg>
                                          </span>
                                          <h2><strong>WhatsApp para Productos</strong></h2>
                                        </div>
                                        <div id="wpsnumbsgadd_cC1Gdhj5-2lks"></div>
                                      </div>
                                      @endif
                                      <div class="flex-btn">
                                        <button type="button" class="btn btn-success d-block w-100 add-whatsapp-number"><i class="fa fa-plus"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('assets/back/js/plugin/codemirror/codemirror.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/codemirror/css.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/back/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/back/js/system-config.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  var editor = CodeMirror.fromTextArea(document.getElementById("custom_css_area"), {
    mode: "text/css",
    matchBrackets: true,
    theme: "monokai"
  });
});
</script>
@endsection