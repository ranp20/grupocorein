@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create FAQ') }}</b> </h3>
                <a class="btn btn-secondary btn-rounded btn-sm" href="{{route('back.faq.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<div class="p-5">
								<form class="admin-form" action="{{ route('back.faq.store') }}" method="POST" enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts')


									<div class="form-group">
										<label for="title">{{ __('Title') }} *</label>
										<input type="text" name="title" class="form-control" id="title"
											placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}" required>
									</div>

									<div class="form-group">
										<label for="category_id">{{ __('Select Category') }} *</label>
										<select name="category_id" id="category_id" class="form-control" required>
											<option value="" selected disabled>{{__('Select Category')}}</option>
											@foreach(DB::table('fcategories')->whereStatus(1)->get() as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
										</select>
									</div>
                                    
                                    <!-- NUEVO CONTENIDO (INICIO) -->
									<div class="form-group">
										<label for="details">{{ __('Details') }} *</label>
										<textarea name="details" id="details" class="form-control text-editor" rows="5"
											placeholder="{{ __('Enter Details') }}"
											required>{{ old('details') }}</textarea>
									</div>
                                    <div class="form-group position-relative ">
                                        <div class="form-group pb-0  mb-0 pl-0">
                                            <label>{{ __('Gallery Images') }} </label>
                                        </div>
                                        <div class="form-group pb-0 pt-0 mt-0 mb-0 pl-0">
                                            <div id="gallery-images" class="">
                                                <div class="d-block gallery_image_view">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group position-relative pl-0">
                                            <label class="file">
                                                <input type="file"  accept="image/*"  name="galleries[]" id="gallery_file" aria-label="File browser example" accept="image/*" multiple>
                                                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                            </label>
                                            <br>
                                            <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                                        </div>
                                    </div>
                                    
									<div class="form-group position-relative ">
									    <label for="adj_doc">{{ __('Adjuntar PDF') }} *</label>
									    <div class="form-group position-relative pl-0">
									        <label class="file">
                                                <input type="file" accept="application/pdf" class="upload-photo" name="adj_doc" id="adj_doc" aria-label="File browser example">
                                                <span class="file-custom text-left">{{ __('Seleccionar archivo...') }}</span>
                                            </label>
                                            <br>
									    </div>
                                    </div>
                                    <!-- NUEVO CONTENIDO (FIN) -->


								<div class="form-group text-center">
										<button type="submit"
											class="btn btn-secondary ">{{ __('Submit') }}</button>
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
