<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<title>{{ $setting->title }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
	<link rel="icon" href="{{ asset('assets/images/'.$setting->favicon) }}" type="image/x-icon"/>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/webfont/webfont.min.js') }}"></script>
	<script id="setFont" data-src="{{ asset('assets/back/css/fonts.css') }}" src="{{ asset('assets/back/js/plugin/webfont/setfont.js') }}"></script>
	<link rel="preload" href="{{asset('assets/back/css/styles.min.css')}}" as="style">
	<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/back/css/styles.min.css')}}">
</head>
<body class="login">
  @yield('content')
	@php
		$mainbs = [];
		$mainbs['is_announcement'] = $setting->is_announcement;
		$mainbs['announcement_delay'] = $setting->announcement_delay;
		$mainbs['overlay'] = $setting->overlay;
		$mainbs = json_encode($mainbs);
	@endphp
	<script type="text/javascript" src="{{ asset('assets/back/js/core/jquery.3.6.0.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/back/js/core/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/back/js/core/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/back/js/ready.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/back/js/login.js') }}"></script>
</body>
</html>