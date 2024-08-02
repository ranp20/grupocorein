@foreach($datas as $data)
<tr>
  <td><span>{{ $data->cmptbk_codegen }}</span></td>
  <td><span>{{ $data->cmptbk_name }}</span></td>
  <td><span>{{ $data->cmptbk_telefono }}</span></td>
  <td><span>{{ $data->cmptbk_email }}</span></td>
  <td>
    <div class="action-list">
      <a class="btn btn-secondary btn-sm" href="{{ route('back.complaintsbook.show',$data->id) }}">
        <i class="fas fa-eye"></i>
      </a>
      {{--
      <!--
      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.complaintsbook.destroy',$data->id) }}">
        <i class="fas fa-trash-alt"></i>
      </a>
      -->
      --}}
    </div>
  </td>
</tr>
@endforeach