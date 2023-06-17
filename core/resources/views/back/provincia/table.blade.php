@foreach($datas as $data)
<tr>
  <td>{{ $data->id }}</td>
  <td>{{ $data->provincia_code }}</td>
  <td>{{ $data->provincia_name }}</td>
</tr>
@endforeach