<?php
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');

    $soapclient = new nusoap_client('http://swadrianruiz.000webhostapp.com/ProyectoSW2020G10/php/VerifyPassWS.php?wsdl', true);
    if(isset($_REQUEST['pass'])){
        echo $soapclient->call('validatePass', array('x'=> $_REQUEST['pass'], 'y'=>(1010)));
    }
?>