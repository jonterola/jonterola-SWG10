<?php
error_reporting(0);
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$ns="http://swadrianruiz.000webhostapp.com/ProyectoSW2020G10/php/VerifyPassWS.php"; /////PENDIENTE
$server = new soap_server;
$server->configureWSDL('validatePass',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//registramos la función que vamos a implementar
$server->register('validatePass',
array('x'=>'xsd:string','y'=>'xsd:int'),
array('z'=>'xsd:string'),
$ns);
//implementamos la función
function validatePass ($x, $y){
    if($y != 1010)
        return 'SIN SERVICIO';
    $passList = file_get_contents("../txt/toppasswords.txt");
    $pos = strpos($passList, $x);
    if ($pos === false) {
        return 'VALIDA';
    } else {
        return 'INVALIDA';
    }
    
}
//llamamos al método service de la clase nusoap antes obtenemos los valores de los parámetros
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>