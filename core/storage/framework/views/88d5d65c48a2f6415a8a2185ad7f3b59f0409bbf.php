<?php
	function formatPhone($phone){
		$output_phone = "";
		$output_phone = preg_replace('/(\d{1,3})(?=(\d{3})+$)/', '$1 ', $phone);
		return $output_phone;
	}
	function cambiaf_mysql($date){
		$originalDate = $date;
		$newDate = date("Y/m/d H:i:s", strtotime($originalDate));
		return $newDate;
	}
	function maxcharacters($string, $maxletters){
		$output_strg = "";
		if(strlen($string) > $maxletters){
			$output_strg = substr($string, 0, $maxletters) . "...";
		}else{
			$output_strg = $string;
		}
		return $output_strg;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Previsualización del pedido</title>
</head>
<style>
main table.summary td,main table.summary th{padding:8px;border-bottom:0}body,footer{font-size:10pt}tbody tr td,thead tr th{padding:0 8px}.cH-sec,.cH-sec__cL,.cH-sec__cL__cLogo img,.cH-sec__cR,.cH-sec__cR__cGrp__i,.cH-sec__cR__cNor__i{display:inline-block}.cH-sec__cR__cGrp__i span:first-child,.cH-sec__cR__cNor span:first-child,footer a:first-child,footer p,main table.summary tr.total,thead tr th{font-weight:700}body{margin:0;padding:8px;font-family:Montserrat,sans-serif}a{color:inherit;text-decoration:none}hr{margin:2px 0;height:0;border:0}main table{width:100%;border-collapse:collapse}main table thead th{height:1cm}main table tbody td{padding:2mm 0;border-bottom:.5mm solid var(--table-row-separator-color)}main table th{text-align:left}main table.summary{width:300px;margin-left:70.65%;margin-top:.5cm}main table.summary td{text-align:right}footer{height:3cm;line-height:3cm;padding:0;position:running(footer);background-color:var(--footer-bg-color);display:flex;align-items:baseline;justify-content:space-between}.width-1{width:15px}.width-2{width:30px}.width-3{width:45px}.width-4{width:60px}.width-5{width:75px}.width-6{width:90px}.width-7{width:105px}.width-8{width:120px}.width-9{width:135px}.width-10{width:150px}.width-11{width:165px}.width-12{width:180px}.width-13{width:195px}.width-14{width:205px}.width-15{width:220px}.width-16{width:235px}.width-17{width:250px}.width-18{width:265px}.width-19{width:280px}.pr-1{padding-right:6px}.pl-1{padding-left:6px}.pl-2{padding-left:12px}.t-center{text-align:center}thead tr{background-color:#2980ba}thead tr th{color:#fff}tbody tr:nth-child(2n){background-color:#f5f5f5}.cH-sec{padding:0 25px;width:100%;margin-bottom:58px}.cH-sec__cL__cLogo{padding-top:35px;margin-bottom:15px}.cH-sec__cL__cLogo img{max-width:220px;width:auto;height:auto;position:relative;margin:0}.cH-sec__cL__cDataInfo p{font-size:16px;font-weight:700;margin:0 0 5px}.cH-sec__cR{float:right;position:absolute;top:0;right:0;width:52.5%}.cH-sec__cR__cGrp__i{margin-bottom:3px;max-width:200px;width:200px}.cH-sec__cR__cNor{margin-bottom:10px;width:100%}.cH-sec__cR__cGrp,.cH-sec__cR__cNor{display:inline-block;margin-top:0;padding:0}
</style>
<body>
	<header>
  	<div class="cH-sec">
			<div class="cH-sec__cL">
				<div class="cH-sec__cL__cLogo">
					<img src="<?php echo e(asset('assets/images/1669085546GRUPO-COREIN-LOGOTIPO.png')); ?>" alt="logo_grupocorein" width="100" height="100">
				</div>
				<div class="cH-sec__cL__cDataInfo">
					<p>GRUPOCOREIN S.A.C.</p>
					<p>RUC: 10982361292</p>
				</div>
			</div>
			<div class="cH-sec__cR">
				<div class="cH-sec__cR__cGrp">
					<div class="cH-sec__cR__cGrp__i">
						<span>N.Pedido: </span>
						<span>2020/398</span>
					</div>
					<div class="cH-sec__cR__cGrp__i">
						<span>Fecha: </span>
						<span><?php echo e($dataPDF['session_userInfo']['date']); ?></span>
					</div>
				</div>
				<div class="cH-sec__cR__cNor">
					<span>Cliente: </span>
					<span><?php echo e($dataPDF['session_userInfo']['client']); ?></span>
				</div>
				<div class="cH-sec__cR__cGrp">
					<div class="cH-sec__cR__cGrp__i">
						<span>RUC Cliente: </span>
						<span><?php echo e($dataPDF['session_userInfo']['ruc']); ?></span>
					</div>
					<div class="cH-sec__cR__cGrp__i">
						<span>Usuario: </span>
						<span><?php echo e($dataPDF['session_userInfo']['user']); ?></span>
					</div>
				</div>
				<div class="cH-sec__cR__cNor">
					<span>Dirección: </span>
					<span><?php echo e($dataPDF['session_userInfo']['address']); ?></span>
				</div>
				<div class="cH-sec__cR__cNor">
					<span>Teléfono: </span>
					<span><?php echo e(formatPhone($dataPDF['session_userInfo']['phone'])); ?></span>
				</div>
				<div class="cH-sec__cR__cNor">
					<span>E-mail: </span>
					<span><?php echo e($dataPDF['session_userInfo']['email']); ?></span>
				</div>
				<!--
				<div class="cH-sec__cR__cNor">
					<span>Cond. de Pago: </span>
					<span>Al Contado</span>
				</div>
				<div class="cH-sec__cR__cNor">
					<span>Tipo Entrega: </span>
					<span>Retira en Tienda</span>
				</div>
				<div class="cH-sec__cR__cNor">
					<span></span>
					<span>Av. Guillermo Dansey N°481 Tienda 112-113 - Lima - Lima - Perú</span>
				</div>
				-->
			</div>
		</div>
	</header>
	<main>
		<table>
			<thead>
				<tr>
					<th class="width-2">Item</th>
					<th>Código</th>
					<th>Descripción</th>
					<th>Marca</th>
					<th>Cant.</th>
					<th>P.Unit.</th>
					<th>Dscto.%</th>
					<!-- <th>P.Neto</th> -->
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$countProds = 1;
				?>
				<?php $__currentLoopData = $dataPDF['session_cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="width-2 pl-2"><?php echo e($countProds); ?></td>
					<td class="width-4"><?php echo e($v['sku']); ?></td>
					<td class="width-19"><span><?php echo e(maxcharacters($v['name'], 42)); ?></span></td>
					<td class="width-7"><?php echo e(maxcharacters($v['brand_name'], 23)); ?></td>
					<td class="width-2 pl-2"><?php echo e($v['qty']); ?></td>
					<td class="width-3"><?php echo e($v['price']); ?></td>
					<td class="width-2 pl-2"><?php echo e('0.00'); ?></td>
					<!-- <td class="width-3 pl-2">'160'</td> -->
					<td class="width-3"><?php echo e($v['subtotal']); ?></td>
				</tr>
				<?php
				$countProds++;
				?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<table class="summary">
			<tr>
				<th>Total Neto</th>
				<td><?php echo e($dataPDF['session_cartSubtotal']['subtotal']); ?></td>
			</tr>
			
			<tr>
				<th>Envío</th>
				<td><?php echo e($dataPDF['session_cartSubtotal']['delivery']); ?></td>
			</tr>
			<tr class="total">
				<th>Total a Pagar</th>
				<td><?php echo e($dataPDF['session_cartSubtotal']['totalNeto']); ?></td>
			</tr>
		</table>
	</main>
	<footer>
		<p>Su Pedido será procesado en horario de oficina. Lunes - Viernes: 8:00 a 17:45 / Sábados 9:30 a 13:00</p>
	</footer>
</body>
</html><?php /**PATH C:\xampp\htdocs\grupocorein\core\resources\views/front/checkout/gen_pdforderpreview.blade.php ENDPATH**/ ?>