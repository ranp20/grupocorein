@extends('master.back')
@section('content')
<div class="container-fluid">
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between">
        <h3 class=" mb-0  pl-3"><b>{{ __('Customers Details') }}</b> </h3>
        <a class="btn btn-primary btn-sm" href="{{route('back.user.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12">
      <form action="{{route('back.user.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('alerts.alerts')
			  <div class="card">
          <div class="card-body">
            <div class="gd-responsive-table">
              <table class="table table-bordered table-striped">
                <tr>
                  <th>{{ __("Names") }}</th>
                  <td><input type="text" name="first_name" id="first_name" value="{{$user->first_name}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th>{{ __("SurNames") }}</th>
                  <td><input type="text" name="last_name" id="last_name" value="{{$user->last_name}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th>{{ __("Email Address") }}</th>
                  <td><input type="text" name="email" id="email" value="{{$user->email}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th>{{ __("Phone Number") }}</th>
                  <td><input type="text" name="phone" id="phone" value="{{$user->phone}}" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                <tr>
                  <th>{{ __("Password") }}</th>
                  <td><input type="password" name="password" id="password" placeholder="{{ __('Password') }}" autocomplete="false" value="" disabled class="form-control" aria-expanded="true" aria-visibility="show"></td>
                </tr>
                <tr>
                  <th>{{ __("Total Orders") }}</th>
                  <td>{{count($user->orders)}}</td>
                </tr>
                <?php
                  $notifCreate = \Carbon\Carbon::parse($user->created_at);
                  $notifDate = ucfirst($notifCreate->locale('es_ES')->diffForHumans(null, false, false, 1));
                ?>
                <tr>
                  <th>{{ __("Joined") }}</th>
                  <td>{{ $notifDate }}</td>
                </tr>
              </table>
              <button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
            </div>
          </div>
        </div>
      </form>
		</div>
	</div>
</div>
@endsection