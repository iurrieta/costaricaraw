<?php

$sql = $db->consulta("SELECT * FROM `reservations` WHERE `id`='".$_REQUEST['aid']."'");
$Invoice = $db->fetch_array($sql);

$_SESSION['carro'] = NULL;
$_SESSION['carro'] = "";
unset($_SESSION['carro']);
/*
foreach($carro as $k => $v){
$sqlInventory = $db->consulta("INSERT INTO `adventures_inventory` (`date`,`reserved`,`adventures_id`,`reservations_id`) VALUES ('".$v['fecha']."','".$v['cantidad']."','".$v['id']."','".$Invoice['id']."')");
}
*/
$sqlReferral = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$Invoice['affid']."'");
$Referal = $db->fetch_array($sqlReferral);
$Adicional2 = $Referal['name'];

$bodyHTML = '<style type="text/css">
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
          <a href="mailto:adventures@costaricaraw.com/dev">adventures@costaricaraw.com/dev</a><br>
      <a href="http://www.costaricaraw.com/devrget="_blank">www.costariccostaricaraw.com/dev></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#666 1px solid;border-right:#666 1px solid;">
              <tr>
                <td colspan="3"><strong>Order Number: <span class="reciboN">#'.$Invoice['id'].'</span></strong></td>
              </tr><tr><td colspan="3">&nbsp;</td></tr><tr>
                <td colspan="3" class="datos">Date: '.NombrarFecha($Invoice['date']).'</td>
              </tr>
			  <tr>
                <td colspan="3" class="datos"><font color="#006600">Approved</font></td>
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
    <td colspan="3"><strong>Name:</strong> '.$Invoice['name'].' '.$Invoice['lastname'].'</td>
  </tr>
   <tr>
    <td colspan="3"><strong>Email:</strong> '.$Invoice['email'].'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Amount:</strong> $'.$Invoice['amount'].'</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Payment:</strong> PayPal</td>
  </tr>
  <tr>
    <td width="260"><strong>Adventure Information:</strong></td>
    <td width="6">&nbsp;</td>
    <td width="384">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">';
         
		  $sqlLineas = $db->consulta("SELECT * FROM `reservations_line` WHERE `reservations_id`='".$Invoice['id']."'");
		  while($Lineas= $db->fetch_array($sqlLineas)){
			  $sqlAdventure = $db->consulta("SELECT `name`,`locations_id`,`specialnote` FROM `adventures` WHERE `id`='".$Lineas['adventures_id']."'");
			  list($Aventure,$LocationID,$SpecialNT)=$db->fetch_array($sqlAdventure);
			  $sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$LocationID."'");
			  list($LocationName) = $db->fetch_array($sqlLocation);			  
			  list($Dia,$LaFecha)=explode(',',$Lineas['fecha']);

if($Lineas['code']){
	$CodeText = "<br><strong>Confirmation Code:</strong> ".$Lineas['code']."<br>";
	
}

if($Lineas['pickup']){
	$PickupText = "<br><strong>Place of pick-up:</strong> ".$Lineas['pickup']."<br>";
}
	
if($SpecialNT){
$SpecialNote = "<br><span style='color:#900;'><strong>Special Note:</strong></span> ".$SpecialNT."<br>";
}	
			  
		 $bodyHTML .= "<b>Adventure: </b>".$Aventure."<br><b>Location: ".$LocationName."</b><br><b>Date:</b> ".$Lineas['fecha']."<br><b>Departure:</b> ".$Lineas['departure']."<br><b>Return:</b> ".$Lineas['end']."<br><b>Qty:</b> ".$Lineas['people']."<br><b>Cost:</b> $".$Lineas['price']."<br><b>Total:</b> $".$Lineas['total']."<br><b>Deposit:</b> $".$Lineas['deposit']."br><b>Balance Due:</b> $".$Lineas['balance']."<br><strong>Note: Balance for each item is due upon arrival.</strong>".$PickupText.$SpecialNote.$CodeText."<hr>";
		 
unset($PickupText);
unset($SpecialNT);	
unset($SpecialNote);
unset($CodeText);		 
        
           }
		   
      $bodyHTML .= '</td>
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
    <td colspan="3">"This person must be present with ID/Passport at time of check-in/departure!" <br><strong>Note: Balance for each item is due upon arrival.</strong><br><br>
Thanks for your reservation <br />
<strong>'.$Adicional2.'</strong>

</td>
  </tr>
</table><br>';




$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
//para el envien formato HTML 
//direccion el remitente 
$headers .= "From: Costa Rica Raw Adventures<adventures@costaricaraw.com/dev>\r\n";
$headers .= "Reply-To: adventures@costaricaraw.com/dev\r\n";
//$headers .= "Return-Path: ventas@jarscr.com\r\n";
//$headers .= "BCC: adventures@costaricaraw.com/dev\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$mensaje_formato = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>'.$row_Datos['empresa'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#ffffff" text="#000000" link="#000066" vlink="#000033" alink="#0000cc">
'.$bodyHTML.'
<br />
Costa Rica Raw Adventure<br />
www.costaricarawcostaricaraw.com/devalba, Cartago. Costa Rica
</body>
</html>';

