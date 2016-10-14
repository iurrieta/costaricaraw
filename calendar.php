<?php
session_start();
if($_SESSION["time"]){
include('includes/sesiones.php');
}
?>
<style>
body{
	background-color:#F3CD9C;
	margin:0 0 0 0;

}

</style>
<link href="css/calendar.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="500">
  <tr>
    <td>

<?php
include("includes/configuracion.php");
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
$db = new MySQL();
$cmd = $_REQUEST['cmd'];
$idAdventure = $_REQUEST['adv'];
$adv = $_REQUEST['adv'];

$sqlAdventurePrint = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$idAdventure."' AND `status`='1' OR `status`='5'");
$Adventure = $db->fetch_array($sqlAdventurePrint);


$dias = unserialize($Adventure['days']);
   for ($i = 0; $i < count($dias); $i++)
 {
if($dias[$i]=="Monday"){	
$Monday = "enabled";
}
if($dias[$i]=="Tuesday"){	
$Tuesday = "enabled";
}
if($dias[$i]=="Wednesday"){	
$Wednesday = "enabled";
}
if($dias[$i]=="Thursday"){	
$Thursday = "enabled";
}
if($dias[$i]=="Friday"){	
$Friday = "enabled";
}
if($dias[$i]=="Saturday"){	
$Saturday = "enabled";
}
if($dias[$i]=="Sunday"){	
$Sunday = "enabled";
}


}
// Include calendar class
require_once('includes/clases/calendar.class.php');
// Create calendar object
$cal = new calendar;
// Turn on navigation links
$cal->enableNavigation();
// Add event on current day
//$_GET['month'], $_GET['year']

if($_GET['month']==""){
	$mes_actual = date('n');
}else{
	$mes_actual = $_GET['month'];
}
if($_GET['year']==""){
	$ano_actual = date('Y'); 
}else{
	$ano_actual = $_GET['year'];
}
$FechaHoy = date('Y-n-j');
$i = 1; 
$th   =   ""; 
$td   =   ""; 
$contenido = "<?php\n";
while (checkdate($mes_actual,$i,$ano_actual)) { 
  
   $i<1?$n='0'.$i:$n=$i; 
   $i<1?$d=''.$i:$d=$i; 
  
  	$fechaGenerado = $ano_actual."-".$mes_actual."-".$n;
  
  	$TableInventory = $db->consulta("SELECT SUM(`reserved`) FROM `adventures_inventory` WHERE `date`='".$fechaGenerado."' AND `adventures_id`='".$Adventure['id']."'");
	list($Inventory) = $db->fetch_array($TableInventory);
	
	$TableTimes = $db->consulta("SELECT SUM(`spaces`),`price`,`status` FROM `adventures_times` WHERE `adventure`='".$Adventure['id']."'");
	list($Disponibles,$PrecioAdv,$EstadoHorario)=$db->fetch_array($TableTimes);
	
	$TableSpecial = $db->consulta("SELECT * FROM `adventure_offert` WHERE `date`='".$fechaGenerado."' AND `adventure`='".$Adventure['id']."'");
	$Specials = $db->fetch_array($TableSpecial);
	$ExisteSpecial = $db->num_rows($TableSpecial);
	
	$Existencia = $Disponibles - $Inventory;


if($fechaGenerado==$FechaHoy) {

}else{
	if(strtotime($FechaHoy) > strtotime($fechaGenerado)){
		
	}else{

list($NAnio,$NMes,$NDia)= explode("-",$fechaGenerado);

$NombreDia = NombrarDia($fechaGenerado);
// ELIMINADOR DE DIAS //
if($NombreDia=="Monday"){
if($Monday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	
		if($Existencia==0){
			
		}else{
			
		list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{	
			if($EstadoHorario==1){	
				$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}
// ELIMINADOR DE DIAS //
if($NombreDia=="Tuesday"){
if($Tuesday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{	
			if($EstadoHorario==1){		
				$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}
// ELIMINADOR DE DIAS //
if($NombreDia=="Wednesday"){
if($Wednesday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{		
			if($EstadoHorario==1){	
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}			
// ELIMINADOR DE DIAS //
if($NombreDia=="Thursday"){
if($Thursday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{		
			if($EstadoHorario==1){	
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}			
// ELIMINADOR DE DIAS //
if($NombreDia=="Friday"){
if($Friday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{	
			if($EstadoHorario==1){	
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}			
// ELIMINADOR DE DIAS //
if($NombreDia=="Saturday"){
if($Saturday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{		
			if($EstadoHorario==1){	
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}			
// ELIMINADOR DE DIAS //
if($NombreDia=="Sunday"){
if($Sunday=="enabled"){
	
	if($Existencia==0){

	}else{
		
		if($ExisteSpecial > 0){
		//if($Specials['newspace'] > $Adventure['spaces']){
			$Existencia = $Specials['spaces'] - $Inventory;
		//}	

			if($Existencia==0){
			
		}else{
			list($Anio,$Mes,$Dia)= explode("-",$Adventure['day']);
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available PriceOferta\',\'\');';
		}
		
		}else{	
			if($EstadoHorario==1){		
		$contenido .= '$cal->addEvent(\'Book Now\', '.$ano_actual.', '.$mes_actual.', '.$d.',\'reserve.php?day='.$fechaGenerado.'&adventure='.$Adventure['id'].'\',\'facebox\', \'cal-available Price\',\'\');';
			}
		}
		
	}
}
}			
// ELIMINADOR DE DIAS //
	
}
}
  $contenido .= "\n";
  
  
  $i++;  
}
$contenido .= "\n?>"; 
$archivo="inventario.php"; 

echo "<!-- $contenido -->";

$fp=fopen($archivo,'w+'); 
fwrite($fp,$contenido); 
fclose($fp);

include('inventario.php');


/*
$cal->addEvent('Available 8', 2011, 3, 2, 'http://www.example-event.com');
$cal->addEvent('Available 2', 2011, 3, 3, 'http://www.example-event.com');
$cal->addEvent('Available 12', 2011, 4, 3, 'http://www.example-event.com');
$cal->addEvent('Available 6', 2011, 4, 16, 'http://www.example-event.com');
*/


// Set innerborder to 1, this alter tables cellspacing, much easier than using CSS
$cal->setInnerBorder(1);
// Turn on non month days
$cal->enableNonMonthDays();
// Turn on pretty html output
$cal->enablePrettyHTML(TRUE);
// Display year along side month
$cal->enableYear(TRUE);
// Display calendar
$cal->display($_GET['month'], $_GET['year']);

?>

</td>
  </tr>
</table>
<!--Start of Tawk.to Script
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5796127592a0df3b7f408c8f/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
End of Tawk.to Script-->