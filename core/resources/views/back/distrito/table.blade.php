@foreach($datas as $data)
<tr>
  <td>{{ $data->id }}</td>
  <td>{{ $data->distrito_code }}</td>
  <td>{{ $data->distrito_name }}</td>
</tr>
@endforeach