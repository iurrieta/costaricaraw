<?php


function fecha(){

$zone=3600*-6; 
return gmdate("d/m/Y", time() + $zone);
	
}

function proximo_viernes(){
$zone=3600*-6; 
$Fecha = gmdate("Y/m/d", time() + $zone);
return date('m-d-Y',strtotime($Fecha.' next friday'));
	
}

function domingo_anterior(){

$zone=3600*-6; 
$Fecha = gmdate("Y/m/d", time() + $zone);
return date('Y-m-d',strtotime($Fecha.' last sunday'));	
	
}

function hoy(){
$zone=3600*-6; 
return gmdate("Y-m-d", time() + $zone);
}
function fechaHora(){
$zone=3600*-6; 
return gmdate("Y-m-d g:i:s", time() + $zone);
 	
}


function semana(){
$zone=3600*-6; 
$Fecha = gmdate("Y-m-d", time() + $zone);
$Inicio = date('Y-m-d',strtotime($Fecha.' last sunday'));
$Fin = date('Y-m-d',strtotime($Fecha.' next sunday'));
$Semana = "datetime between '".$Inicio."' AND '".$Fin."'";
return $Semana;
 	
}
function mes(){
$zone=3600*-6; 
$MesDate = gmdate("m-Y", time() + $zone);
$Mes = "date_format(date,'%m-%Y')='".$MesDate."'";
return $Mes;
 	
}

function Translate($LangTrans,$Text){
  /*  $Destino = 'ENGLISH_to_'.$LangTrans;
    $gt = new Gtranslate;
	$gt->setRequestType('curl');*/
	return $Text;
}
	
function fecha_texto(){

$zone=3600*-6; 
$Fecha = gmdate("Y/m/d", time() + $zone);
$diaArray = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$MesArray = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$DiaNombre = $diaArray[date('N',strtotime($Fecha))];
$Mes = $MesArray[date('n',strtotime($Fecha))];
$Year = date('Y',strtotime($Fecha));
$Dia = date('d',strtotime($Fecha));
return $DiaNombre.', '.$Dia.' '.$Mes.' '.$Year;
	
}

function NombrarFecha($Fecha){
	
$diaArray = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$MesArray = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$DiaNombre = $diaArray[date('N',strtotime($Fecha))];
$Mes = $MesArray[date('n',strtotime($Fecha))];
$Year = date('Y',strtotime($Fecha));
$Dia = date('j',strtotime($Fecha));
return $DiaNombre.', '.$Dia.' '.$Mes.' '.$Year;	
	
}

function NombrarDia($Fecha){
	
$diaArray = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$MesArray = array("","January","February","March","April","May","June","July","August","September","October","November","December");
$DiaNombre = $diaArray[date('N',strtotime($Fecha))];
$Mes = $MesArray[date('n',strtotime($Fecha))];
$Year = date('Y',strtotime($Fecha));
$Dia = date('j',strtotime($Fecha));
return $DiaNombre;	
	
}

function alpha_numeric($str)
{
	return ( ! preg_match("/^([-a-z0-9])+$/i", $str)) ? FALSE : TRUE;
}
	
function numeric($str)
{
	return ( ! preg_match("/^([0-9])+$/i", $str)) ? FALSE : TRUE;
}	

function valid_email($str)
{
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}


function encontrar_extension ($fichero) {
       $fichero = strtolower($fichero) ;
       $extension = split("[/\\.]", $fichero) ;
       $n = count($extension)-1;
       $extension = $extension[$n];
       return $extension;
} 


function TipoCambio($iso,$balance){
$db = new MySQL(); 
$sqlTipoCambio= $db->consulta("SELECT * FROM `tipo_cambio` Order by `idCambio` DESC");
$TipoCambio = $db->fetch_array($sqlTipoCambio);	

if($iso=="USD"){
$Monto = number_format($balance*$TipoCambio['compra'],2,'.',',');
$BalanceCambio = "&cent;".$Monto." CRC";	
}
if($iso=="CRC"){
$Monto = number_format($balance/$TipoCambio['venta'],2,'.',',');
$BalanceCambio = "$".$Monto." USD";	
}

$Valores = array(
'compra'=>number_format($TipoCambio['compra'],2,'.',','),
'venta'=>number_format($TipoCambio['venta'],2,'.',','),
'balance'=>$BalanceCambio
);

return $Valores;	
}


function clean_html_code($texto)
{
	
$TextoPlano1 = preg_replace("#(<span.*?>|</span>)#i", "", $texto);
$TextoPlano2 = preg_replace("#(<p.*?>|</p>)#i", "", $TextoPlano1);
$TextoPlano3 = preg_replace("#(<em.*?>|</em>)#i", "", $TextoPlano2);
$TextoPlano4 = preg_replace("#(<li.*?>|</li>)#i", "", $TextoPlano3);
$TextoPlano5 = preg_replace("#(<ul.*?>|</ul>)#i", "", $TextoPlano4);
$TextoPlano6 = preg_replace("#(<font.*?>|</font>)#i", "", $TextoPlano5);
$TextoPlano7 = preg_replace("#(<h1.*?>|</h1>)#i", "", $TextoPlano6);

    return $TextoPlano7;

}
?>