@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class="mb-0 bc-title"><b>{{ __('Update Catalog') }}</b></h3>
				<a class="btn btn-primary  btn-sm" href="{{route('back.catalog.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body p-0">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div class="p-5">
								<form class="admin-form" action="{{ route('back.catalog.update',$catalog->id) }}" method="POST" enctype="multipart/form-data">
									@csrf
									@method('PUT')
									@include('alerts.alerts')
									<div class="d-flex align-items-center justify-content-end">
										<label class="switch-primary">
											<input type="checkbox" class="switch switch-bootstrap radio-check__vCatalog" name="status" value="{{ $catalog->status }}" {{ ($catalog->status != "" && $catalog->status != 0) ? "checked" : "" }}>
											<span class="switch-body"></span>
											<span class="switch-text">{{ __('Published') }}</span>
										</label>
									</div>
									<div class="form-group">
										<label for="name">{{ __('Name') }} *</label>
										<input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $catalog->name }}" required>
									</div>
									<div class="">
										<div class="">
											<div class="form-group pb-0  mb-0">
												<label class="d-block">{{ __('Featured Image') }} *</label>
											</div>
											<div class="form-group pb-0 pt-0 mt-0 mb-0">
												<img class="admin-img lg" src="{{ $catalog->photo ? asset('assets/images/catalogs/'.$catalog->photo) : asset('assets/images/placeholder.png') }}">
											</div>
											<div class="form-group position-relative ">
												@if($catalog->photo != "")
												<label class="file mxw-100">
													<input type="file" accept="image/*" class="upload-photo" name="photo" id="file"  aria-label="File browser example">
													<span class="file-custom text-left">{{ $catalog->photo }}</span>
												</label>
												@else
												<label class="file mxw-100">
													<input type="file" accept="image/*" class="upload-photo" name="photo" id="file"  aria-label="File browser example">
													<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
												</label>
												@endif
												<br>
												<span class="mt-1 text-info">{{ __('Image Size Should Be 640 x 840. or square size') }}</span>
											</div>
										</div>
									</div>
									<div>
										<div class="form-group pb-0  mb-0">
											<label class="d-block">{{ __('Adjuntar PDF') }} *</label>
										</div>
										<div class="form-group position-relative ">
											<label class="file mxw-100">
												<input type="file" accept="application/pdf" class="upload-photo" name="adj_doc" id="adj_doc" aria-label="File browser example" value="{{ $catalog->adj_doc }}">
												@if($catalog->adj_doc)
												<span class="file-custom text-left">{{ $catalog->adj_doc }}</span>
												@else
												<span class="file-custom text-left">{{ __('Adjuntar PDF...') }}</span>
												@endif
											</label>
										</div>
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
									</div>
									<div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection