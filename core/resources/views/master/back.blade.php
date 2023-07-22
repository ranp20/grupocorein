<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<title>{{ $setting->title }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
  <link rel="icon"  type="image/x-icon" href="{{ asset('assets/images/'.$setting->favicon) }}"/>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/webfont/webfont.min.js') }}"></script>
	<script id="setFont" data-src="{{ asset('assets/back/css/fonts.css') }}" src="{{ asset('assets/back/js/plugin/webfont/setfont.js') }}"></script>
	<link rel="preload" href="{{asset('assets/back/css/styles.min.css')}}" as="style">
	<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/back/css/styles.min.css')}}">
	<script rel="preload" href="{{asset('assets/back/js/plugin/jquery-3.6.4.min.js')}}" as="script"></script>
	<script type="text/javascript" src="{{asset('assets/back/js/plugin/jquery-3.6.4.min.js')}}" as="script"></script>
	@if(DB::table('languages')->where('type', 'Dashboard')->where('is_default',1)->first()->rtl == 1)
	<!-- <link rel="stylesheet" href="{{ asset('assets/back/css/rtl.css') }}"> -->
	@endif
	@yield('styles')
</head>
<body>
	<div class="wrapper">
		<div class="main-header ">
			<div class="logo-header">
				<a href="{{route('back.dashboard')}}" class="logo">
					<img src="{{ $setting->logo ? asset('assets/images/'.$setting->logo) : asset('assets/images/placeholder.png') }}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize ">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item mr-4">
							<a class="btn btn-sm btn-primary py-1 text-white" title="website" href="{{route('front.index')}}" target="_blank">
								<b> {{ __('View Website') }}</b>
							</a>
						</li>
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="javascript:void(0);" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell fa-fw"></i>
								<span  class="badge badge-danger badge-counter">{{ App\Models\Notification::countRegistration() + App\Models\Notification::countOrder() }}</span>
							</a>
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" id="display-notf" data-href={{ route('back.notifications') }}>
								@include('back.notification.index')
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="{{route('back.dashboard')}}" aria-expanded="false">
								<div class="avatar-sm avatar avatar-sm">
									<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="..." class="avatar-img rounded-circle" width="100" height="100" decoding="sync">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg">
											<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="image profile" class="avatar-img rounded" width="100" height="100" decoding="sync">
										</div>
										<div class="u-text">
											<h4>{{ Auth::guard('admin')->user()->name }}</h4>
											<p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p><a href="{{ route('back.profile') }}" class="btn  btn-secondary btn-sm">{{ __('Update Profile') }}</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.profile') }}">{{ __('Update Profile') }}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.password') }}">{{ __('Change Password') }}</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('back.logout') }}">{{ __('Logout') }}</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/noimage.png') }}" alt="..." class="avatar-img rounded-circle" width="100" height="100" decoding="sync">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::guard('admin')->user()->name }}
									<span class="user-level">{{ __('Administrator') }}</span>
								</span>
							</a>
						</div>
					</div>
					@if (Auth::guard('admin')->user()->id == 1)
					@include('master.inc.super')
					@else
					@include('master.inc.normal')
					@endif
					<div class="sidebar-footer text-primary d-block text-center pt-3">
						<span class="d-inline-block"><b>Version 4.7</b></span>
					</div>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
          @yield('content')
				</div>
			</div>
    </div>
  </div>
	@php
		$mainbs = [];
		$mainbs['is_announcement'] = $setting->is_announcement;
		$mainbs['announcement_delay'] = $setting->announcement_delay;
		$mainbs['overlay'] = $setting->overlay;
		$mainbs = json_encode($mainbs);
	@endphp
	<script type="text/javascript">
		var mainbs = {!! $mainbs !!};
	</script>
	<script type="text/javascript" src="{{ asset('assets/back/js/core/jquery.3.6.0.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/core/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/core/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/chart.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/editor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/tagify.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/jscolor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/jquery.magnific-popup.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/sortable.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/ready.min.js') }}"></script>
  @yield('scripts')
	<script type="text/javascript" src="{{ asset('assets/back/js/custom.js') }}"></script>
</body>
</html>
