@foreach($datas as $data)
<tr>
  <td>{{ $data->id }}</td>
  <td>{{ $data->departamento_code }}</td>
  <td>{{ $data->departamento_name }}</td>
</tr>
@endforeach