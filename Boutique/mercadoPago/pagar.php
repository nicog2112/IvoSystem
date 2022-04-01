          
<?php
// SDK de Mercado Pago
require 'vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7217696217221853-120814-9b6a61b8bbbc0572b17d44ee25dda6c7-346893243');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = 001;
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();







?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

<script src="https://sdk.mercadopago.com/js/v2"></script></head>
<body>
	<h3>MERCADO PAGO</h3>
	<div class="cho-container"></div>
	

<script>
  // Agrega credenciales de SDK
  const mp = new MercadoPago("TEST-2acf2d59-c56f-420c-8ef7-064dcc15c294", {
    locale: "es-AR",
  });

  // Inicializa el checkout
  mp.checkout({
    preference: {
      id: "<?php echo $preference->id;  ?>",
    },
    render: {
      container: ".cho-container", // Indica el nombre de la clase donde se mostrará el botón de pago
      label: "Pagar con Mercado Pago", // Cambia el texto del botón de pago (opcional)
    },
  });
</script>
</body>
</html>