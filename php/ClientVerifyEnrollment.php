<?php
    require_once('../lib/nusoap.php');
    require_once('../lib/class.wsdlcache.php');

    $soapclient = new nusoap_client('https://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);

    if(isset($_REQUEST['email'])){
        if( $soapclient->call('comprobar', array('x'=> $_REQUEST['email'])) == 'SI') echo 'SI';
        else echo 'NO';    
    }else{echo 'Bad request :(';}
?>