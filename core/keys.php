<?php
// CREDENCIALES IZZIPAY - SUCURSAL "LOS JASMINEZ"
// ABRIR LA CONEXIÓN CON EL CLIENTE
require_once 'vendor/autoload.php';
// CREDENCIALES TEST (DEVELOPMENT)
$fk_NameServerAPIREST = "https://api.micuentaweb.pe";
$fk_Username = "80999186";

// ------ CREDENCIALES DE PRUEBA

$fk_Password = "testpassword_8UQnGVVZZMZynIEJCmVRH79fIVWQCLQCeQjFqUl3TtXrO";
$fk_Token = "ODA5OTkxODY6dGVzdHBhc3N3b3JkXzhVUW5HVlZaWk1aeW5JRUpDbVZSSDc5ZklWV1FDTFFDZVFqRnFVbDNUdFhyTw==";
$fk_Publickey = "80999186:testpublickey_gNwgQknEJouS9uRgCwoBXfH7Uqg6hhumos3H5KmiLeXlu";
$fk_SHA_256 = "ckhxwXNWludm5HP5ya1Qc41ZI2r7CfNPqOBZljwlQ555j";

// ------ CREDENCIALES DE PRODUCCIÓN
/*
$fk_Password = "";
$fk_Token = "";
$fk_Publickey = "";
$fk_SHA_256 = "";
*/
/*
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

use \App\PaymentSetting;
$paymentSettings = PaymentSetting::all();

echo "<pre>";
print_r($paymentSettings);
echo "</pre>";
exit();
*/

// CREDENCIALES REALES (INICIO)
Lyra\Client::setDefaultUsername($fk_Username); // NOMBRE DE USUARIO
Lyra\Client::setDefaultPassword($fk_Password); // PASSWORD
Lyra\Client::setDefaultEndpoint($fk_NameServerAPIREST); // END POINT
Lyra\Client::setDefaultPublicKey($fk_Publickey); // LLAVE PÚBLICA UTILIZADA POR EL CLIENT JAVASCRIPT
Lyra\Client::setDefaultSHA256Key($fk_SHA_256); // CODIFICACIÓN DE ACCESO SHA256 KEY