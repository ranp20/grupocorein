@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-bs-dismiss="alert" data-dismiss="alert">&times;</button>
	<b>{{ Session::get('success') }}</b>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show alertBySystemShow" role="alert">
	<button type="button" class="close" data-bs-dismiss="alert" data-dismiss="alert">&times;</button>
	<b>{{ Session::get('error') }}</b>
</div>
@endif
@if(count($errors) > 0)
<div class="alert alert-danger validation fade show" role="alert">
	<button type="button" class="close" data-bs-dismiss="alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	<ul class="text-left {{ count($errors) == 1 ? 'list-unstyled' : '' }}">
		@foreach($errors->all() as $error)
		<li>
			<b>{{$error}}</b>
		</li>
		@endforeach
	</ul>
</div>
@endif
