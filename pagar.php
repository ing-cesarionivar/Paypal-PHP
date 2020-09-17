<?php

    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
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
    $articulo->setName($producto);
    $articulo->setCurrency('USD');
    $articulo->setQuantity(1);
    $articulo->setPrice($precio);

    $listaArticulos = new ItemList();
    $listaArticulos->setItems(array($articulo));

    $detalles = new Details();
    $detalles->setShipping($envio);
    $detalles->setSubtotal($precio);

    $cantidad = new Amount();
    $cantidad->setCurrency('USD');
    $cantidad->setTotal($precio);
    $cantidad->setDetails($detalles);

?>