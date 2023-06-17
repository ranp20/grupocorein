@extends('master.front')
@section('title')
 {{ $item->name}}
@endsection
@section('meta')
<meta name="keywords" content="{{$item->meta_keywords}}">
<meta name="description" content="{{$item->meta_description}}">
@endsection
@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
          <li class="separator"></li>
          <li><a href="{{route('front.catalog')}}">{{__('Shop')}}</a></li>
          <li class="separator"></li>
          <li>{{$item->name}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container padding-bottom-1x mb-1">
  <div class="row">
    <div class="col-xxl-5 col-lg-6 col-md-6">
      <div class="product-gallery">
        @if ($item->video)
        <div class="gallery-wrapper">
          <div class="gallery-item video-btn text-center">
            <a href="{{ $item->video }}" title="Watch video"></a>
          </div>
        </div>
        @endif
        @if($item->is_stock())
        <span class="product-badge
        @if($item->is_type == 'feature')
        bg-warning
        @elseif($item->is_type == 'new')
        bg-success
        @elseif($item->is_type == 'top')
        bg-info
        @elseif($item->is_type == 'best')
        bg-dark
        @elseif($item->is_type == 'flash_deal')
          bg-success
        @endif
        ">{{  $item->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$item->is_type)) : ''   }}</span>
        @else
        <span class="product-badge bg-secondary border-default text-body
        ">{{__('out of stock')}}</span>
        @endif
        @if($item->previous_price && $item->previous_price !=0)
        <div class="product-badge bg-goldenrod  ppp-t"> -{{PriceHelper::DiscountPercentage($item)}}</div>
        @endif
        <div class="product-thumbnails insize">
          <div class="product-details-slider owl-carousel" >
            <div class="item"><img src="{{asset('assets/images/'.$item->photo)}}" alt="zoom"  /></div>
            @foreach ($galleries as $key => $gallery)
            <div class="item"><img src="{{asset('assets/images/'.$gallery->photo)}}" alt="zoom"  /></div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @php
    function renderStarRating($rating,$maxRating=5) {
      $fullStar = "<i class = 'far fa-star filled'></i>";
      $halfStar = "<i class = 'far fa-star-half filled'></i>";
      $emptyStar = "<i class = 'far fa-star'></i>";
      $rating = $rating <= $maxRating?$rating:$maxRating;

      $fullStarCount = (int)$rating;
      $halfStarCount = ceil($rating)-$fullStarCount;
      $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

      $html = str_repeat($fullStar,$fullStarCount);
      $html .= str_repeat($halfStar,$halfStarCount);
      $html .= str_repeat($emptyStar,$emptyStarCount);
      $html = $html;
      return $html;
    }
    @endphp
    <div class="col-xxl-7 col-lg-6 col-md-6">
      <div class="details-page-top-right-content d-flex align-items-center">
        <div class="div w-100">
          <input type="hidden" id="item_id" value="{{$item->id}}">
          <input type="hidden" id="demo_price" value="{{PriceHelper::setConvertPrice($item->discount_price)}}">
          <input type="hidden" value="{{PriceHelper::setCurrencySign()}}" id="set_currency">
          <input type="hidden" value="{{PriceHelper::setCurrencyValue()}}" id="set_currency_val">
          <input type="hidden" value="{{$setting->currency_direction}}" id="currency_direction">
          <h4 class="mb-2 p-title-main">{{$item->name}}</h4>
          <div class="mb-3">
            <div class="rating-stars d-inline-block gmr-3">
            {!!renderStarRating($item->reviews->avg('rating'))!!}
            </div>
            @if ($item->is_stock())
              <span class="text-success  d-inline-block">{{__('In Stock')}}</span>
            @else
              <span class="text-danger  d-inline-block">{{__('Out of stock')}}</span>
            @endif
          </div>
          @if($item->is_type == 'flash_deal')
          @if (date('d-m-y') != \Carbon\Carbon::parse($item->date)->format('d-m-y'))
          <div class="countdown countdown-alt mb-3" data-date-time="{{ $item->date }}">
          </div>
          @endif
          @endif
          <span class="h3 d-block price-area">
          @if ($item->previous_price != 0)
            <small class="d-inline-block"><del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del></small><span style="font-size: 13px;margin-left: 5px;">Inc. IGV</span>
          @endif
          <span id="main_price" class="main-price">{{PriceHelper::grandCurrencyPrice($item)}}</span><span style="font-size: 13px;margin-left: 5px;">Inc. IGV</span>
          </span>
          <p class="text-muted">{{$item->sort_details}} <a href="#details" class="scroll-to">{{__('Read more')}}</a></p>
          <div class="row margin-top-1x">
            @foreach($attributes as $attribute)
            @if($attribute->options->count() != 0)
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="{{ $attribute->name }}">{{ $attribute->name }}</label>
                  <select class="form-control attribute_option" id="{{ $attribute->name }}">
                    @foreach($attribute->options->where('stock','!=','0') as $option)
                    <option value="{{ $option->name }}" data-type="{{$attribute->id}}" data-href="{{$option->id}}" data-target="{{PriceHelper::setConvertPrice($option->price)}}">{{ $option->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @endif
            @endforeach
          </div>
          <div class="row align-items-end pb-4">
            <div class="col-sm-12 cCtActions__Prd">
              @if ($item->item_type == 'normal')
              <div class="qtySelector product-quantity">
                <span class="decreaseQty subclick"><i class="fas fa-minus "></i></span>
                <input type="text" class="qtyValue cart-amount" value="1">
                <span class="increaseQty addclick"><i class="fas fa-plus"></i></span>
                <input type="hidden" value="3333" id="current_stock">
              </div>
              @endif
              <div class="p-action-button">
                @if ($item->item_type != 'affiliate')
                  @if ($item->is_stock())
                  <button class="btn btn-primary m-0 a-t-c-mr" id="add_to_cart"><i class="icon-bag"></i><span>{{ __('Add to Cart') }}</span></button>  
                  @else
                    <button class="btn btn-primary m-0"><i class="icon-bag"></i><span>{{__('Out of stock')}}</span></button>
                  @endif
                @else
                @endif
                  <a href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$item->slug)}}" target="_blank" ><img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as"></a>
              </div>
            </div>
          </div>
          <div class="div">
            <div id="closed"></div>
            <p style="border: 1px solid #003399 !important;border-radius: 5px;padding: 13px;"><img src="{{route('front.index')}}/assets/images/1669243396carro.png"> Disponible despacho a domicilio <a href="#popup1" class="popup1-link">Calcular despacho</a></p>
            <div class="popup1-wrapper" id="popup1">
              <div class="popup1-container">
                <center>
                  <div class="store-content">
                    <fieldset class="fieldset address hide">
                      <div class="pro_title-modal">
                        <span>Calcular despacho</span>
                      </div>
                      <legend class="legend"><span>Selecciona tu localidad  donde desees que se envie tu producto</span></legend><br>
                      <input type="hidden" id="create-address" name="create_address" value="1">
                      <div class="field country required hide" style="position: absolute;visibility: hidden;">
                        <label for="country" class="label">
                          <span>Pais</span>
                        </label>
                        <div class="control">
                          <select name="country_id" id="country" class="required-entry" title="País" data-validate="{'validate-select':true}">
                            <option value=""></option>
                            <option value="AF">Afganistán</option>
                            <option value="AL">Albania</option>
                            <option value="DE">Alemania</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguila</option>
                            <option value="AQ">Antártida</option>
                            <option value="AG">Antigua y Barbuda</option>
                            <option value="SA">Arabia Saudí</option>
                            <option value="DZ">Argelia</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaiyán</option>
                            <option value="BS">Bahamas</option>
                            <option value="BD">Bangladés</option>
                            <option value="BB">Barbados</option>
                            <option value="BH">Baréin</option>
                            <option value="BE">Bélgica</option>
                            <option value="BZ">Belice</option>
                            <option value="BJ">Benín</option>
                            <option value="BM">Bermudas</option>
                            <option value="BY">Bielorrusia</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia y Herzegovina</option>
                            <option value="BW">Botsuana</option>
                            <option value="BR">Brasil</option>
                            <option value="BN">Brunéi</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="BT">Bután</option>
                            <option value="CV">Cabo Verde</option>
                            <option value="KH">Camboya</option>
                            <option value="CM">Camerún</option>
                            <option value="CA">Canadá</option>
                            <option value="BQ">Caribe neerlandés</option>
                            <option value="QA">Catar</option>
                            <option value="TD">Chad</option>
                            <option value="CZ">Chequia</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CY">Chipre</option>
                            <option value="VA">Ciudad del Vaticano</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoras</option>
                            <option value="CG">Congo</option>
                            <option value="KP">Corea del Norte</option>
                            <option value="KR">Corea del Sur</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Côte d’Ivoire</option>
                            <option value="HR">Croacia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curazao</option>
                            <option value="DK">Dinamarca</option>
                            <option value="DM">Dominica</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egipto</option>
                            <option value="SV">El Salvador</option>
                            <option value="AE">Emiratos Árabes Unidos</option>
                            <option value="ER">Eritrea</option>
                            <option value="SK">Eslovaquia</option>
                            <option value="SI">Eslovenia</option>
                            <option value="ES">España</option>
                            <option value="US">Estados Unidos</option>
                            <option value="EE">Estonia</option>
                            <option value="SZ">Esuatini</option>
                            <option value="ET">Etiopía</option>
                            <option value="PH">Filipinas</option>
                            <option value="FI">Finlandia</option>
                            <option value="FJ">Fiyi</option>
                            <option value="FR">Francia</option>
                            <option value="GA">Gabón</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GD">Granada</option>
                            <option value="GR">Grecia</option>
                            <option value="GL">Groenlandia</option>
                            <option value="GP">Guadalupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GF">Guayana Francesa</option>
                            <option value="GG">Guernesey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bisáu</option>
                            <option value="GQ">Guinea Ecuatorial</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haití</option>
                            <option value="HN">Honduras</option>
                            <option value="HU">Hungría</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IQ">Irak</option>
                            <option value="IR">Irán</option>
                            <option value="IE">Irlanda</option>
                            <option value="BV">Isla Bouvet</option>
                            <option value="IM">Isla de Man</option>
                            <option value="CX">Isla de Navidad</option>
                            <option value="IS">Islandia</option>
                            <option value="NF">Isla Norfolk</option>
                            <option value="AX">Islas Aland</option>
                            <option value="KY">Islas Caimán</option>
                            <option value="CC">Islas Cocos</option>
                            <option value="CK">Islas Cook</option>
                            <option value="FO">Islas Feroe</option>
                            <option value="GS">Islas Georgia del Sur y Sandwich del Sur</option>
                            <option value="HM">Islas Heard y McDonald</option>
                            <option value="FK">Islas Malvinas</option>
                            <option value="MP">Islas Marianas del Norte</option>
                            <option value="MH">Islas Marshall</option>
                            <option value="UM">Islas menores alejadas de EE. UU.</option>
                            <option value="PN">Islas Pitcairn</option>
                            <option value="SB">Islas Salomón</option>
                            <option value="TC">Islas Turcas y Caicos</option>
                            <option value="VG">Islas Vírgenes Británicas</option>
                            <option value="VI">Islas Vírgenes de EE. UU.</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italia</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japón</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordania</option>
                            <option value="KZ">Kazajistán</option>
                            <option value="KE">Kenia</option>
                            <option value="KG">Kirguistán</option>
                            <option value="KI">Kiribati</option>
                            <option value="XK">Kosovo</option>
                            <option value="KW">Kuwait</option>
                            <option value="LA">Laos</option>
                            <option value="LS">Lesoto</option>
                            <option value="LV">Letonia</option>
                            <option value="LB">Líbano</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libia</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lituania</option>
                            <option value="LU">Luxemburgo</option>
                            <option value="MK">Macedonia del Norte</option>
                            <option value="MG">Madagascar</option>
                            <option value="MY">Malasia</option>
                            <option value="MW">Malaui</option>
                            <option value="MV">Maldivas</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MA">Marruecos</option>
                            <option value="MQ">Martinica</option>
                            <option value="MU">Mauricio</option>
                            <option value="MR">Mauritania</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">México</option>
                            <option value="FM">Micronesia</option>
                            <option value="MD">Moldavia</option>
                            <option value="MC">Mónaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar (Birmania)</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Níger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NO">Noruega</option>
                            <option value="NC">Nueva Caledonia</option>
                            <option value="NZ">Nueva Zelanda</option>
                            <option value="OM">Omán</option>
                            <option value="NL">Países Bajos</option>
                            <option value="PK">Pakistán</option>
                            <option value="PW">Palaos</option>
                            <option value="PA">Panamá</option>
                            <option value="PG">Papúa Nueva Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE" selected="selected">Perú</option>
                            <option value="PF">Polinesia Francesa</option>
                            <option value="PL">Polonia</option>
                            <option value="PT">Portugal</option>
                            <option value="HK">RAE de Hong Kong (China)</option>
                            <option value="MO">RAE de Macao (China)</option>
                            <option value="GB">Reino Unido</option>
                            <option value="CF">República Centroafricana</option>
                            <option value="CD">República Democrática del Congo</option>
                            <option value="DO">República Dominicana</option>
                            <option value="RE">Reunión</option>
                            <option value="RW">Ruanda</option>
                            <option value="RO">Rumanía</option>
                            <option value="RU">Rusia</option>
                            <option value="EH">Sáhara Occidental</option>
                            <option value="WS">Samoa</option>
                            <option value="AS">Samoa Americana</option>
                            <option value="BL">San Bartolomé</option>
                            <option value="KN">San Cristóbal y Nieves</option>
                            <option value="SM">San Marino</option>
                            <option value="MF">San Martín</option>
                            <option value="PM">San Pedro y Miquelón</option>
                            <option value="SH">Santa Elena</option>
                            <option value="LC">Santa Lucía</option>
                            <option value="ST">Santo Tomé y Príncipe</option>
                            <option value="VC">San Vicente y las Granadinas</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leona</option>
                            <option value="SG">Singapur</option>
                            <option value="SX">Sint Maarten</option>
                            <option value="SY">Siria</option>
                            <option value="SO">Somalia</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="ZA">Sudáfrica</option>
                            <option value="SD">Sudán</option>
                            <option value="SE">Suecia</option>
                            <option value="CH">Suiza</option>
                            <option value="SR">Surinam</option>
                            <option value="SJ">Svalbard y Jan Mayen</option>
                            <option value="TH">Tailandia</option>
                            <option value="TW">Taiwán</option>
                            <option value="TZ">Tanzania</option>
                            <option value="TJ">Tayikistán</option>
                            <option value="IO">Territorio Británico del Océano Índico</option>
                            <option value="TF">Territorios Australes Franceses</option>
                            <option value="PS">Territorios Palestinos</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad y Tobago</option>
                            <option value="TN">Túnez</option>
                            <option value="TM">Turkmenistán</option>
                            <option value="TR">Turquía</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UA">Ucrania</option>
                            <option value="UG">Uganda</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistán</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Vietnam</option>
                            <option value="WF">Wallis y Futuna</option>
                            <option value="YE">Yemen</option>
                            <option value="DJ">Yibuti</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabue</option>
                          </select>
                        </div>
                      </div>
                      <div class="field region">
                        <label for="region_id" class="label">
                          <span>Departamento</span>
                        </label>
                        <div class="control">
                          <select id="region_id" name="region_id" title="" class="region_id" defaultvalue="">
                            <option value="">Selecciona una opción</option>
                            <option value="1">Amazonas</option>
                            <option value="2">Ancash</option>
                            <option value="3">Apurímac</option>
                            <option value="4">Arequipa</option>
                            <option value="5">Ayacucho</option>
                            <option value="6">Cajamarca</option>
                            <option value="7">Callao</option>
                            <option value="8">Cusco</option>
                            <option value="9">Huancavelica</option>
                            <option value="10">Huánuco</option>
                            <option value="11">Ica</option>
                            <option value="12">Junín</option>
                            <option value="13">La Libertad</option>
                            <option value="14">Lambayeque</option>
                            <option value="15">Lima</option>
                            <option value="16">Loreto</option>
                            <option value="17">Madre de Dios</option>
                            <option value="18">Moquegua</option>
                            <option value="19">Pasco</option>
                            <option value="20">Piura</option>
                            <option value="21">Puno</option>
                            <option value="22">San Martín</option>
                            <option value="23">Tacna</option>
                            <option value="24">Tumbes</option>
                            <option value="25">Ucayali</option>                          
                          </select>
                        </div>
                      </div>
                      <div class="field comuna required">
                        <label for="comuna_id" class="label">
                          <span>Provincia</span>
                        </label>
                        <div class="control">
                          <select id="comuna_id" name="comuna_id" title="" class="validate-select comuna required-entry" defaultvalue="0">
                            <option value="">Selecciona una opción</option>
                            <option value="1501">Lima </option>
                            <option value="1502">Barranca </option>
                            <option value="1503">Cajatambo </option>
                            <option value="1504">Canta </option>
                            <option value="1505">Cañete </option>
                            <option value="1506">Huaral </option>
                            <option value="1507">Huarochirí </option>
                            <option value="1508">Huaura </option>
                            <option value="1509">Oyón </option>
                            <option value="1510">Yauyos </option>
                          </select>
                        </div>
                      </div>
                      <div class="field locality required">
                        <label for="locality_id" class="label">
                          <span>Distrito</span>
                        </label>
                        <div class="control">
                          <select id="locality_id" name="locality_id" title="" class="validate-select locality required-entry" defaultvalue="">
                            <option value="">Selecciona una opción</option>
                            <option value="150101">Lima</option>
                            <option value="150102">Ancón</option>
                            <option value="150103">Ate</option>
                            <option value="150104">Barranco</option>
                            <option value="150105">Breña</option>
                            <option value="150106">Carabayllo</option>
                            <option value="150107">Chaclacayo</option>
                            <option value="150108">Chorrillos</option>
                            <option value="150109">Cieneguilla</option>
                            <option value="150110">Comas</option>
                            <option value="150111">El Agustino</option>
                            <option value="150112">Independencia</option>
                            <option value="150113">Jesús María</option>
                            <option value="150114">La Molina</option>
                            <option value="150115">La Victoria</option>
                            <option value="150116">Lince</option>
                            <option value="150117">Los Olivos</option>
                            <option value="150118">Lurigancho</option>
                            <option value="150119">Lurin</option>
                            <option value="150120">Magdalena del Mar</option>
                            <option value="150121">Pueblo Libre</option>
                            <option value="150122">Miraflores</option>
                            <option value="150123">Pachacamac</option>
                            <option value="150124">Pucusana</option>
                            <option value="150125">Puente Piedra</option>
                            <option value="150126">Punta Hermosa</option>
                            <option value="150127">Punta Negra</option>
                            <option value="150128">Rímac</option>
                            <option value="150129">San Bartolo</option>
                            <option value="150130">San Borja</option>
                            <option value="150131">San Isidro</option>
                            <option value="150132">San Juan de Lurigancho</option>
                            <option value="150133">San Juan de Miraflores</option>
                            <option value="150134">San Luis</option>
                            <option value="150135">San Martín de Porres</option>
                            <option value="150136">San Miguel</option>
                            <option value="150137">Santa Anita</option>
                            <option value="150138">Santa María del Mar</option>
                            <option value="150139">Santa Rosa</option>
                            <option value="150140">Santiago de Surco</option>
                            <option value="150141">Surquillo</option>
                            <option value="150142">Villa El Salvador</option>
                            <option value="150143">Villa María del Triunfo</option>
                          </select>
                        </div>
                      </div>
                      <style>1</style>
                    </fieldset>
                  </div>
                </center>
                <a class="popup1-close" href="#closed">X</a>
              </div>
            </div>
            <div id="closed"></div>
            <p style="border: 1px solid #003399 !important;border-radius: 5px;padding: 13px;"><img src="{{route('front.index')}}/assets/images/1669243349tienda.png"> Disponibilidad de retiro en tienda <a href="#popup" class="popup-link">ver ubicación de la tienda</a></p>
            <div class="popup-wrapper" id="popup">
              <div class="popup-container">
                <center>
                  <div class="store-content">
                    <div class="pro_title-modal">
                      <span class="popa" style="font-size: 24px;font-weight: 600;">Consultar retiro</span>
                    </div>
                    <div class="content-zona">
                      <div class="row">
                        <div class="pro_content-logo">    
                          <div class="block-col">            
                            <a href="https://goo.gl/maps/HyMcEDXcWLqmz8vF7" style="font-size: 13px;padding-top: 20px;padding-bottom: 20px;float: left;" target="_blank" class="ubi"><img src="{{route('front.index')}}/assets/images/1669243349tienda.png" target="_blank"> AV. Guillermo Dansey n° 454 C. Comercial Nicolini Psj 5 Stand BB-9A - Lima</a>
                          </div>
                          <div class="block-col">
                            <a href="https://goo.gl/maps/5K3fbgwyNf6sJPLA8" style="font-size: 13px;padding-top: 20px;padding-bottom: 20px;float: left;" target="_blank" class="ubi"><img src="{{route('front.index')}}/assets/images/1669243349tienda.png" target="_blank">  Av. Guillermo  Dansey N°401 C.Plaza ferretero  2do  psj C  Piso Tda 2026 - Lima</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </center>
              <a class="popup-close" href="#closed">X</a>
              </div>
            </div>
            <div class="t-c-b-area">
              @if ($item->brand_id)
              <div class="pt-1 mb-1"><span class="text-medium">{{__('Brand')}}:</span>
                <a href="{{route('front.catalog').'?brand='.$item->brand->slug}}">{{$item->brand->name}}</a>
              </div>
              @endif
              <div class="pt-1 mb-1"><span class="text-medium">{{__('Categories')}}:</span>
                <a href="{{route('front.catalog').'?category='.$item->category->slug}}">{{$item->category->name}}</a>
                  @if ($item->subcategory->name)
                  /
                  @endif
                <a href="{{route('front.catalog').'?subcategory='.$item->subcategory->slug}}">{{$item->subcategory->name}}</a>
                  @if ($item->childcategory->name)
                  /
                  @endif
                <a href="{{route('front.catalog').'?childcategory='.$item->childcategory->slug}}">{{$item->childcategory->name}}</a>
              </div>
              <div class="pt-1 mb-1"><span class="text-medium">Etiquetas:</span>
                @if($item->tags)
                @foreach (explode(',',$item->tags) as $tag)
                @if ($loop->last)
                <a href="{{route('front.catalog').'?tag='.$tag}}">{{$tag}}</a>
                @else
                <a href="{{route('front.catalog').'?tag='.$tag}}">{{$tag}}</a>,
                @endif
                @endforeach
                @endif
              </div>
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-1"><span class="text-medium">STOCK:</span> {{$item->stock}}</div>
              @endif
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-1"><span class="text-medium">CÓDIGO SAP:</span> {{$item->sap_code}}</div>
              @endif
              @if ($item->item_type == 'normal')
              <div class="pt-1 mb-4"><span class="text-medium">{{__('SKU')}}:</span>{{$item->sku}}</div>
              @endif
              <!-- NUEVO CONTENIDO (INICIO) -->
              @if($item->adj_doc != "" && $item->adj_doc != null)
              <div class="ficha">
                <a href="{{ asset('assets/files/item/adj_doc/'.$item->adj_doc) }}" target="_blank" title="Ficha Técnica del producto">
                  <img class="fic" src="{{route('front.index')}}/assets/images/ficha-tecnica.png">
                </a>
              </div>
              @endif
              <!-- NUEVO CONTENIDO (FIN) -->
            </div>
            <div class="mt-4 p-d-f-area">
              <div class="left">
                <a class="btn btn-primary btn-sm wishlist_store wishlist_text" href="{{route('user.wishlist.store',$item->id)}}"><span><i class="icon-heart"></i></span>
                @if (Auth::check() && App\Models\Wishlist::where('user_id',Auth::user()->id)->where('item_id',$item->id)->exists())
                <span>{{__('Added To Wishlist')}}</span>
                @else
                <span class="wishlist1">{{__('Wishlist')}}</span>
                <span class="wishlist2 d-none">{{__('Added To Wishlist')}}</span>
                @endif
                </a>
                <button class="btn btn-primary btn-sm  product_compare" data-target="{{route('fornt.compare.product',$item->id)}}" ><span><i class="icon-repeat"></i>{{__('Compare')}}</span></button>
              </div>
              <div class="d-flex align-items-center">
                <span class="text-muted mr-1">Compartir: </span>
                <div class="d-inline-block a2a_kit">
                  <a class="facebook  a2a_button_facebook" href="">
                    <span><i class="fab fa-facebook-f"></i></span>
                  </a>
                  <a class="twitter  a2a_button_twitter" href="">
                    <span><i class="fab fa-twitter"></i></span>
                  </a>
                  <a class="linkedin  a2a_button_linkedin" href="">
                    <span><i class="fab fa-linkedin-in"></i></span>
                  </a>
                  <a class="pinterest   a2a_button_pinterest" href="">
                    <span><i class="fab fa-pinterest"></i></span>
                  </a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class=" padding-top-3x mb-3" id="details">
      <div class="col-lg-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">{{__('Descriptions')}}</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">{{__('Specifications')}}</a>
          </li>
        </ul>
        <div class="tab-content card">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"">
          {!! $item->details !!}
          </div>
          <div class="tab-pane fade show" id="specification" role="tabpanel" aria-labelledby="specification-tab">
            <div class="comparison-table">
              <table class="table table-bordered">
                <thead class="bg-secondary">
                </thead>
                <tbody>
                <tr class="bg-secondary">
                  <th class="text-uppercase">{{__('Specifications')}}</th>
                  <td><span class="text-medium">{{__('Descriptions')}}</span></td>
                </tr>
                @if($sec_name)
                @foreach(array_combine($sec_name,$sec_details) as  $sname => $sdetail)
                <tr>
                  <th>{{$sname}}</th>
                  <td>{{$sdetail}}</td>
                </tr>
                @endforeach
                @else
                <tr class="text-center">
                  <td colspan="2">{{__('No Specifications')}}</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@if(count($related_items)>0)
