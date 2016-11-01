<?php
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

if($sql['m10'] == '1'):




$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$db = new MySQL();

       
if ($act=="") {



?>

<table width="92%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#000 solid 1px;">
  <tr>
    <td colspan="3" align="center" style="border-bottom:#000000 solid 1px;"><h3>Sales Report</h3></td>
  </tr>
  <tr>
    <td style="border-bottom:#000000 1px solid;"><strong>Affiliate</strong></td>
    <td style="border-bottom:#000000 1px solid;"><strong>Month Report</strong></td>
    <td style="border-bottom:#000000 1px solid;">&nbsp;</td>
  </tr>
<form action="index.php?cmd=sales&act=" method="post" name="reporte">
  <tr>
    <td style="border-bottom:#000000 1px solid;"><strong>Report All Sales</strong></td>
    <td style="border-bottom:#000000 1px solid;"><select name="mes" id="mes">
      <option value="">Ninguno</option>
	 
      <?
	  $sqlMes = $db->consulta("SELECT distinct date_format(`date`,'%m/%Y') as `date` FROM `reservations` GROUP BY `date` ORDER BY `date`");
	 
	  ?>
      <? while($mes = $db->fetch_array($sqlMes)) { ?>
		<option value="<?=$mes['date'] ?>"><?=$mes['date'] ?></option>
	 <? }  ?>
      </select></td>
    <td style="border-bottom:#000000 1px solid;"><input name="act" type="submit" value="Sales Report"></td>
  </tr></form>

<?               
$sql = $db->consulta("SELECT * FROM `affiliates` WHERE `referral`='0' ORDER By `name`");
while($Pages=$db->fetch_array($sql)){
?><form action="index.php?cmd=sales&act=" method="post" name="reporte">
  <tr>
    <td style="border-bottom:#000000 1px solid;"><input type="hidden" name="affiliateID" value="<?=$Pages['id']?>"><strong><?=$Pages['name']?></strong></td>
    <td style="border-bottom:#000000 1px solid;"><select name="mes" id="mes">
      <option value="">Ninguno</option>
	 
      <?
	  $sqlMes = $db->consulta("SELECT distinct date_format(`date`,'%m/%Y') as `date` FROM `reservations` GROUP BY `date` ORDER BY `date`");
	 
	  ?>
      <? while($mes = $db->fetch_array($sqlMes)) { ?>
		<option value="<?=$mes['date'] ?>"><?=$mes['date'] ?></option>
	 <? }  ?>
      </select></td>
    <td style="border-bottom:#000000 1px solid;"><input name="act" type="submit" value="Sales Report"></td>
  </tr></form>
<?
}
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<?

}
if($act=="Sales Report") {

$mes = $_POST['mes'];
$affiliateID = $_POST['affiliateID'];

if($affiliateID){
	$extra = "AND `affid`='".$affiliateID."'";
}


$sqlReport = "SELECT * FROM `reservations` WHERE date_format(`date`,'%m/%Y')='".$mes."' $extra";
$runReport = $db->consulta($sqlReport );

$sql = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$affiliateID."'");
$Afiliado=$db->fetch_array($sql);
?>
<style type="text/css">
@media print {
    div,a {display:none}
    .ver {display:block}
    .nover {display:none}
}
</style>
<script>
function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
} 
</script>
<div id="reporte">
<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#000 solid 1px;">
  <tr>
    <td colspan="9" align="center"  style="border-bottom:#000000 1px solid;"><h3>Sales Report per Affiliate</h3></td>
  </tr>
  <tr>
    <td colspan="5" style="border-bottom:#000000 1px solid; font-size:14px;"><strong>Affiliate: <em><?=$Afiliado['name']?></em></strong></td>
    <td colspan="4" style="border-bottom:#000000 1px solid;font-size:14px;"><strong>Month: <?=$mes?></strong></td>
  </tr>
  <tr>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Reservation</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Code</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Client Name</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Adventure</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Date</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Time</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Qty</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Cost</strong></td>
    <td style="border-bottom:#000000 1px solid; "><strong>Total</strong></td>
  </tr>
<?php
while($Resporte=$db->fetch_array($runReport)){
	
$sqlLineas =$db->consulta("SELECT `reservations_line`.`reservations_id`,`reservations_line`.`adventures_id`,`reservations_line`.`fecha`,`reservations_line`.`departure`,`reservations_line`.`total`,`reservations_line`.`people`,`reservations`.`name`,`reservations`.`lastname`,`reservations`.`code`,`reservations_line`.`price` FROM `reservations_line` INNER JOIN `reservations` ON `reservations`.`id` = `reservations_line`.`reservations_id` WHERE `reservations_line`.`reservations_id`='".$Resporte['id']."' AND `reservations`.`status`='5'");
while(list($ReservationID,$AventuraID,$Date,$Time,$Total,$Cantidad,$Nombre,$Apellido,$Codigo,$Costo)=$db->fetch_array($sqlLineas)){

$sqlAventura =$db->consulta("SELECT `name` FROM `adventures` WHERE `id`='".$AventuraID."'");
list($Aventura)=$db->fetch_array($sqlAventura);
?>
  <tr>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid; font-size:10px;">#<?=$ReservationID?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;"><?=$Codigo?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid; font-size:10px;"><?=$Nombre?> <?=$Apellido?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;"><?=$Aventura?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;"><?=$Date?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;"><?=$Time?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;"><?=$Cantidad?></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">$<?=$Costo?></td>
    <td style="border-bottom:#000000 1px solid; font-size:10px;">$<?=$Total?></td>
  </tr>

<?php
}
}
?>
<tr>
    <td colspan="9" align="center">&nbsp;</td>
  </tr>
