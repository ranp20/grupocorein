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
                  <td> <input type="text" name="first_name" class="form-control" id="text" value="{{$user->first_name}}" ></td>
                </tr>
                <tr>
                  <th>{{ __("SurNames") }}</th>
                  <td><input type="text" name="last_name" class="form-control" id="text" value="{{$user->last_name}}" ></td>
                </tr>
                <tr>
                  <th>{{ __("Email Address") }}</th>
                  <td><input type="text" name="email" class="form-control" id="text" value="{{$user->email}}" ></td>
                </tr>
                <tr>
                  <th>{{ __("Phone Number") }}</th>
                  <td><input type="text" name="phone" class="form-control" id="text" value="{{$user->phone}}" ></td>
                </tr>
                <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                <tr>
                  <th>{{ __("Password") }}</th>
                  <td><input type="password" name="password" class="form-control" id="text" placeholder="{{ __('Password') }}" value="" ></td>
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