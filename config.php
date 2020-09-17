<?php
    require('paypal/autoload.php');

    define('URL_SITIO', 'http://localhost/php_juancarlos/paypal/');

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AdtqJArL_k3JeOhBRSLEC1qWoS7dl3CYu86lBJ72yY2R2PLlEKYFCdvH0F7MRbU_MTIT2Cx37uscGAWq',     // ClientID
            'EH0Fdeloh-s7qTn07drvAwexLYjeuuJemRpoDL0a9puhXfa-mly-SLkAqJiETV8SQ9TEPETtvismtn1C'      // ClientSecret
        )
    );

    
    
?>