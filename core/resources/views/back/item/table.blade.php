@foreach($datas as $data)
<tr id="product-bulk-delete">
  <td><input type="checkbox" class="bulk-item" value="{{$data->id}}"></td>
  <td>
    <a class="link_viewTargetBlankImg" href="{{ $data->thumbnail ? asset('assets/images/items/'.$data->thumbnail) : asset('assets/images/placeholder.png') }}" target="_blank">
      <img src="{{ $data->thumbnail ? asset('assets/images/items/'.$data->thumbnail) : asset('assets/images/placeholder.png') }}" alt="Image Not Found">
    </a>
  </td>
  <td>
    {{ $data->name }}
  </td>
  <td>
    @php
    $newPrice = 0;
    @endphp
    @if($data->sections_id != 0)
      @php
      if($data->on_sale_price != 0){
        $newPrice = $data->on_sale_price;
      }else if($data->special_offer_price != 0){
        $newPrice = $data->special_offer_price;
      }else{
        $newPrice = $data->discount_price;
      }
      @endphp
    @else
      @php
        $newPrice = $data->discount_price;
      @endphp
    @endif
    <span>{{ PriceHelper::adminCurrencyPrice($newPrice) }}</span>
  </td>
  <td>
    @php
    $brandName = DB::table('brands')->where('id', $data->brand_id)->get();
    @endphp
    @foreach($brandName as $k => $v)
    {{ $v->name }}
    @endforeach
    
  </td>
  <td>
    @php
    $nameSection = "";
    $nameSectionClassSpan = "";
    @endphp
    @if($data->sections_id != 0)
      @php
        if($data->sections_id == 1){
          $nameSection = "En promoción";
          $nameSectionClassSpan = "sptxt_prod-prom";
        }else if($data->sections_id == 2){
          $nameSection = "Oferta Especial";
          $nameSectionClassSpan = "sptxt_prod-offspecial";
        }else{
          $nameSection = "Normal";
          $nameSectionClassSpan = "sptxt_prod-normal";
        }
      @endphp
    @else
      @php
        $nameSection = "Normal";
        $nameSectionClassSpan = "sptxt_prod-normal";
      @endphp
    @endif
    <span class="{{$nameSectionClassSpan}}">{{ $nameSection }}</span>
  </td>
  <td>
    <div class="dropdown">
      <button class="btn btn-{{  $data->status == 1 ? 'success' : 'danger'  }} btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{  $data->status == 1 ? __('Publish') : __('Unpublish')  }}
      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('back.item.status',[$data->id,1]) }}">{{ __('Publish') }}</a>
        <a class="dropdown-item" href="{{ route('back.item.status',[$data->id,0]) }}">{{ __('Unpublish') }}</a>
      </div>
    </div>
  </td>
  {{--
  <!--
  <td>
    <p class="
    @if($data->is_type == 'undefine')
    @else
      bg-info badge text-white
    @endif
    ">
    @if($data->is_type == 'undefine')
      {{ __('Not Define') }}
    @else
      {{$data->is_type ? ucfirst(str_replace('_',' ',$data->is_type)) : __('undefine')}}
    @endif
    </p>
  </td>
  <td>
    {{ucfirst($data->item_type)}}
  </td>
  -->
  --}}
  <td class="d-tr_none">
    {{$data->sap_code}} 
  </td>
  <td>
    <div class="dropdown">
      <button class="btn btn-secondary btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{  __('Options') }}
      </button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
        @if ($data->item_type == 'normal')
        <a class="dropdown-item" href="{{ route('back.item.edit',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Edit') }}</a>
        @elseif($data->item_type =='digital')
        <a class="dropdown-item" href="{{ route('back.digital.item.edit',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Edit') }}</a>
        @elseif($data->item_type =='affiliate')
        <a class="dropdown-item" href="{{ route('back.affiliate.edit',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Edit') }}</a>
        @else
        <a class="dropdown-item" href="{{ route('back.license.item.edit',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Edit') }}</a>
        @endif
          @if($data->status == 1)
          <a class="dropdown-item" target="_blank" href="{{ route('front.product',$data->slug) }}"><i class="fas fa-angle-double-right"></i> {{ __('View') }}</a>
        @endif
        @if ($data->item_type == 'normal')
        <a class="dropdown-item" href="{{ route('back.attribute.index',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Attributes') }}</a>
        <a class="dropdown-item" href="{{ route('back.option.index',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Attribute Options') }}</a>
        @endif
        <a class="dropdown-item" href="{{ route('back.item.highlight',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Highlight') }}</a>
        <a class="dropdown-item" data-toggle="modal"
        data-target="#confirm-delete" href="javascript:;"
        data-href="{{ route('back.item.destroy',$data->id) }}"><i class="fas fa-angle-double-right"></i> {{ __('Delete') }}</a>
      </div>
    </div>
  </td>
</tr>
@endforeach