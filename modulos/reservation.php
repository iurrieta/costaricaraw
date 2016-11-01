<?php 
$action = $_REQUEST['action'];
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
$hour = "Hour Arrival";
$DisclosurePolicy = "Disclosure & Cancellation Policy";



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

if($action =="confirm"){
extract($_REQUEST); 
$carro=$_SESSION['carro']; 
$name=$_POST['name'];
$lastname=$_POST['lastname']; 
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$address = $_POST['address'];
$agree = $_POST['agree'];
$checkin = $_POST['checkin'];
$people = $_POST['people'];
$adults = $_POST['adults'];
$childrens = $_POST['childrens'];
$adventure = $_POST['adventure'];
$availableSpaces = $_POST['availableSpaces'];
$code_promotion = $_POST['code_promotion'];
	
$db = new MySQL();

$zone=3600*-6; 
$date = gmdate("Y-m-d", time() + $zone);;
$time = gmdate("g:i:s", time() + $zone);;

$save = $db->consulta("INSERT INTO `reservations` (`date`,`time`,`checkIn`,`name`,`lastname`,`email`,`paymentMethod`) VALUES ('".$date."','".$time."','".$checkin."', '".$name."','".$lastname."','".$email."','paypal')");

    /**
     * prueba envio de email
     */
    mail('booked@costaricaraw.com', 'costaricaraw', 'esta es una prueba');

$reserveNumber = $db->getLastID();

$suma=0;
$depositLine=0;
foreach($carro as $k => $v){
  
   $subto=$v['cantidad']*$v['precio'];
   
   
   
   if($v['deposit'] > 0){
	$subtoD=$v['cantidad']*$v['deposit'];
	$suma = $suma+$subtoD;
	$depositLine = 	 $depositLine+$subtoD;
   }else{
    $suma=$suma+$subto;
	$sinDeposito=$sinDeposito+$subto;
   }
   $Total = $Total+$subto;
   
   if($v['specialDate']){
	$sqlHorario = $db->consulta("SELECT * FROM `adventure_offert` WHERE `id`='".$v['horario']."'");
	$Horario = $db->fetch_array($sqlHorario);	
	$Extra1 = ",`special_id`";
	
	}else{
     $sqlHorario = $db->consulta("SELECT * FROM `adventures_times` WHERE `id`='".$v['horario']."'");
     $Horario = $db->fetch_array($sqlHorario);
	 $Extra1 = ",`time_id`";
	}

if($depositLine==0){
$Balance=0;
$depositLine=0;
}else{
$Balance = $subto-$depositLine;
}


$reservLines = $db->consulta("INSERT INTO `reservations_line` (`people`,`reservations_id`,`adventures_id`,`date`,`departure`,`end`,`fecha`,`price`,`total`,`deposit`,`balance`,`pickup`,`item`,`code`) VALUES ('".$v['cantidad']."','".$reserveNumber."','".$v['id']."','".$v['fecha']."', '".$Horario['departure']."','".$Horario['arrival']."','".$v['fechaTexto']."', '".$v['precio']."','".$subto."','".$depositLine."','".$Balance."','".$v['pickupPlace']."','".$Horario['item']."','".$v['codePlace']."')");

$sqlInventory = $db->consulta("INSERT INTO `adventures_inventory` (`date`,`reserved`,`adventures_id`,`reservations_id` ".$Extra1.") VALUES ('".$v['fecha']."','".$v['cantidad']."','".$v['id']."','".$reserveNumber."','".$v['horario']."')");

$sqlAdventure = $db->consulta("SELECT `name`,`locations_id`,`specialnote` FROM `adventures` WHERE `id`='".$v['id']."'");
list($AdventureName,$LocationID,$SpecialNT) = $db->fetch_array($sqlAdventure);
$sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$LocationID."'");
list($LocationName) = $db->fetch_array($sqlLocation);

if($depositLine==0){
	$BalanceDue="";
}else{
	$BalanceDue = "<br><b>Deposit:</b> $".$depositLine."<br><b>Balance Due:</b> <span style=\"color:#CC0000\">$".$Balance."</span>";
}

if($v['pickup']==1){
	$PickupPlace = $v['pickupPlace'];
	$PickupNote = $PickNote;
	
	$PickupText = "<br><strong>Place of pick-up:</strong> ".$v['pickupPlace']."<br>";
}
if($SpecialNT){
	$SpecialNote = "<br><span style='color:#900;'><strong>Special Note:</strong></span> ".$SpecialNT."<br>";
}	
if($Horario['item']){
$Item = "<br><b>Item:</b> ".$Horario['item'];
}
if($v['codePlace']){
	$CodePlace = "<br><strong>Confirmation Code:</strong> ".$v['codePlace']."<br>";
}
$lineas .= "<b>Adventure: </b>".$AdventureName."<br><b>Location: ".$LocationName."</b><br><b>Date:</b> ".$v['fechaTexto']."".$Item."<br><b>Departure:</b> ".$Horario['departure']."<br><b>Return:</b> ".$Horario['arrival']."<br><b>Qty:</b> ".$v['cantidad']."<br><b>Cost:</b> $".$v['precio']."<br><b>Total:</b> $".$subto."".$BalanceDue.$PickupText.$SpecialNote.$CodePlace."<hr>";



$BalanceTotal = $BalanceTotal+$Balance;
$deposito = $deposito+$depositLine;
unset($subtoD);
unset($subto);
unset($Balance);
unset($depositLine);
unset($Item);
unset($SpecialNT);
unset($SpecialNote);
unset($PickupText);
}