$mensaje_formato_two = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>'.$row_Datos['empresa'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#ffffff" text="#000000" link="#000066" vlink="#000033" alink="#0000cc">
'.$bodyHTML.'
<br />
Costa Rica Raw Adventure<br />
www.costaricaraw.com/devcostaricaraw.com/dev, Cartago. Costa Rica
<br><br>
Tracking: '.$Adicional2.'
</body>
</html>';





 		 $sqlLineas = $db->consulta("SELECT * FROM `reservations_line` WHERE `reservations_id`='".$Invoice['id']."'");
		  while($Lineas= $db->fetch_array($sqlLineas)){
			  $sqlAdventure = $db->consulta("SELECT `name`,`locations_id`,`emailnot`,`specialnote` FROM `adventures` WHERE `id`='".$Lineas['adventures_id']."'");
			  list($Aventure,$LocationID,$emailnot,$SpecialNT)=$db->fetch_array($sqlAdventure);
			  $sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$LocationID."'");
			  list($LocationName) = $db->fetch_array($sqlLocation);			  
			  list($Dia,$LaFecha)=explode(',',$Lineas['fecha']);

if($Lineas['code']){
	$CodeText = "<br><strong>Confirmation Code:</strong> ".$Lineas['code']."<br>";
	
}

if($Lineas['pickup']){
	$PickupText = "<br><strong>Place of pick-up:</strong> ".$Lineas['pickup']."<br>";
	
}
if($SpecialNT){
	$SpecialNote = "<br><span style='color:#900;'><strong>Special Note:</strong></span> ".$SpecialNT."<br>";
}				  
		$emailAventuras = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>'.$row_Datos['empresa'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#ffffff" text="#000000" link="#000066" vlink="#000033" alink="#0000cc"><style type="text/css">
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
          <a href="mailto:adventures@costaricaraw.com/dev">adventures@costaricaraw.com/dev</a><br>
      <a href="http://www.costaricaraw.com/dev/devcostaricaraw.com/devw.costaricaraw.com/dev/ </acostaricaraw.com/dev <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#666 1px solid;border-right:#666 1px solid;">
              <tr>
                <td colspan="3"><strong>Order Number: <span class="reciboN">#'.$Invoice['id'].'</span></strong></td>
              </tr><tr><td>&nbsp;</td><td width="5">&nbsp;</td><td>&nbsp;</td></tr><tr>
                <td colspan="3" class="datos">Date: '.NombrarFecha($Invoice['date']).'</td>
              </tr>
			   <tr>
                <td colspan="3" class="datos"><font color="#006600">Approved</font></td>
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
    <td colspan="3"><strong>Name:</strong> '.$Invoice['name'].' '.$Invoice['lastname'].'</td>
  </tr>
   <tr>
    <td colspan="3"><strong>Email:</strong> '.$Invoice['email'].'</td>
  </tr>
 
  <tr>
    <td width="260"><strong>Adventure Information:</strong></td>
    <td width="6">&nbsp;</td>
    <td width="384">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">';
	
	 $emailAventuras .= "<b>Adventure: </b>".$Aventure."<br><b>Location: ".$LocationName."</b><br><b>Date:</b> ".$Lineas['fecha']."<br><b>Departure:</b> ".$Lineas['departure']."<br><b>Return:</b> ".$Lineas['end']."<br><b>Qty:</b> ".$Lineas['people']."<br><b>Balance Due:</b> $".$Lineas['balance']."<br><strong>Note: Balance for each item is due upon arrival.</strong>".$PickupText.$SpecialNote.$CodeText."<hr>";
	
	 $emailAventuras .= '</td>
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
    <td colspan="3">"This person must be present with ID/Passport at time of check-in/departure!"<br><strong>Note: Balance for each item is due upon arrival.</strong> <br><br>
Thanks for your reservation <br />
<strong>'.$Adicional2.'</strong>
</td>
  </tr>
</table><br><br />
Costa Rica Raw Adventure<br />
www.costaricaraw.com/dev/<br />
Tcostaricaraw.com/devosta Rica
</body>
</html>';	  
			  
		
		 
		 @mail($emailnot,"New Reservation #".$Invoice['id'],$emailAventuras,$headers);
		// @mail("arodriguez@jarscr.com","New Reservation #".$reserveNumber,$emailAventuras,$headers);
unset($PickupText);
unset($SpecialNT);
unset($SpecialNote);
unset($CodeText);		 
		  }


mail($Invoice['email'],"New Reservation #".$Invoice['id'],$mensaje_formato,$headers);
@mail("booked@costaricaraw.com/dev/","New Reservation #".$Invoice['id'],$mensaje_formato_two,$headers);
//@mail("adventures@costaricaraw.com/dev","New Reservation #".$reserveNumber,$mailInformation,$headers);

$updateEstado = $db->consulta("UPDATE `reservations` SET `status`='2' WHERE `id`='".$Invoice['id']."'");


?>
<script>
document.location='index.php?cmd=thanks';
</script>