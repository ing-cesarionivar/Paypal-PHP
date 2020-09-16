<?php

    use PayPal\Api\Item;
    use PayPal\Api\Payer;

    if(!isset($_POST['producto'], $_POST['precio'])) {
        exit("Hubo un error");
    }

    require('config.php');

    $producto = htmlspecialchars($_POST['producto']);
    $precio = htmlspecialchars($_POST['precio']);
    $precio = (int) $precio;
    $envio = 0;
    $total = $precio + $envio;

    $compra = new Payer();
    $compra->setPaymentMethod('paypal');

    $articulo = new Item();

?>