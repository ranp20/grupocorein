@extends('master.front')
@section('title')
  {{__('Login')}}
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
          <li class="separator"></li>
          <li>{{__('Login/Register')}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-3x mb-1">
  <div class="row">
    <div class="col-md-6">
      <form class="card" method="post" action="{{route('user.login.submit')}}">
        @csrf
        <div class="card-body ">
          <h4 class="margin-bottom-1x text-center">{{__('Login')}}</h4>
          <div class="form-group input-group">
            <input class="form-control" type="email" name="login_email" placeholder="{{ __('Email') }}" value="{{old('login_email')}}"><span class="input-group-addon"><i class="icon-mail"></i></span>
          </div>
          @error('login_email')
            <p class="text-danger">{{$message}}</p>
            @enderror
          <div class="form-group input-group">
            <input class="form-control" type="password" autocomplete="off" name="login_password" placeholder="{{ __('Password') }}" ><span class="input-group-addon"><i class="icon-lock"></i></span>
            <div class="cFrmCtrl__cIcon--R fnc-icon_passCtrl me-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>
						</div>
          </div>
          @error('login_password')
          <p class="text-danger">{{$message}}</p>
          @enderror
          <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
            <div class="custom-control custom-checkbox ps-1">
              <input class="custom-control-input" type="checkbox" id="remember_me">
              <label class="custom-control-label" for="remember_me">{{__('Remember me')}}</label>
            </div>
            <a class="navi-link" href="{{route('user.forgot')}}">{{__('Forgot password?')}}</a>
          </div>
          <div class="text-center">
            <button class="btn btn-primary margin-bottom-none" type="submit"><span>{{ __('Login') }}</span></button>
          </div>
          <div class="row">
            <div class="col-lg-12 text-center mt-3">
              @if($setting->facebook_check == 1)
              <a class="facebook-btn mr-2" href="{{route('social.provider','facebook')}}">{{ __('Facebook login') }}</a>
              @endif
              @if($setting->google_check == 1)
              <a class="google-btn" href="{{route('social.provider','google')}}"> {{ __('Google login') }}</a>
              @endif
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <div class="card register-area">
        <div class="card-body ">
          <h4 class="margin-bottom-1x text-center">{{__('Register')}}</h4>
          <form class="row" action="{{route('user.register.submit')}}" method="POST">
            @csrf
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-fn">{{__('Names')}}</label>
                <input class="form-control" type="text" name="first_name" autocomplete="off" spellcheck="false" placeholder="{{__('Nombres')}}" id="reg-fn" value="{{old('first_name')}}" required>
                @error('first_name')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-ln">{{__('SurNames')}}</label>
                <input class="form-control" type="text" name="last_name" autocomplete="off" spellcheck="false" placeholder="{{__('Apellidos')}}" id="reg-ln" value="{{old('last_name')}}" required>
                @error('last_name')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-email">{{__('E-mail Address')}}</label>
                <input class="form-control" type="email" name="email" autocomplete="off" spellcheck="false" placeholder="{{__('E-mail Address')}}" id="reg-email" value="{{old('email')}}" required>
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-phone">{{__('Teléfono/Celular')}}</label>
                <input class="form-control" type="text" name="phone" autocomplete="off" spellcheck="false" data-valformat="withspacesforthreenumbers" maxlength="9" placeholder="{{__('Phone Number')}}" id="reg-phone" value="{{old('phone')}}" required>
                @error('phone')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group position-relative">
                <label for="reg-pass">{{__('Contraseña')}}</label>
                <div class="position-relative">
                  <input class="form-control" type="password" name="password" autocomplete="off" spellcheck="false" placeholder="{{__('Contraseña')}}" id="reg-pass" required>
                  <div class="cFrmCtrl__cIcon--R fnc-icon_passCtrl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>
                  </div>
                </div>
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @endif
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-pass-confirm">{{__('Confirm Password')}}</label>
                <input class="form-control" type="password" name="password_confirmation" autocomplete="off" spellcheck="false" placeholder="{{__('Confirm Password')}}" id="reg-pass-confirm" required>
                <span id="mssg_cConfirmTwoPass"></span>
              </div>
            </div>
            @if(old('reg_enterprise') != "" && old('reg_enterprise') == "on")
            <div class="col-sm-6">
              <div class="form-group">
                <label class="switch-primary">
                  <input type="checkbox" class="switch switch-bootstrap status radio-check" name="reg_enterprise" id="reg-enterprise" checked value="{{ old('reg_enterprise') }}">
                  <span class="switch-body"></span>
                  <span class="switch-text">{{ __('Poseo Empresa') }}</span>
                </label>
              </div>
            </div>
            <div class="row" id="cTentr-af1698__p">
              <div class="col-sm-12">
                <h3 class="widget-title">Datos Personales</h3>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="reg-address1">Dirección 1</label>
                  <input class="form-control" type="text" name="reg_address1" placeholder="Dirección 1" id="reg-address1" value="{{ old('reg_address1') }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="reg-address2">Dirección 2 (Opcional)</label>
                  <input class="form-control" type="text" name="reg_address2" placeholder="Dirección 2" id="reg-address2" value="{{ old('reg_address2') }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <h3 class="widget-title">Datos de Empresa</h3>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-ruc">RUC</label>
                  <input class="form-control" type="text" name="reg_ruc" placeholder="RUC" id="reg-ruc" value="{{ old('reg_ruc') }}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-razosocial">Razón social</label>
                  <input class="form-control" type="text" name="reg_razonsocial" placeholder="Razón social" id="reg-razosocial" value="{{ old('reg_razonsocial') }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="reg-addressfiscal">Dirección Fiscal</label>
                  <input class="form-control" type="text" name="reg_addressfiscal" placeholder="Dirección Fiscal" id="reg-addressfiscal" value="{{ old('reg_addressfiscal') }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <h3 class="widget-title">Dirección de Envío</h3>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-codepostal">Código Postal</label>
                  <input class="form-control" type="text" name="reg_codepostal" placeholder="Código Postal" id="reg-codepostal" value="{{ old('reg_codepostal') }}" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-country">País</label>
                  <select class="form-control" name="reg_country" id="reg-country" required>
                    <option selected value="">Elige País</option>
                    <option value="1">Perú</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-departamento">Departamento</label>
                  <select class="form-control" name="reg_departamento" id="reg-departamento" data-href="" required></select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-provincia">Provincia</label>
                  <select class="form-control" name="reg_provincia" id="reg-provincia" data-href="" required></select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-distrito">Distrito</label>
                  <select class="form-control" name="reg_distrito" id="reg-distrito" required></select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-streetaddress">Calle</label>
                  <input class="form-control" type="text" name="reg_streetaddress" placeholder="Calle" id="reg-streetaddress" value="{{ old('reg_streetaddress') }}" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="reg-referenceaddress">Referencia (Opcional)</label>
                  <input class="form-control" type="text" name="reg_referenceaddress" placeholder="Referencia" id="reg-referenceaddress" value="{{ old('reg_referenceaddress') }}">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="reg-addresseeaddress">Destinatario (Opcional)</label>
                  <input class="form-control" type="text" name="reg_addresseeaddress" placeholder="Destinatario" id="reg-addresseeaddress" value="{{ old('reg_addresseeaddress') }}">
                </div>
              </div>
            </div>
            @else
            <div class="col-sm-6">
              <div class="form-group">
                <label class="switch-primary">
                  <input type="checkbox" class="switch switch-bootstrap status radio-check" name="reg_enterprise" id="reg-enterprise" value="{{ old('reg_enterprise') }}">
                  <span class="switch-body"></span>
                  <span class="switch-text">{{ __('Poseo Empresa') }}</span>
                </label>
              </div>
            </div>
            <div class="row" id="cTentr-af1698__p"></div>
            @endif
            @if ($setting->recaptcha == 1)
            <div class="col-lg-12 mb-4">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                @php
                  $errmsg = $errors->first('g-recaptcha-response');
                @endphp
                <p class="text-danger mb-0">{{__("$errmsg")}}</p>
                @endif
            </div>
            @endif
            <div class="col-12 text-center">
              <button class="btn btn-primary margin-bottom-none" type="submit"><span>{{__('Register')}}</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/login.js')}}"></script>
@endsection