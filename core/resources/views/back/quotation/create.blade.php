@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-0 bc-title"><b>{{ __('Add Quotation') }}</b> </h3>
        <a class="btn btn-primary   btn-sm" href="{{route('back.quotation.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      @include('alerts.alerts')
    </div>
  </div>
  <form class="admin-form tab-form" action="{{ route('back.quotation.store') }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="normal" name="item_type">
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group pb-0  mb-0">
              <label class="d-block">{{ __('Import Excel') }} *</label>
            </div>
            <div class="form-group position-relative">
              <label class="file">
                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="upload-photo" name="spreadsheet" id="file" aria-label="File browser example" required>
                <span class="file-custom text-left">{{ __('Upload Excel...') }}</span>
              </label>
              <br>
              <span class="mt-1 text-info">{{ __('The file size should be a maximum of 5MB') }}</span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="{{ asset('assets/front/js/plugins/jquery-3.7.0.min.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/quotationspreadsheet.js')}}"></script>
@endsection