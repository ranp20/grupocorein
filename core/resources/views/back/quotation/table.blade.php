@foreach($datas as $data)
@php
$newMinAmount = number_format($data->min_amount);
@endphp
<tr>
  <td>{{ $data->id }}</td>
  <td>{{ $data->distrito_code }}</td>
  <td>{{ $data->distrito_nombre }}</td>
  <td>{{ $data->provincia_code }}</td>
  <td>{{ $data->provincia_nombre }}</td>
  <td>{{ $data->departamento_code }}</td>
  <td>{{ $data->departamento_nombre }}</td>
  <td>{{ PriceHelper::adminCurrencyPrice($newMinAmount) }}</td>
  <td>{{ $data->max_amount }}</td>
</tr>
@endforeach