<div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
  <div class="row">
    <div class="col-lg-12">
      <div class="section-title">
        <h2 class="h3">{{ __('También te puede interesar') }}</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="relatedproductslider owl-carousel" >
        @foreach ($related_items as $related)
          <div class="slider-item">
            <div class="product-card">
              @if ($related->is_stock())
                @if($related->is_type == 'new')
                @else
                  <div class="product-badge
                  @if($related->is_type == 'feature')
                  bg-warning

                  @elseif($related->is_type == 'top')
                  bg-info
                  @elseif($related->is_type == 'best')
                  bg-dark
                  @elseif($related->is_type == 'flash_deal')
                  bg-success
                  @endif
                  ">{{  $related->is_type != 'undefine' ?  ucfirst(str_replace('_',' ',$related->is_type)) : ''   }}</div>
                  @endif
                  @else
                  <div class="product-badge bg-secondary border-default text-body
                  ">{{__('out of stock')}}</div>
              @endif
              @if($related->previous_price && $related->previous_price !=0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
              @endif
              @if($related->previous_price && $related->previous_price !=0)
              <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($related)}}</div>
              @endif
              <div class="product-thumb">
                <a href="{{route('front.product',$related->slug)}}"><img class="lazy" data-src="{{asset('assets/images/'.$related->thumbnail)}}" alt="Product"></a>
                <div class="product-button-group">
                  <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$related->id)}}" title="{{__('Wishlist')}}"><i class="icon-heart"></i></a>
                  <a class="product-button product_compare" href="javascript:;" data-target="{{route('fornt.compare.product',$related->id)}}" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                  @include('includes.item_footer',['sitem' => $related])
                </div>
              </div>
              <div class="product-card-body">
                <div class="product-category"><a href="{{route('front.catalog').'?category='.$related->category->slug}}">{{$related->category->name}}</a></div>
                <h3 class="product-title">
                  <a href="{{route('front.product',$related->slug)}}">
                  {{ strlen(strip_tags($related->name)) > 35 ? substr(strip_tags($related->name), 0, 35) : strip_tags($related->name) }}
                  </a>
                </h3>
                <h4 class="product-price">
                @if ($related->previous_price !=0)
                <del>{{PriceHelper::setPreviousPrice($related->previous_price)}}</del>
                @endif
                {{PriceHelper::grandCurrencyPrice($related)}} </h4>
                <a href="https://api.whatsapp.com/send?phone=51{{$setting->footer_phone}}&text=Solicito información sobre: {{route('front.product',$related->slug)}}" target="_blank" ><img src="../assets/images/boton-pedir-por-whatsapp.png" class="boton-as"></a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endif
<script type="text/javascript" src="{{ asset('assets/front/js/product-details.js') }}"></script>
@endsection