$sqlReferral = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$refererID."'");
$Referal = $db->fetch_array($sqlReferral);
$Adicional2 = $Referal['name'];

if($_SESSION['affiliateName']){
	$Refiere = $_SESSION['affiliateName'];
}else{
	$Refiere = $Adicional2;
}

$MontoPagar = 	$Total-$BalanceTotal;
$BalanceDue = 	$Total-$MontoPagar;

$updateTotal = $db->consulta("UPDATE `reservations` SET `amount`='".$Total."',`deposit`='".$deposito."',`balance`='".$BalanceDue."',`pagado`='".$MontoPagar."',`tracking`='".$Refiere."',`code`='".$code_promotion."',`affid`='".$_SESSION['affiliateID']."' WHERE `id`='".$reserveNumber."'");
	

	
$thanks = "Thanks for your reservation.";
$soon = "You will soon receive a payment confirmation by email.";	

$information = '<style type="text/css">
.reciboN {
	color: #900;
}
.datos {
	font-weight: bold;
}
</style>
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h2>&nbsp;</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h2>Costa Rica Raw Adventures S.R.L</h2>
            <p class="datos">Cedula Juridica: 3-102-595795<br>Cel. +506 8594-0803<br>
              Turrialba, Cartago, Costa Rica<br>
          <a href="mailto:booked@costaricaraw.com">booked@costaricaraw.com</a><br>
      <a href="http://www.costaricaraw.com/dev/" target="_blank">www.costaricaraw.com/dev/ </a></p></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#666 1px solid;border-right:#666 1px solid;">
              <tr>
                <td colspan="3"><strong>Order Number: <span class="reciboN">#'.$reserveNumber.'</span></strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="5">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="datos">Date: '.NombrarFecha($date).'</td>
              </tr>
              <tr>
                <td colspan="3" class="datos"><strong><font color="#FF9900">Pending</font></strong></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </td>
  </tr>
   <tr>
	   <td colspan="3"><hr size="1" width="100%"></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Name:</strong> '.$name.' '.$lastname.'</td>
  </tr>
   <tr>
    <td colspan="3"><strong>Email:</strong> '.$email.'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Amount:</strong> $'.$Total.'</td>
  </tr>
   <tr>
    <td colspan="3"><strong>Balance Due:</strong> <span style="color:#CC0000">$'.$BalanceDue.'</span></td>
  </tr>
  <tr>
    <td width="260"><strong>Adventures Information:</strong></td>
    <td width="6">&nbsp;</td>
    <td width="384">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">'.$lineas.'</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="3"><h2>Enjoying the Paths-Preserving the future</h2></td>
     </tr>
	 <tr>
	   <td colspan="3"><hr size="1" width="100%"></td>
  </tr>
	 <tr>
	   <td colspan="3">&nbsp;</td>
  </tr>
	 <tr>
    <td colspan="3">"This person must be present with ID/Passport at time of check-in/departure!" <br><br>
Thanks for your reservation 
</td>
  </tr>
</table><br>';

$Adicional = $_SESSION['affiliateName'];




$mailInformation = $information.$Adicional2.$Adicional;

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
$headers .= "From: costaricaraw.com/dev/<booked@costaricaraw.com>\n";

mail("booked@costaricaraw.com","Pending Order #".$reserveNumber,$mailInformation,$headers);
//@mail("pending@costaricaraw.com/dev/","Pending Order #".$reserveNumber,$mailInformation,$headers);
//@mail("arodriguez@jarscr.com","Pending Order #".$reserveNumber,$mailInformation,$headers);

