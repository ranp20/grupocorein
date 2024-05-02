@foreach($datas as $data)
<tr>
  <td>
    <a href="link_viewTargetBlankImg" href="{{ $data->photo ? asset('assets/images/sliders/'.$data->photo) : asset('assets/images/placeholder.png') }}" target="_blank">
      <img src="{{ $data->photo ? asset('assets/images/sliders/'.$data->photo) : asset('assets/images/placeholder.png') }}" alt="Image Not Found">
    </a>
  </td>
  <td>
    @if ($data->home_page != 'theme4')
    {{ $data->title }}
    @else
    --
    @endif
  </td>
  <td>{{strtoupper($data->home_page)}}</td>
  <td>
    @if ($data->home_page != 'theme4')
    {{ strlen(strip_tags($data->details)) > 250 ? substr(strip_tags($data->details),0,250).'...' : strip_tags($data->details) }}
    @else
    --
    @endif
  </td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm " href="{{ route('back.slider.edit',$data->id) }}">
        <i class="fas fa-edit"></i>
      </a>
      <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.slider.destroy',$data->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
    </div>
  </td>
</tr>
@endforeach