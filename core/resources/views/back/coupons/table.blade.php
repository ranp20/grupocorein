@foreach($datas as $data)
<?php
  date_default_timezone_set('America/Lima');
  $timestamp_finalDateCoupon = strtotime($data['time_end']);
  $format_finalDateCoupon = date("d/m/Y - h:i:s A", $timestamp_finalDateCoupon);
  // $FinalDateCoupon = date("Y/m/d H:i:s", strtotime($data['time_end']));
?>
<tr>
  <td>
    <img src="{{ $data->photo ? asset('assets/images/coupons/'.$data->photo) : asset('assets/images/placeholder.png') }}" alt="{{ $data->photo ? $data->name : 'Image Not Found' }}">
  </td>
  <td>{{ $data->name }}</td>
  <td>{{ $format_finalDateCoupon }}</td>
  <td>
    <div class="dropdown">
        <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{  $data->status == 1 ? __('Enabled') : __('Disabled')  }}
        </button>
        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{ route('back.coupons.status',[$data->id,1]) }}">{{ __('Enable') }}</a>
          <a class="dropdown-item" href="{{ route('back.coupons.status',[$data->id,0]) }}">{{ __('Disable') }}</a>
        </div>
      </div>
    </div>
  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm " href="{{ route('back.coupons.edit',$data->id) }}">
        <i class="fas fa-edit"></i>
      </a>
      <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.coupons.destroy',$data->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
@endforeach
