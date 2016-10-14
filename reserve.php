<?php
session_start();
if($_SESSION["time"]){
include('includes/sesiones.php');
}
include("includes/configuracion.php");
$language = new Language();
$lang = $language->getLanguage(@$_POST['lang']);
$Idioma = $_SESSION['LANGUAGE'];
$db = new MySQL();
$cmd = $_REQUEST['cmd'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Reserve Your Tour</title>

  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body{
	font-size:12px;
	font-family:Tahoma, Geneva, sans-serif;
}




</style>

</head>

<body>
<?php


// CAMPOS FORMULARIO
$firstname = "First Name";
$lastname = "Last Name";
$phone = "Phone";
$checkin = "Arrival Date";
$personas = "Number of People";
$childrens = "Childrens";
$adults = "Adults";
$reserve = "Add to Cart!";
$notavailable = "Not Available Spaces for this day";
$availableSpaces = "Available Spaces for this day";
$notPossible = "Not possible reserve this date";
$country = "Country";
$state = "State";
$address = "Address";
$zip = "ZIP";
$agree = "I Agree Terms and Conditions";
$peopleRequired = "*Required three persons";
$hour = "Arrival Time";



$nameReq = "Your First Name is required!";
$lastReq ="Your Last Name is required!";
$emailReq = "Your Email is required!";
$emailValidReq = "Your Email not is valid!";
$phoneReq = "Phone Number is required!";
$countryReq = "Country is required!";
$stateReq = "State is required!";
$addressReq = "Your Address is required!";
$zipReq = "ZIP Code is required!";
$agreeReq = "Please confirm you agree terms and conditions!";

$FechaSeleccionada = $_REQUEST['day'];
$FechaHoy = date('Y-n-j');
if(($FechaSeleccionada==$FechaHoy) || (strtotime($FechaHoy) > strtotime($FechaSeleccionada))){
	echo "<center><br><br><font color=\"#990000\" size=\"4\">".$notPossible."</font><br><br></center>";
}else{


	

?>
 

<?php
$TableAdventure = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$_REQUEST['adventure']."'");
$Adventure = $db->fetch_array($TableAdventure);
echo $Adventure["chat"];

$Deposit = $Adventure['deposit'];



$TableSpecial = $db->consulta("SELECT * FROM `adventure_offert` WHERE `date`='".$_REQUEST['day']."' AND `adventure`='".$_REQUEST['adventure']."'");
$ExisteSpecial = $db->num_rows($TableSpecial);

?>
<div id="forma" style="display:block">
<form action="https://www.costaricaraw.com/dev/add.php" method="post" enctype="multipart/form-data" name="reserveForm" id="reserveForm" target="_parent">
<input type="hidden" name="adventure" value="<?=$_REQUEST['adventure']?>">



<table width="100%" border="0" cellpadding="0" cellspacing="0" style="min-height:300px;">
 
  <tr>
    <td align="right" class="texto"><strong><?php echo $checkin; ?>:</strong></td>
    <td>&nbsp;</td>
    <td><input name="checkin" type="hidden" class="input" id="checkin" value="<?php echo $_REQUEST['day'];?>"/>
    <input name="fechaTexto" type="text" class="input" id="fechaTexto" autocomplete="off" value="<?php echo NombrarFecha($_REQUEST['day']);?>" size="20" readonly="readonly"/>
        <input type="button" name="prev" id="prev" value="<" class="button" onclick="prevDate()"/>
        <input type="button" name="next" id="next" value=">" class="button" onclick="nextDate()"/>
    </td>
  </tr>
    <?php 
	if($Adventure['pickup']==1){ 
	
	$PlacesValidate = 'if (reserveForm.pickupPlace.value == "") { alert("Please enter your place of pick-up"); reserveForm.pickupPlace.focus(); return; }';	?>
  <tr>
    <td align="right" class="texto"><strong>Please enter your place of pick-up:</strong><span style="font-size:10px; color:#900; font-weight:bold;">*</span> </td>
    <td>&nbsp;</td>
    <td><input name="pickupPlace" type="text" class="input" id="pickupPlace" size="20" /></td>
  </tr>
  <tr>
    <td align="right" class="texto"><strong>Note:</strong></td>
    <td>&nbsp;</td>
    <td class="texto"><span style="font-size:10px; color:#900; font-weight:bold;"><?=$Adventure['note']?></span></td>
  </tr>
  
  <?php } ?>
      <?php 
	if($Adventure['code']){ 
	
	$PlacesCodeValidate = 'if (reserveForm.codePlace.value.length<6) { alert("Invalid Confirmation Code"); reserveForm.codePlace.focus(); return; }';	?>
  <tr>
    <td align="right" class="texto"><strong>Confirmation Code:</strong><span style="font-size:10px; color:#900; font-weight:bold;">*</span> </td>
    <td>&nbsp;</td>
    <td><input name="codePlace" type="text" class="input" id="codePlace" size="10" maxlength="6" />
        <div style="display: inline;color:limegreen;" id="tawkbutton">
            <a style="text-decoration: none;color:limegreen;" href="javascript:void(Tawk_API.toggle())"><strong>LIVE CHAT!</strong></a>
        </div>
    </td>
  </tr>
  <tr>
    <td align="right" class="texto"><strong>Note:</strong></td>
    <td>&nbsp;</td>
    <td class="texto"><span style="font-size:10px; color:#900; font-weight:bold;"><?=$Adventure['notecode']?></span></td>
  </tr>
  
  <?php } ?>
  
  
  <tr>
    <td colspan="3"><div class="lineas" ></div></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
      <tr>
    <td colspan="3" valign="top" class="texto">    <table border="0" cellspacing="3" cellpadding="2" align="center">
     <tr>
          <td width="45" align="center">Available<br />Spaces</td>
          <td width="45" align="center">Price</td>
          <td align="center"><span id="item" style="display:none; width:110px;">Item</span></td>
          <td width="45" align="center" >Select</td>
          <td width="90" align="center">Check-in<br />Departure</td>
           <td width="80" align="center" >Qty</td>
          <td width="190" >Required</td>
          </tr>
<?php
	

if($ExisteSpecial > 0){



//* NUEVO CODIGO

while($Specials=$db->fetch_array($TableSpecial)){	


$TableInventory = $db->consulta("SELECT SUM(`reserved`) FROM `adventures_inventory` WHERE `date`='".$_REQUEST['day']."' AND `adventures_id`='".$_REQUEST['adventure']."' AND `special_id`='".$Specials['id']."'");
list($Busqueda) = $db->fetch_array($TableInventory);


$restan = $Busqueda+$Specials['required'];
	
		if($restan > $Specials['required']){
			$RequiereP = 1;
			$PeopleRequired = 1;
		}else{
			$RequiereP = $Specials['required'];	
			$PeopleRequired= $Specials['required'];	
			
		}

$Disponible = $Specials['spaces']-$Busqueda;

if(($Disponible==0) || ($Disponible < 0)){
	$NoReserva = "disabled";	
}
$espacios = $Disponible + 1;

	

$Precio = $Specials['price'];

?>
  <tr>
        <td  align="center" ><?=$Disponible?></td>
        <td  align="center" >$<?=$Precio?></td>
        <td  align="center" ><?=$Specials['item']?></td>
          <td align="center" ><input name="reservar" type="radio" value="<?=$Specials['id']?>" <?=$NoReserva?>/></td>
          <td align="center" ><?=$Specials['departure']?></td>
           <td align="center"  ><select name="people_<?=$Specials['id']?>" class="input" id="people" style="border:solid 1px #666; width:45px;">
             <?php
	
	
	 for ($j=$RequiereP; $j < $espacios; $j++) {
		echo "<option value=\"$j\"";
			echo ">$j</option>";
	 }
	  ?>
           </select></td>
          <td ><span style="font-size:10px; color:#900; font-weight:bold;">*Required <?=$PeopleRequired?></span>
          <input type="hidden" name="availableSpaces" value="<?=$Disponible?>" />
		  <input type="hidden" name="price_<?=$Specials['id']?>" value="<?=$Precio?>" />
           <input type="hidden" name="item_<?=$Specials['id']?>" value="<?=$Specials['item']?>" />
          <input type="hidden" name="deposit" value="<?=$Deposit?>" />
          <input type="hidden" name="specialDate" value="1" />
          <?php
		  if($Specials['item']){
			  echo "<script>ItemTitle();</script>";
		  }
		  ?>
          </td>
          </tr>

      
      <?php
	  unset($PeopleRequired);
	  unset($RequiereP);
	  unset($Disponible);
	  unset($NoReserva);
	  unset($restan);
}

if($ExisteSpecial==1){

	$Validar = 	'OneCheck(reserveForm);';
	
}else{
	$Validar = 	'Check(reserveForm);';
}

//* Tabla Tiempo

}else{

	
	
// TIEMPO	
$sql = $db->consulta("SELECT * FROM `adventures_times` WHERE `adventure`='".$_REQUEST['adventure']."' AND `status`='1'");	
	
$Contador = $db->num_rows($sql);	

while($Horarios=$db->fetch_array($sql)){	


$TableInventory = $db->consulta("SELECT SUM(`reserved`) FROM `adventures_inventory` WHERE `date`='".$_REQUEST['day']."' AND `adventures_id`='".$_REQUEST['adventure']."' AND `time_id`='".$Horarios['id']."'");
list($Busqueda) = $db->fetch_array($TableInventory);

$restan = $Busqueda+$Horarios['required'];
	
		if($restan > $Horarios['required']){
			$RequiereP = 1;
			$PeopleRequired = 1;
		}else{
			$RequiereP = $Horarios['required'];	
			$PeopleRequired= $Horarios['required'];	
			
		}

$Disponible = $Horarios['spaces']-$Busqueda;

if(($Disponible==0) || ($Disponible < 0)){
	$NoReserva = "disabled";	
}
$espacios = $Disponible + 1;

$Precio = $Horarios['price'];

?>
  
        <tr>
        <td  align="center" ><?=$Disponible?></td>
        <td  align="center" >$<?=$Precio?></td>
        <td  align="center" ><?=$Horarios['item']?></td>
          <td align="center" ><input name="reservar" type="radio" value="<?=$Horarios['id']?>" <?=$NoReserva?>/></td>
          <td align="center" ><?=$Horarios['departure']?></td>
           <td align="center"  ><select name="people_<?=$Horarios['id']?>" class="input" id="people" style="border:solid 1px #666; width:45px;">
             <?php
	
	
	 for ($j=$RequiereP; $j < $espacios; $j++) {
		echo "<option value=\"$j\"";
			echo ">$j</option>";
	 }
	  ?>
           </select></td>
          <td ><span style="font-size:10px; color:#900; font-weight:bold;">*Required <?=$PeopleRequired?></span>
          <input type="hidden" name="availableSpaces" value="<?=$Disponible?>" />
		  <input type="hidden" name="price_<?=$Horarios['id']?>" value="<?=$Precio?>" />
          <input type="hidden" name="item_<?=$Horarios['id']?>" value="<?=$Horarios['item']?>" />
          <input type="hidden" name="pickup" value="<?=$Adventure['pickup']?>" />
          <input type="hidden" name="deposit" value="<?=$Deposit?>" />
          <input type="hidden" name="specialDate" value="0" />
          <?php
		  if($Horarios['item']){
			  echo "<script>ItemTitle();</script>";
		  }
		  ?>
          </td>
          </tr>
      
      
      <?php
	  unset($PeopleRequired);
	  unset($RequiereP);
	  unset($Disponible);
	  unset($NoReserva);
	  unset($restan);
}

if($Contador==1){

	$Validar = 	'OneCheck(reserveForm);';
	
}else{
	$Validar = 	'Check(reserveForm);';
}

}
?></table></td>
    </tr>
 
 
   
 <tr>
   <td colspan="3"><div style="min-height:15px;"></div></td>
 </tr>
  
  <tr>
    <td colspan="3" align="center" valign="top"><input type="button" name="Submit" id="button" value="<?php echo $reserve; ?>" class="button" onclick="<?=$Validar?>"  /><!--onclick="step(reserveForm);"--></td>
  </tr>
   <tr>
   <td colspan="3"><div style="min-height:25px; padding:10px;"></div></td>
 </tr>
  </table>

</form>
</div>

<?php } ?>

