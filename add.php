<?php
session_start();
extract($_REQUEST); 
$_SESSION['inicio'] = time();
$_SESSION['intervalo'] = 10; // en minutos
$adventure = $_REQUEST['adventure'];
$availableSpaces = $_REQUEST['availableSpaces'];
$checkin = $_REQUEST['checkin'];
$reservar = $_REQUEST['reservar'];
$people = $_REQUEST['people_'.$reservar];
$price = $_REQUEST['price_'.$reservar];
$arrival = $_REQUEST['arrival'];
$departure = $_REQUEST['departure'];
$ending = $_REQUEST['ending'];
$return = $_REQUEST['return'];
$fechaTexto = $_REQUEST['fechaTexto'];
$carro=$_SESSION['carro']; 
$identificador = $adventure."-".$checkin;
$cupon = $_REQUEST['code_promotion'];
$deposit = $_REQUEST['deposit'];
$special = $_REQUEST['specialDate'];
$pickupPlace = $_REQUEST['pickupPlace'];
$codePlace = $_REQUEST['codePlace'];
$pickup = $_REQUEST['pickup'];
$item = $_REQUEST['item_'.$reservar];

if($item){
	$ItemExis = "Item=1";	
}

$carro[md5($identificador)]=array('identificador'=>md5($identificador),'cantidad'=>$people,'fecha'=>$checkin,'arrival'=>$arrival,'departure'=>$departure,'ending'=>$ending,'return'=>$return,'fechaTexto'=>$fechaTexto,'horario'=>$reservar,'precio'=>$price,'deposit'=>$deposit,'pickupPlace'=>$pickupPlace,'pickup'=>$pickup,'codePlace'=>$codePlace,'specialDate'=>$special,'item'=>$item,'id'=>$adventure);

$_SESSION['carro']=$carro; 
header("Location:index.php?cmd=cart&".$ItemExis);


?>