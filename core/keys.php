<?php
// CREDENCIALES IZZIPAY - SUCURSAL "LOS JASMINEZ"
// ABRIR LA CONEXIÓN CON EL CLIENTE
require_once 'vendor/autoload.php';
// CREDENCIALES TEST (DEVELOPMENT)
$fk_NameServerAPIREST = "https://api.micuentaweb.pe";
$fk_Username = "80999186";

// ------ CREDENCIALES DE PRUEBA

$fk_Password = "testpassword_8UQnGVVZZMZynIEJCmVRH79fIVWQCLQCeQjFqUl3TtXrO";
$fk_Token = "NTMyOTA3Mjp0ZXN0cGFzc3dvcmRfOFVRbkdWVlpaTVp5bklFSkNtVlJINzlmSVZXUUNMUUNlUWpGcVVsM1R0WHJP";
$fk_Publickey = "80999186:testpublickey_gNwgQknEJouS9uRgCwoBXfH7Uqg6hhumos3H5KmiLeXlu";
$fk_SHA_256 = "ehltJw48HfxW3kyL6NZIOo50reCQlEqubeOBVWY6kB5Xk";

// ------ CREDENCIALES DE PRODUCCIÓN
// ------- ACTUALIZADO (PRODUCCIÓN) - 24/04/2024
/*
$fk_Password = "prodpassword_6avYonm3fnb0ATqzG1sOFbaKW8P8ocBE8GpR3jl9QDDXz";
$fk_Token = "ODA5OTkxODY6cHJvZHBhc3N3b3JkXzZhdllvbm0zZm5iMEFUcXpHMXNPRmJhS1c4UDhvY0JFOEdwUjNqbDlRRERYeg==";
$fk_Publickey = "80999186:publickey_GsBZDONbG705YAjMd1zdmZoVxpxkFl81x9Qp5KaPEZh7N";
$fk_SHA_256 = "IPfeyHda7eZSQOs6xs7o9E9AkbgCgkHxj2OAZ8bZdFxJg";
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