</table>
</div>
<br><br>
<div align="center"><input type="button" name="button" id="button" value="Print" class="boton" onClick="imprSelec('reporte');"> &nbsp;<input type="button" name="EmailSend" value="Email Copy" class="boton" onclick="document.location='index.php?cmd=sales&act=Email&mes=<?=$mes?>&Afiliado=<?=$affiliateID?>';"  /></div>

<?php
}
if($act=="Email"){
	


$mes = $_GET['mes'];
$affiliateID = $_GET['Afiliado'];
$EmailCopy = 0;
if($affiliateID){
	$extra = "AND `affid`='".$affiliateID."'";
	
	$sql = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$affiliateID."'");
	$Afiliado=$db->fetch_array($sql);
	$EmailCopy = $Afiliado['email'];
}


$sqlReport = "SELECT * FROM `reservations` WHERE date_format(`date`,'%m/%Y')='".$mes."' $extra";
$runReport = $db->consulta($sqlReport );



$BodyHTML = '<table width="97%" border="0" align="center" cellpadding="3" cellspacing="0" style="border:#000 solid 1px;">
  <tr>
    <td colspan="9" align="center"  style="border-bottom:#000000 1px solid;"><h3>Sales Report</h3></td>
  </tr>
  <tr>
    <td colspan="5" style="border-bottom:#000000 1px solid; font-size:14px;"><strong>Affiliate: <em>'.$Afiliado['name'].'</em></strong></td>
    <td colspan="4" style="border-bottom:#000000 1px solid;font-size:14px;"><strong>Month: '.$mes.'</strong></td>
  </tr>
  <tr>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Reservation</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Code</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Client Name</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Adventure</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Date</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Time</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Qty</strong></td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Cost</strong></td>
    <td style="border-bottom:#000000 1px solid; "><strong>Total</strong></td>
  </tr>';

while($Resporte=$db->fetch_array($runReport)){
	
$sqlLineas =$db->consulta("SELECT `reservations_line`.`reservations_id`,`reservations_line`.`adventures_id`,`reservations_line`.`fecha`,`reservations_line`.`departure`,`reservations_line`.`total`,`reservations_line`.`people`,`reservations`.`name`,`reservations`.`lastname`,`reservations`.`code`,`reservations_line`.`price` FROM `reservations_line` INNER JOIN `reservations` ON `reservations`.`id` = `reservations_line`.`reservations_id` WHERE `reservations_line`.`reservations_id`='".$Resporte['id']."' AND `reservations`.`status`='5'");
while(list($ReservationID,$AventuraID,$Date,$Time,$Total,$Cantidad,$Nombre,$Apellido,$Codigo,$Costo)=$db->fetch_array($sqlLineas)){

$sqlAventura =$db->consulta("SELECT `name` FROM `adventures` WHERE `id`='".$AventuraID."'");
list($Aventura)=$db->fetch_array($sqlAventura);

$Lineas .=' <tr>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid; font-size:10px;">#'.$ReservationID.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">'.$Codigo.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid; font-size:10px;">'.$Nombre.' '.$Apellid.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">'.$Aventura.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">'.$Date.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">'.$Time.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">'.$Cantidad.'</td>
    <td style="border-bottom:#000000 1px solid; border-right:#000 1px solid;font-size:10px;">$'.$Costo.'</td>
    <td style="border-bottom:#000000 1px solid; font-size:10px;">$'.$Total.'</td>
  </tr>';


}
}

$BodyHTMLF = '<tr><td colspan="9" align="center">&nbsp;</td></tr></table>';

$MensajeHTML = $BodyHTML.$Lineas.$BodyHTMLF;
$To = "booked@costaricaraw.com";
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 

$headers .= "From: Costa Rica Raw Adventures<booked@costaricaraw.com>\r\n";
$headers .= "Reply-To: booked@costaricaraw.com\r\n";
if($EmailCopy==0){
	
}else{
$headers .= "BCC: ".$EmailCopy."\r\n";
}
$headers .= "X-Mailer: PHP/" . phpversion();

 @mail($To,"Sales Report to ".$mes,$MensajeHTML,$headers);
	
echo "<script>alert('Sales Report Copy Success Send');document.location='index.php?cmd=sales';</script>";	
	
}
?>
<?php endif;
$db = new MySQL();
$query = $db->consulta("SELECT * FROM `administrator` WHERE `id`='".$_SESSION['CRR_AUserID']."'");
$sql = $db->fetch_array($query);

?>
