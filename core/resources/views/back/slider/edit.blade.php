@extends('master.back')
@section('content')
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-body">
			<div class="d-sm-flex align-items-center justify-content-between">
				<h3 class=" mb-0"><b>{{ __('Update Slider') }}</b> </h3>
				<a class="btn btn-primary btn-sm" href="{{route('back.slider.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<form class="admin-form" action="{{ route('back.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								@include('alerts.alerts')
								<input type="hidden" name="home_page" value="{{$slider->home_page}}">
								@if ($slider->home_page != 'theme4')
								{{--
								<!-- <div class="form-group">
									<label id="change_label" for="name">{{ $slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Feature Image') : __('Logo') }}</label>
									<br>
										<img class="admin-img" src="{{ $slider->logo ? asset('assets/images/sliders/'.$slider->logo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
									<br>
									<span id="change_message" class="mt-1">{{ $slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Image Size Should Be 435 x 530')  :  __('Image Size Should Be 130 x 40')}}</span>
								</div>
								<div class="form-group position-relative ">
									<label class="file">
										<input type="file"  accept="image/*"  class="upload-photo" name="logo" id="file" aria-label="File browser example">
										<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
									</label>
								</div> -->
								--}}
								<div class="form-group">
									<label id="slider_text" for="name">{{ $slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Set Background Image') :__('Current Slider Image') }} *</label>
									<br>
										<img class="admin-img" src="{{ $slider->photo ? asset('assets/images/sliders/'.$slider->photo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
									<br>
									<span id="chenge_label2" class="mt-1">{{$slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Image Size Should Be 1920 x 750') : __('Image Size Should Be 1000 x 530') }}</span>
								</div>
								<div class="form-group position-relative ">
									<label class="file">
										<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file" aria-label="File browser example">
										<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
									</label>
								</div>
								<div class="form-group">
									<label for="">{{ __('Contenido del Slider') }} *</label>
									<div class="non-border-list-switchs">
										<div class="form-check pb-0 d-flex">
											<section class="c-sRadioBtn__c--cDesign-1 pr-3">
												<div class="c-sRadioBtn__c--cDesign-1__c">
												<input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="content_check" value="1" {{$slider->content_check == "false" ? 'checked' : ''}} data-anchor="contentcheck_1" id="content_check-no"/>
													<label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
												</div>
												<label for="content_check-no" style="cursor:pointer;">NO</label>
											</section>
											<section class="c-sRadioBtn__c--cDesign-1">
												<div class="c-sRadioBtn__c--cDesign-1__c">
												<input type="radio" class="c-sRadioBtn__c--cDesign-1__c__input" name="content_check" value="2" {{$slider->content_check == "true" ? 'checked' : ''}} data-anchor="contentcheck_2" id="content_check-yes"/>
													<label class="c-sRadioBtn__c--cDesign-1__c__label"></label>
												</div>
												<label for="content_check-yes" style="cursor:pointer;">SÍ</label>
											</section>
										</div>
									</div>
								</div>
								<div class="c-infoGrpDetails">
									@if($slider->content_check == "false")
									<div class="cSecProdsGroupList__c__i active" id="contentcheck_1">
										{{--
										<!-- <div class="form-group">
											<label for="title">{{ __('Title') }} *</label>
											<input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ $slider->title }}" >
										</div>
										<div class="form-group">
											<label for="slider-link">{{ __('Link') }} *</label>
											<input type="text" name="link" class="form-control" id="slider-link" placeholder="{{ __('Enter Link') }}" value="{{ $slider->link }}" >
										</div>
										<div class="form-group">
											<label for="details">{{ __('Details') }} *</label>
											<textarea name="details" id="details" class="form-control" rows="5" placeholder="{{ __('Enter Details') }}">{{ $slider->details }}</textarea>
										</div> -->
										--}}
									</div>
									<div class="cSecProdsGroupList__c__i" id="contentcheck_2">
										<div class="form-group">
											<label for="content_alignment">Alineación de contenido</label>
											@if($slider->content_info != "")
												@php
													$content_infoFormat = json_decode($slider->content_info, TRUE);
												@endphp
												@if($content_infoFormat['content_alignment'] != "")
												<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
													<div class="form-check px-0 pb-0 d-flex">
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left" {{ $content_infoFormat['content_alignment'] == 1 ? 'checked' : '' }}/>
																<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center" {{ $content_infoFormat['content_alignment'] == 2 ? 'checked' : '' }}/>
																<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right" {{ $content_infoFormat['content_alignment'] == 3 ? 'checked' : '' }}/>
																<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
															</div>
														</section>
													</div>
												</div>
												@else
												<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
													<div class="form-check px-0 pb-0 d-flex">
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left"/>
																<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center"/>
																<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right"/>
																<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
															</div>
														</section>
													</div>
												</div>
												@endif
											@else
											<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
												<div class="form-check px-0 pb-0 d-flex">
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left"/>
															<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
														</div>
													</section>
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center"/>
															<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
														</div>
													</section>
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right"/>
															<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
														</div>
													</section>
												</div>
											</div>
											@endif											
										</div>
										<div class="c-infoGrpBtnTxtDetails">
											<div class="row">
												<div class="col-sm-5">
													<div class="form-group">
														<label for="content_title">{{ __('Title') }} *</label>
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<input type="text" name="content_title" class="form-control" id="content_title" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_title'] }}">
														@else
															<input type="text" name="content_title" class="form-control" id="content_title" placeholder="{{ __('Enter Title') }}" value="">
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-10">
													<div class="form-group">
														<label for="content_description">{{ __('Description') }} *</label>
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<input type="text" name="content_description" class="form-control" id="content_description" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_description'] }}">
														@else
														<input type="text" name="content_description" class="form-control" id="content_description" placeholder="{{ __('Enter Title') }}" value="">
														@endif
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="content_link">Agregar botón *</label>
											<div class="non-border-list-switchs">
												<div class="form-check pb-0">
													<section class="c-sWitch__c--cDesign-1">
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<div class="c-sWitch__c--cDesign-1__c">								
																<input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" {{ $content_infoFormat['content_btncheck'] == "on" ? 'checked' : '' }} name="content_btncheck" data-show="contentbtncheck_1, contentbtncheck_2" id="content-btncheck" value="{{ $content_infoFormat['content_btncheck'] }}"/>
																<label class="c-sWitch__c--cDesign-1__c__label"></label>
															</div>
															<label for="content-btncheck" style="cursor:pointer;">{{ $content_infoFormat['content_btncheck'] == "on" ? 'Habilitado' : 'Deshabilitado' }}</label>
														@else
															<div class="c-sWitch__c--cDesign-1__c">								
																<input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" name="content_btncheck" data-show="contentbtncheck_1, contentbtncheck_2" id="content-btncheck" value="off"/>
																<label class="c-sWitch__c--cDesign-1__c__label"></label>
															</div>
															<label for="content-btncheck" style="cursor:pointer;">Deshabilitado</label>
														@endif
													</section>
												</div>
											</div>
										</div>
										<div class="c-infoGrpBtnLinkDetails">
											<div class="cSecProdsGroupList__c__i active" id="contentbtncheck_1">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label for="content_link">{{ __('Title') }} *</label>
															@if($slider->content_info != "")
																@php
																	$content_infoFormat = json_decode($slider->content_info, TRUE);
																@endphp
																<input type="text" name="content_btn_title" class="form-control" id="content_btn-title" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_btn_title'] }}">
															@else
																<input type="text" name="content_btn_title" class="form-control" id="content_btn-title" placeholder="{{ __('Enter Title') }}" value="">
															@endif
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label for="content_link">{{ __('Link') }} *</label>
															@if($slider->content_info != "")
																@php
																	$content_infoFormat = json_decode($slider->content_info, TRUE);
																@endphp
																<input type="text" name="content_btn_link" class="form-control" id="content_btn-link" placeholder="{{ __('Enter link') }}" value="{{ $content_infoFormat['content_btn_link'] }}">
															@else
																<input type="text" name="content_btn_link" class="form-control" id="content_btn-link" placeholder="{{ __('Enter link') }}" value="">
															@endif

														</div>
													</div>
												</div>
											</div>
											<div class="cSecProdsGroupList__c__i" id="contentbtncheck_2"></div>
										</div>
									</div>
									@else
									<div class="cSecProdsGroupList__c__i" id="contentcheck_1">
										{{--
										<!-- <div class="form-group">
											<label for="title">{{ __('Title') }} *</label>
											<input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ $slider->title }}" >
										</div>
										<div class="form-group">
											<label for="slider-link">{{ __('Link') }} *</label>
											<input type="text" name="link" class="form-control" id="slider-link" placeholder="{{ __('Enter Link') }}" value="{{ $slider->link }}" >
										</div>
										<div class="form-group">
											<label for="details">{{ __('Details') }} *</label>
											<textarea name="details" id="details" class="form-control" rows="5" placeholder="{{ __('Enter Details') }}">{{ $slider->details }}</textarea>
										</div> -->
										--}}
									</div>
									<div class="cSecProdsGroupList__c__i active" id="contentcheck_2">
										<div class="form-group">
											<label for="content_alignment">Alineación de contenido</label>
											@if($slider->content_info != "")
												@php
													$content_infoFormat = json_decode($slider->content_info, TRUE);
												@endphp
												@if($content_infoFormat['content_alignment'] != "")
												<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
													<div class="form-check px-0 pb-0 d-flex">
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left" {{ $content_infoFormat['content_alignment'] == 1 ? 'checked' : '' }}/>
																<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center" {{ $content_infoFormat['content_alignment'] == 2 ? 'checked' : '' }}/>
																<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right" {{ $content_infoFormat['content_alignment'] == 3 ? 'checked' : '' }}/>
																<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
															</div>
														</section>
													</div>
												</div>
												@else
												<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
													<div class="form-check px-0 pb-0 d-flex">
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left"/>
																<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center"/>
																<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
															</div>
														</section>
														<section class="c-sRadioBtn__c--cDesign-2">
															<div class="c-sRadioBtn__c--cDesign-2__c">
																<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right"/>
																<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
															</div>
														</section>
													</div>
												</div>
												@endif
											@else
											<div class="c-infoGrpDetails__cGrpListOtpsInSquare">
												<div class="form-check px-0 pb-0 d-flex">
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="1" data-anchor="contentcheck_1" id="content_alignment-left"/>
															<label for="content_alignment-left" class="c-sRadioBtn__c--cDesign-2__c__label">Izquierda</label>
														</div>
													</section>
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="2" data-anchor="contentcheck_2" id="content_alignment-center"/>
															<label for="content_alignment-center" class="c-sRadioBtn__c--cDesign-2__c__label">Centro</label>
														</div>
													</section>
													<section class="c-sRadioBtn__c--cDesign-2">
														<div class="c-sRadioBtn__c--cDesign-2__c">
															<input type="radio" class="c-sRadioBtn__c--cDesign-2__c__input" name="content_alignment" value="3" data-anchor="contentcheck_3" id="content_alignment-right"/>
															<label for="content_alignment-right" class="c-sRadioBtn__c--cDesign-2__c__label">Derecha</label>
														</div>
													</section>
												</div>
											</div>
											@endif											
										</div>
										<div class="c-infoGrpBtnTxtDetails">
											<div class="row">
												<div class="col-sm-5">
													<div class="form-group">
														<label for="content_title">{{ __('Title') }} *</label>
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<input type="text" name="content_title" class="form-control" id="content_title" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_title'] }}">
														@else
															<input type="text" name="content_title" class="form-control" id="content_title" placeholder="{{ __('Enter Title') }}" value="">
														@endif
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-10">
													<div class="form-group">
														<label for="content_description">{{ __('Description') }} *</label>
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<input type="text" name="content_description" class="form-control" id="content_description" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_description'] }}">
														@else
														<input type="text" name="content_description" class="form-control" id="content_description" placeholder="{{ __('Enter Title') }}" value="">
														@endif
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="content_link">Agregar botón *</label>
											<div class="non-border-list-switchs">
												<div class="form-check pb-0">
													<section class="c-sWitch__c--cDesign-1">
														@if($slider->content_info != "")
															@php
																$content_infoFormat = json_decode($slider->content_info, TRUE);
															@endphp
															<div class="c-sWitch__c--cDesign-1__c">								
																<input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" {{ $content_infoFormat['content_btncheck'] == "on" ? 'checked' : '' }} name="content_btncheck" data-show="contentbtncheck_1, contentbtncheck_2" id="content-btncheck" value="{{ $content_infoFormat['content_btncheck'] }}"/>
																<label class="c-sWitch__c--cDesign-1__c__label"></label>
															</div>
															<label for="content-btncheck" style="cursor:pointer;">{{ $content_infoFormat['content_btncheck'] == "on" ? 'Habilitado' : 'Deshabilitado' }}</label>
														@else
															<div class="c-sWitch__c--cDesign-1__c">								
																<input type="checkbox" class="c-sWitch__c--cDesign-1__c__input" name="content_btncheck" data-show="contentbtncheck_1, contentbtncheck_2" id="content-btncheck" value="off"/>
																<label class="c-sWitch__c--cDesign-1__c__label"></label>
															</div>
															<label for="content-btncheck" style="cursor:pointer;">Deshabilitado</label>
														@endif
													</section>
												</div>
											</div>
										</div>
										<div class="c-infoGrpBtnLinkDetails">
											<div class="cSecProdsGroupList__c__i active" id="contentbtncheck_1">
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label for="content_link">{{ __('Title') }} *</label>
															@if($slider->content_info != "")
																@php
																	$content_infoFormat = json_decode($slider->content_info, TRUE);
																@endphp
																<input type="text" name="content_btn_title" class="form-control" id="content_btn-title" placeholder="{{ __('Enter Title') }}" value="{{ $content_infoFormat['content_btn_title'] }}">
															@else
																<input type="text" name="content_btn_title" class="form-control" id="content_btn-title" placeholder="{{ __('Enter Title') }}" value="">
															@endif
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label for="content_link">{{ __('Link') }} *</label>
															@if($slider->content_info != "")
																@php
																	$content_infoFormat = json_decode($slider->content_info, TRUE);
																@endphp
																<input type="text" name="content_btn_link" class="form-control" id="content_btn-link" placeholder="{{ __('Enter link') }}" value="{{ $content_infoFormat['content_btn_link'] }}">
															@else
																<input type="text" name="content_btn_link" class="form-control" id="content_btn-link" placeholder="{{ __('Enter link') }}" value="">
															@endif

														</div>
													</div>
												</div>
											</div>
											<div class="cSecProdsGroupList__c__i" id="contentbtncheck_2"></div>
										</div>
									</div>
									@endif
								</div>
								@else
								<input name="details" type="hidden" id="details" value="theme4" class="form-control" rows="5" placeholder="{{ __('Enter Details') }}">
								<input type="hidden" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="theme 4" >
								<div class="form-group">
									<label id="slider_text" for="name">{{ $slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Set Background Image') :__('Current Slider Image') }} *</label>
									<br>
										<img class="admin-img" src="{{ $slider->photo ? asset('assets/images/sliders/'.$slider->photo) : asset('assets/images/placeholder.png') }}" alt="No Image Found">
									<br>
									<span id="chenge_label2" class="mt-1">{{$slider->home_page == 'theme3' || $slider->home_page == 'theme4' ? __('Image Size Should Be 1920 x 750') : __('Image Size Should Be 1000 x 530 ') }}</span>
								</div>
								<div class="form-group position-relative ">
									<label class="file">
										<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file" aria-label="File browser example">
										<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
									</label>
								</div>
								<div class="form-group">
									<label for="slider-link">{{ __('Link') }} *</label>
									<input type="text" name="link" class="form-control" id="slider-link" placeholder="{{ __('Enter Link') }}" value="{{ $slider->link }}" >
								</div>
								@endif
								<div class="form-group">
									<button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/jquery-3.7.0.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/sliders.js')}}"></script>
@endsection