//echo $information;
//$_SESSION['carro'] = NULL;
//unset($_SESSION['carro']);
?>
<br /><br /><br /><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="70" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="70" align="center"><h2>Proceed with payment using PayPal's secure checkout.</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="140" align="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="form1">  
<input type="hidden" name="cmd" value="_xclick">  
<input type="hidden" name="business" value="kama@costaricaraw.com/dev/">
<input type="hidden" name="item_name" value="Reservation #<?=$reserveNumber?>">  
<input type="hidden" name="amount" value="<?=$MontoPagar?>">  
<input type="hidden" name="quantity" value="1">  
<input type="hidden" name="currency_code" value="USD">  
<input type="hidden" name="address_override" value="1">  
<input type="hidden" name="first_name" value="<?php echo $name; ?>">  
<input type="hidden" name="last_name" value="<?php echo $lastname;?>">  
<input type="hidden" name="return" value="https://www.costaricaraw.com/dev/index.php?cmd=paythanks&aid=<?=$reserveNumber?>">
<input type="hidden" name="cancel_return" value="https://www.costaricaraw.com/dev/index.php?cmd=cancel&aid=<?=$reserveNumber?>">
<input name="Procesar" type="image" src="images/PayNow-1.jpg" value="Pay with Paypal" width="400px" heigth="150px" >  

</form> </td>
  </tr>
 
  <tr>
    <td height="80" align="center">NOTE: Remember to click "Back to Costa Rica Raw" to complete your order.</td>
  </tr>
</table>
<?php } if($action==""){ ?>
<script language="javascript" type="text/javascript">
<!--
 function step(reserveForm) {
	
  if (reserveForm.name.value == "")
  { alert("Complete your Name"); reserveForm.name.focus(); return; }
  
  if (reserveForm.lastname.value == "")
  { alert("Complete your Last Name"); reserveForm.lastname.focus(); return; }
  
  if (reserveForm.email.value == "")
  { alert("Complete your Email Address"); reserveForm.email.focus(); return; }
  
    if (reserveForm.email.value.indexOf('@', 0) == -1 ||
      reserveForm.email.value.indexOf('.', 0) == -1)
  { alert("Email Address Is Invalid"); reserveForm.email.focus(); 
  return; 
  }
  
  if(document.reserveForm.agree.checked==true) {


			document.reserveForm.submit(); 

	}else{
 
  			alert("Please Check Disclosure & Cancellation Policy"); reserveForm.email.focus(); 
  return; 
			
	}
 
   }
-->
</script>  
<style>
.Requerido {
	color:#990000;
	font-size:9px;
}
</style>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" /> 
  <script src="src/facebox.js" type="text/javascript"></script> 
  <script type="text/javascript"> 
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
		
      })
	 /* $(document).bind('loading.facebox', function() {
    $(document).unbind('keydown.facebox');
    $('#facebox_overlay').unbind('click');
});*/
    })
  </script> 

<form action="index.php" method="post" enctype="multipart/form-data" name="reserveForm" id="reserveForm" target="_parent">
<input type="hidden" name="cmd" value="buy">
<input type="hidden" name="action" value="confirm" />
<table width="100%" border="0" cellpadding="2" cellspacing="2" height="100%">
  <tr>
    <td colspan="3" align="center" class="texto"><h3>Complete Your Information</h3></td>
    </tr>
  <tr>
    <td colspan="3" align="center" class="texto"><strong><span style="font-size:14px; color:#009;">&ldquo;This person must be present with ID/Passport at time of check-in/departure!&rdquo;</span></strong></td>
    </tr>
  <tr>
    <td align="right" class="texto">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="150" align="right" class="texto"><strong><?php echo $firstname; ?>:</strong></td>
    <td width="1">&nbsp;</td>
    <td><input name="name" type="text" class="input" autocomplete="off" size="25" maxlength="200"><span class="Requerido">*</span></td>
  </tr>
  <tr>
    <td align="right" class="texto"><strong><?php echo $lastname; ?>:</strong></td>
    <td width="1">&nbsp;</td>
    <td><input name="lastname" type="text" class="input" id="lastname" autocomplete="off" size="25" maxlength="200"><span class="Requerido">*</span></td>
  </tr>
   <tr>
    <td align="right" class="texto"><strong>Email:</strong></td>
    <td></td>
    <td><input name="email" type="text" class="input" id="email" autocomplete="off" size="25" maxlength="220"><span class="Requerido">*</span></td>
    </tr>
      <tr>
       <tr>
      <td align="right"><strong>Code:</strong></td>
      <td></td>
      <td><input name="code_promotion" type="text" value="" size="15" maxlength="6" /></td>
      </tr>
      
       <tr>
      <td align="right"><strong></strong></td>
      <td></td>
      <td> <input type="checkbox" name="agree" id="agree" /><span style="color:#990000;">Agree: </span>  <a href="terminos.php" rel="facebox"><?php  echo $DisclosurePolicy;  ?></a> <span class="Requerido">*</span></td>
      </tr>
      
        <td colspan="3"><div class="lineas" ></div></td>
        </tr>
  

  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td><span class="Requerido">* Required Fields</span></td>
    </tr>
  <tr>
    <td colspan="3" align="center"><button onclick="step(reserveForm);" class="button" type="button">Confirm</button></td>
  </tr>
  </table>

</form>
<?php } ?>
