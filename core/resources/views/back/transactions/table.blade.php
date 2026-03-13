@foreach($datas as $data)
<tr id="transaction-bulk-delete">
  <td><input type="checkbox" class="bulk-item" value="{{$data->id}}"></td>
  <td >
    @if (!$data->user->id)
    {{$data->user_email}}
    @else
    <a href="{{route('back.user.show',$data->user->id)}}">{{$data->user_email}}</a>
    @endif
  </td>
  <td>
    <a href="{{route('back.order.invoice',$data->order_id)}}">{{ $data->txn_id}}</a>
  </td>
  <?php
    $statusOrder = "";
    if($data->order->order_status == 'Pending'){
      $statusOrder = __('Pending');
    }else if($data->order->order_status == 'In Progress'){
      $statusOrder = __('In Progress');
    }else if($data->order->order_status == 'Delivered'){
      $statusOrder = __('Delivered');
    }else if($data->order->order_status == 'Canceled'){
      $statusOrder = __('Canceled');
    }else{
      $statusOrder = __('Canceled');
    }
  ?>
  <td>
    <p class="badge badge-dark">{{ $statusOrder }}</p>
  </td>
  <?php
    $statusPayment = "";
    if($data->order->payment_status == 'Paid'){
      $statusPayment = __('Paid');
    }else if($data->order->payment_status == 'Unpaid'){
      $statusPayment = __('Unpaid');
    }else{
      $statusPayment = __('Unpaid');
    }
  ?>
  <td>
    <p class="badge badge-primary">{{ $statusPayment }}</p>
  </td>
  <td>
    @if ($setting->currency_direction == 1)
    {{$data->currency_sign}}{{round($data->amount * $data->currency_value,2)}}
    @else
    {{round($data->amount * $data->currency_value,2)}}{{$data->currency_sign}}
    @endif
  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.transaction.delete',$data->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
@endforeach