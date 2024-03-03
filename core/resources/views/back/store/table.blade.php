@foreach($datas as $data)
<tr>
  {{--
  <!--
  <td>
    <img src="{{ $data->photo ? asset('assets/images/'.$data->photo) : asset('assets/images/placeholder.png') }}" alt="Image Not Found">
  </td>
  -->
  --}}
  <td>{{ $data->name }}</td>
  <td>{{ $data->telephone }}</td>
  <td>{{ $data->address }}</td>
  {{--
  <!--
  <td>
    <div class="dropdown">
      <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{  $data->status == 1 ? __('Enabled') : __('Disabled')  }}
      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('back.store.status',[$data->id,1]) }}">{{ __('Enable') }}</a>
        <a class="dropdown-item" href="{{ route('back.store.status',[$data->id,0]) }}">{{ __('Disable') }}</a>
      </div>
    </div>
  </td>
  -->
  --}}
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm" href="{{ route('back.store.edit',$data->id) }}">
        <i class="fas fa-edit"></i>
      </a>
      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.store.destroy',$data->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
@endforeach