<script>
 
var reserveForm = document.getElementById('reserveForm');
   
function Check(reserveForm){
	
	var reservar=0;
	var s = 0;
	var form = document.reserveForm;

	 <?php echo $PlacesValidate;?>
	<?php echo $PlacesCodeValidate; ?>

	for(i=0; ele=document.reserveForm.reservar[i]; i++){
	if (ele.type=='radio')
	if (ele.checked){
		reservar=1;
		break;
		}
	}
	if (reservar==1){
		
		document.getElementById('reserveForm').submit();
		
		}else{
	alert('Please Select Time');
	
	return;
	
	}
	 
 }
 
 
 function OneCheck(reserveForm){
	
	var reservar=0;
	var s = 0;
	var form = document.reserveForm;
	
	 <?php echo $PlacesValidate;?>
	 <?php echo $PlacesCodeValidate; ?>
	
	if(document.reserveForm.reservar.checked) { 
		document.getElementById('reserveForm').submit();
	
	 }else{
		alert('Please Select Time');
		return; 
	 }
	
}

function ItemTitle(){
    console.log("sdasd");
	div = document.getElementById("item");
	div.style.display="block";

}

//next and prev date
var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

function nextDate() {
    var parse = Date.parse(document.getElementById('fechaTexto').value);
    var date = new Date(parse);
    date.setDate(date.getDate() + 1);
    document.getElementById('fechaTexto').value = days[date.getDay()]+", "+date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();

}

function prevDate() {
    var parse = Date.parse(document.getElementById('fechaTexto').value);
    var date = new Date(parse);
    var hoy = Date.now();

    if( (new Date(date).getTime() > new Date(hoy).getTime())) {

        date.setDate(date.getDate() - 1);
        document.getElementById('fechaTexto').value = days[date.getDay()]+", "+date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();
    } else {
        alert('Invalid Date');
    }
}

</script>

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
</body>
</html>