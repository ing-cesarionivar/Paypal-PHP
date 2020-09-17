<?php

    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;

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
    $cantidad->setTotal($total);
    $cantidad->setDetails($detalles);

    $transacion = new Transaction();
    $transacion->setAmount($cantidad);
    $transacion->setItemList($listaArticulos);
    $transacion->setDescription('Pago');
    $transacion->setInvoiceNumber(uniqid());

    $redireccionar = new RedirectUrls();
    $redireccionar->setReturnUrl(URL_SITIO . '/pago_finalizado.php?exito=true');
    $redireccionar->setCancelUrl(URL_SITIO . 'pago_finalizado.php?exito=false');

    $pago = new Payment();
    $pago->setIntent('sale');
    $pago->setPayer($compra);
    $pago->setRedirectUrls($redireccionar);
    $pago->setTransactions(array($transacion));

    try {
        $pago->create($apiContext);

    } catch (PayPal\Exception\PayPalConnectionException $pce) {
        
        print_R(json_decode($pce->getData()));

        exit;
    }

    $aprobado = $pago->getApprovalLink();

    header("Location: {$aprobado}");



?>