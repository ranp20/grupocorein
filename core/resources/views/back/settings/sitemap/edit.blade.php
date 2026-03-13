@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class=" mb-0 bc-title"><b>{{ __('Create Sitemap') }}</b> </h3>
				<a class="btn btn-primary  btn-sm" href="{{route('back.sitemap.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body p-0">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="p-3">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input id="autocomplete" type="text" class="form-control" placeholder="{{ __('Enter an address') }}">
										</div>
										<div class="row">
											<div class="col-md-12">
												<div id="mapa"></div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<form class="admin-form" action="{{ route('back.sitemap.update', $sitemap->id) }}" method="POST" enctype="multipart/form-data">
											@csrf
                      @method('PUT')
											@include('alerts.alerts')
											<div class="row d-none">
												<div class="col-md-6">
													<div class="form-group">
														<label for="sitemap_lat">{{ __('Latitude') }} *</label>
														<input type="hidden" name="sitemap_lat" class="form-control" id="sitemap_lat" placeholder="{{ __('Latitude') }}" value="{{ $sitemap->sitemap_lat }}">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="sitemap_lng">{{ __('Length') }} *</label>
														<input type="hidden" name="sitemap_lng" class="form-control" id="sitemap_lng" placeholder="{{ __('Length') }}" value="{{ $sitemap->sitemap_lng }}">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="sitemap_name">{{ __('Sitemap name') }} *</label>
												<input type="text" name="sitemap_name" class="form-control" id="sitemap_name" placeholder="{{ __('Sitemap name') }}" value="{{ $sitemap->sitemap_name }}" required>
											</div>
											<div class="form-group text-right">
												<button type="submit" class="btn btn-secondary">{{ __('Submit') }}</button>
											</div>
										</form>
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZNJBL9QHv2HlNc-EUv2Vc_a1e2LYxdgc"></script> -->
<script type="text/javascript" src="{{ asset('assets/back/js/sitemaps.js') }}"></script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxpCfnK0yQ48z5n5Q1e_YXbZPRP2RqJV8&libraries=places&callback=initMap"></script>
@endsection