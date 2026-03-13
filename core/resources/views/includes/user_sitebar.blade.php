@php
  $user = Auth::user();
  function cambiaf_mysql($date){
    $originalDate = $date;
    setlocale(LC_ALL,"es_ES");
    date_default_timezone_set('America/Lima');
    
    $newDateFormat = date("F j, Y", strtotime($originalDate));
    
    /*
    $newDate = date_create_from_format("d/m/Y", $date);
    $newDateFormat = strftime("%A",$newDate->getTimestamp());
    */
    /*
    $newDateFormat = date('F', mktime(0, 0, 0, $date));
    */
    return $newDateFormat;
  }
@endphp
<div class="col-lg-4">
  <aside class="user-info-wrapper">
    <div class="user-info">
      <div class="user-avatar">
        <div class="c_useravatar">
          <div class="c_useravatar__img">
            <img id="avater_photo_view" src="{{$user->photo ? asset('assets/images/users/'.$user->photo) : asset('assets/images/placeholder.png')}}" alt="User">
          </div>
          <div class="c_useravatar__iptfile">
            <div class="c_useravatar__iptfile__chv" data-bghover="c-iconcamera">
              <div class="c_useravatar__iptfile__chv__icon">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" style="pointer-events: none; display: inherit;"><path d="M12,9c1.65,0,3,1.35,3,3s-1.35,3-3,3s-3-1.35-3-3S10.35,9,12,9 M12,8c-2.21,0-4,1.79-4,4s1.79,4,4,4s4-1.79,4-4 S14.21,8,12,8L12,8z M14.59,4l2,2H21v12H3V6h4.41l2-2H14.59 M15,3H9L7,5H2v14h20V5h-5L15,3L15,3z"></path></svg>
              </div>
            </div>
            <div class="c_useravatar__iptfile__editphoto" data-bghover="c-iconpencil">
              <div class="c_useravatar__iptfile__editphoto__icon">
              <!-- <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink" height="24" viewBox="0 0 64 80" width="24" version="1.1" x="0px" y="0px" xml:space="preserve"><g><path d="M3.161,63.357c0.471,0,0.968-0.115,1.479-0.342l14.346-6.376c1.234-0.549,2.887-1.684,3.843-2.64L62,14.829   c0.754-0.754,1.17-1.759,1.17-2.829S62.754,9.925,62,9.172l-7.172-7.173C54.074,1.246,53.07,0.831,52,0.831S49.926,1.246,49.172,2   L9,42.171c-0.968,0.967-2.09,2.651-2.612,3.917L0.912,59.389c-0.594,1.444-0.174,2.42,0.129,2.873   C1.507,62.958,2.28,63.357,3.161,63.357z M20,51.171C20,51.171,20,51.172,20,51.171L12.828,44L46,10.828L53.172,18L20,51.171z    M52,4.828L59.172,12L56,15.172L48.828,8L52,4.828z M10.088,47.611c0.059-0.142,0.138-0.303,0.226-0.469l6.213,6.213L5.751,58.143   L10.088,47.611z"/></g></svg> -->
              <svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="24" width="24" viewBox="-5.0 -10.0 110.0 135.0"><path d="m91.469 19.52-10.988-10.988c-4.4258-4.4258-11.633-4.4258-16.062 0l-54.52 54.523c-0.47656 0.47656-0.78906 1.0977-0.88672 1.7695l-3.7734 26.398c-0.13672 0.97266 0.1875 1.957 0.88672 2.6523 0.58984 0.58984 1.3867 0.91406 2.2109 0.91406 0.14844 0 0.29687-0.011718 0.44141-0.03125l26.398-3.7734c0.66797-0.09375 1.2891-0.40625 1.7695-0.88672l54.523-54.52c4.4258-4.4297 4.4258-11.637 0-16.062zm-79.449 68.461 2.8125-19.695c4.5078-0.023437 8.8477 1.6367 12.07 4.8789 3.1992 3.2188 4.8477 7.5312 4.8125 12.004l-19.695 2.8164zm25.59-7.3789c-0.86719-4.4297-3-8.5547-6.2734-11.844-3.3047-3.3203-7.4688-5.4844-11.941-6.3594l37.973-37.973 18.211 18.211-37.969 37.969zm49.441-49.441-7.0547 7.0547-18.211-18.211 7.0547-7.0547c1.9922-1.9883 5.2344-1.9883 7.2227 0l10.988 10.988c1.9922 1.9922 1.9883 5.2344 0 7.2227z"/></svg>
              </div>
            </div>
            <div class="c_useravatar__iptfile__uploadphoto" data-bghover="c-inputphoto">
              <label for="photo_avataruser-front" class="c_useravatar--label"></label>
              <input type="file" id="photo_avataruser-front" name="photo" accept="img/*" class="c_useravatar--iptfilePhoto imagen_front" data-href="{{ route('user.account.changeiconuser') }}" required="">
            </div>
          </div>
        </div>
      </div>
      <div class="user-data">
        <h4 class="h5">{{$user->first_name}} {{$user->last_name}}</h4><span>{{__('Joined')}} {{cambiaf_mysql($user->created_at)}}</span>
      </div>
    </div>
    <nav class="list-group">
      <a class="list-group-item {{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"><i class="icon-command"></i>{{__('Dashboard')}}</a>
      <a class="list-group-item {{ request()->is('user/profile') ? 'active' : '' }}" href="{{route('user.profile')}}"><i class="icon-user"></i>{{__('Profile')}}</a>
      
      <a class="list-group-item with-badge {{ request()->is('user/orders') ? 'active' : '' }}" href="{{route('user.order.index')}}"><i class="icon-shopping-bag"></i>{{__('Orders')}}<span class="badge badge-default badge-pill">{{$user->orders->count()}}</span></a>
      <a class="list-group-item {{ request()->is('user/addresses') ? 'active' : '' }}" href="{{route('user.address')}}"><i class="icon-map-pin"></i>{{__('Address')}}</a>
      <a class="list-group-item  with-badge {{ request()->is('user/wishlists') ? 'active' : '' }}" href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i>{{__('Wishlist')}}<span class="badge badge-default badge-pill">{{$user->wishlists->count()}}</span></a>
      <a class="list-group-item remove-account with-badge" data-bs-toggle="modal" data-bs-target=".modal" href="javascript:;"><i class="icon-trash"></i>{{__('Delete Account')}}</a>
      <a class="list-group-item with-badge" href="{{route('user.logout')}}"><i class="icon-log-out"></i>{{__('Log out')}}</a>
    </nav>
  </aside>
  <div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('Remove Account')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>{{__('Your account will be deleted along with all your data.')}} {{__('Are You Sure?')}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
          <a href="{{route('user.account.remove')}}" type="button" class="btn btn-danger">{{__('Remove Account')}}</a>
        </div>
      </div>
    </div>
  </div>
</div>