
<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7217696217221853-120814-9b6a61b8bbbc0572b17d44ee25dda6c7-346893243');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();

/*
curl -X POST -H "Content-Type: application/json" -H 'Authorization: Bearer TEST-7217696217221853-120814-9b6a61b8bbbc0572b17d44ee25dda6c7-346893243' "https://api.mercadopago.com/users/test_user" -d '{"site_id":"MLA"}'
//{"id":1035178741,"nickname":"TETE9233517","password":"qatest9062","site_status":"active","email":"test_user_88354685@testuser.com"}
//{"id":1035174209,"nickname":"TETE8444656","password":"qatest120","site_status":"active","email":"test_user_58629395@testuser.com"}

*/
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

<script src="https://sdk.mercadopago.com/js/v2"></script>

</head>
<body>
<div class="cho-container">
    <form action="procesarPago.php" class="">
        <script
  src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
  data-preference-id="<?php echo $preference->id; ?>">
</script>
    </form>
  
</div>
</body>
</html>

