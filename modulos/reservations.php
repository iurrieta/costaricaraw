<?
$act = $_REQUEST['act'];
$Reservation = $_REQUEST['Reservation'];
$db = new MySQL();
if ($act=="") {



?><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#723838">

<table width="100%"   border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC">
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Order</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Date</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Amount</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Deposit</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Balance<br />
Due</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Total<br />
      Paid</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Name</strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong>Status</strong></td>
  </tr>
 
   
<?   
$_pagi_cuantos = 20;
          
$sql = "SELECT * FROM `reservations` ORDER By `id` DESC";
$_pagi_sql = $sql;
include("../includes/clases/clase.paginador.php");
$NumRows = $db->num_rows($_pagi_result);
 
  if($NumRows > 0){
 
while($Pages=$db->fetch_array($_pagi_result)){

if($Pages['status']==1){
$estado = "<b><font color=\"#FF9900\">Pending</font></b>";	
}
if($Pages['status']==2){
$estado = "<b><font color=\"#006600\">Approved</font></b>";	
}
if($Pages['status']==3){
$estado = "<b><font color=\"#003399\">Return</font></b>";	
}
if($Pages['status']==4){
$estado = "<b><font color=\"#990000\">Canceled</font></b>";	
}
if($Pages['status']==5){
$estado = "<b><font color=\"#006600\">Payment Complete</font></b>";	
}
?>
		   <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><strong><a href="index.php?cmd=reservations&act=Open&Reservation=<?=$Pages['id']?>" title="Open Reservation #<?=$Pages['id']?>">#<?=$Pages['id']?></a></strong></td>
    <td align="center" valign="top" bgcolor="#FFFFFF"><em><?=$Pages['date']?></em></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><b><font color="#009933">$<?=$Pages['amount']?></font></b></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><b><font color="#009933">$<?=$Pages['deposit']?></font></b></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><b><font color="#990000">$<?=$Pages['balance']?></font></b></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><b><font color="#990000">$<?=$Pages['pagado']?></font></b></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><em><?=$Pages['name']?> <?=$Pages['lastname']?></em></td>
  <td align="center" valign="top" bgcolor="#FFFFFF"><?=$estado?></td>
  </tr>
 
             
         
<? }  ?>    


<?
 }else{
   ?>
    <tr>
    <td height="150" colspan="8" align="center" bgcolor="#FFFFFF"><strong>No Reservations</strong></td>
  </tr>
  <?
  }
  

?>
 
 <tr>
    <td colspan="9" align="center" bgcolor="#FFFFFF"><?php echo"<p>".$_pagi_navegacion."</p>"; ?></td>
  </tr>

</table>
</td>
  </tr>
</table>
<?php
}
if($act=="Open"){
	$sql = $db->consulta("SELECT * FROM `reservations` WHERE `id`='".$Reservation."'");
	$Invoice = $db->fetch_array($sql);
	
if($Invoice['status']==1){
$estado = "<b><font color=\"#FF9900\">Pending</font></b>";	
}
if($Invoice['status']==2){
$estado = "<b><font color=\"#006600\">Approved</font></b>";	
}
if($Invoice['status']==3){
$estado = "<b><font color=\"#003399\">Return</font></b>";	
}
if($Invoice['status']==4){
$estado = "<b><font color=\"#990000\">Canceled</font></b>";	
}
if($Invoice['status']==5){
$estado = "<b><font color=\"#006600\">Payment Complete</font></b>";	
}
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

<form action="index.php?cmd=reservations" method="post" enctype="multipart/form-data">
<input name="act" value="update" type="hidden">
<input name="Reservation" value="<?php echo $Reservation; ?>" type="hidden">
<div id="reporte">
<table width="95%" align="center" border="0" cellspacing="0" cellpadding="2" style="border-left:#000 solid 1px; border-top:#000 solid 1px; border-right:#000 solid 1px;">
      <tr>
        <td colspan="4" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;"><table width="90%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="250" height="100" rowspan="3" align="center" valign="top" ><h2>Costa Rica Raw<br>
              Adventures</h2></td>
            <td align="right"><strong>Order #<?php echo $Invoice['id']; ?></strong></td>
          </tr>
          <tr>
            <td align="right"><strong><em><?php echo $Invoice['date']; ?></em></strong><br><em><?php echo $Invoice['time']; ?></em></td>
          </tr>
          <tr>
            <td align="right" valign="top"><strong><?php echo $estado; ?></strong></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="35" colspan="4" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;"><strong>Personal Information</strong></td>
        </tr>
      <tr>
        <td width="100" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;border-right:#000 1px solid;"><strong>Name:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><?php echo $Invoice['name']; ?></strong></td>
        <td width="100" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;border-right:#000 1px solid;"><strong>Lastname:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;"><strong><?php echo $Invoice['lastname']; ?></strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Email:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><?php echo $Invoice['email']; ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;">&nbsp;</td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; ">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Payment Notes:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><?php echo $Invoice['notes']; ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Boucher:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;"><strong><?php echo $Invoice['boucher']; ?></strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Credit Card:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><?php echo $Invoice['card']; ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;">&nbsp;</td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; ">&nbsp;</td>
      </tr>
     
      <tr>
        <td height="35" colspan="4" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; "><strong>Adventure Information</strong></td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Tracking:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><?php echo $Invoice['tracking']; ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Code:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; "><strong><?php echo $Invoice['code']; ?></strong></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      </table>
      
      <table width="95%" border="0" cellspacing="0" cellpadding="2" align="center" style="border-left:#000 solid 1px; border-top:#000 solid 1px; border-right:#000 solid 1px;">
          <tr>
         
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Adventure</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Location</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Day</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Date</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Item</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Departure</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Ending</strong></td>
             <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Qty</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Cost</strong></td>
              <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Total</strong></td>
              <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Deposit</strong></td>
              <td align="center" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; "><strong>Balance Due</strong></td>
            
        </tr>
          <?php
		  $sqlLineas = $db->consulta("SELECT * FROM `reservations_line` WHERE `reservations_id`='".$Invoice['id']."'");
		  while($Lineas= $db->fetch_array($sqlLineas)){
			  $sqlAdventure = $db->consulta("SELECT `name`,`locations_id` FROM `adventures` WHERE `id`='".$Lineas['adventures_id']."'");
			  list($Aventure,$LocationID)=$db->fetch_array($sqlAdventure);
			  $sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$LocationID."'");
			  list($LocationName) = $db->fetch_array($sqlLocation);
			  list($Dia,$LaFecha)=explode(',',$Lineas['fecha']);
		  ?>
          <tr>
           
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><em><?php echo $Aventure; ?> (<?php echo $LocationName; ?>)</em></strong></td>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><em><?php echo $LocationName; ?></em></strong></td>
            <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><em><?php echo $Dia; ?></em></td>
            <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><em><?php echo $LaFecha; ?></em></td>
            <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><em><?php echo $Lineas['item'];?></em></td>
            <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><em><?php echo $Lineas['departure']; ?></em></td>
            <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><em><?php echo $Lineas['end']; ?></em></td>
             <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><em><?php echo $Lineas['people']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong><em>$<?php echo $Lineas['price']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid;border-right:#000 1px solid;"><strong><em>$<?php echo $Lineas['total']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid;border-right:#000 1px solid;"><strong><em>$<?php echo $Lineas['deposit']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid;"><strong><em>$<?php echo $Lineas['balance']; ?></em></strong></td>
          </tr>
         <?php
		 if($Lineas['pickup']){ ?>
          <tr>
            <td bgcolor="#FFFFFF" align="center" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Place of pick-up:</strong></td>
            <td colspan="11" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; "><strong><?=$Lineas['pickup']?></strong></td>
          </tr>
          
        <? } ?>  
          
          <?php } ?>
      </table>
      
      <table width="95%" border="0" cellspacing="0" align="center" cellpadding="2" style="border-left:#000 solid 1px; border-bottom:#000 solid 1px; border-right:#000 solid 1px;">  
      <tr>
        <td colspan="4" bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid;">&nbsp;</td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Total:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>$<?php echo number_format($Invoice['amount'],2,'.',','); ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Payment Method:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; "><strong><?php if($Invoice['paymentMethod']=="paypal"){ echo "Paypal"; }else{ echo "Other Method"; } ?></strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Deposit:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>$<?php echo number_format($Invoice['deposit'],2,'.',','); ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;">&nbsp;</td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; ">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Balance Due:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>$<?php echo number_format($Invoice['balance'],2,'.',','); ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;">&nbsp;</td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; ">&nbsp;</td>
      </tr>
     <tr>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>Total Paid:</strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;"><strong>$<?php echo number_format($Invoice['pagado'],2,'.',','); ?></strong></td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; border-right:#000 1px solid;">&nbsp;</td>
        <td bgcolor="#FFFFFF" style="border-bottom:#000000 1px solid; ">&nbsp;</td>
      </tr>
      <tr >
        <td bgcolor="#FFFFFF" ><strong>Change Status:</strong></td>
        <td colspan="3" bgcolor="#FFFFFF"><em>
          <label>
            <input type="radio" name="status" value="1" id="status_0" <?php if($Invoice['status']==1){ echo "checked"; } ?> <?php if(($Invoice['status']==5)||($Invoice['status']==3)||($Invoice['status']==4)){ echo "disabled"; } ?>>
            Pending</label>
         &nbsp;&nbsp;
          <label>
            <input type="radio" name="status" value="2" id="status_1" <?php if($Invoice['status']==2){ echo "checked"; } ?> <?php if(($Invoice['status']==5)||($Invoice['status']==3)||($Invoice['status']==4)){ echo "disabled"; } ?>>
            Approved</label>
         &nbsp;&nbsp;
          <label>
            <input type="radio" name="status" value="5" id="status_5" <?php if($Invoice['status']==5){ echo "checked"; } ?> <?php if(($Invoice['status']==5)||($Invoice['status']==3)||($Invoice['status']==4)){ echo "disabled"; } ?>>
            Payment Complete</label>
             &nbsp;&nbsp;
          <label>
            <input type="radio" name="status" value="3" id="status_2" <?php if($Invoice['status']==3){ echo "checked"; } ?> <?php if(($Invoice['status']==3)||($Invoice['status']==4)){ echo "disabled"; } ?>>
            Return</label>
          &nbsp;&nbsp;
          <label>
            <input type="radio" name="status" value="4" id="status_3" <?php if($Invoice['status']==4){ echo "checked"; } ?> <?php if(($Invoice['status']==3)||($Invoice['status']==4)){ echo "disabled"; } ?>>
            Canceled</label></em>
         </td>
      </tr>
      </table></div>
  <br>
<br><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="Update" class="boton"></td>
    <td align="center"><input type="button" name="button3" id="button3" value="Print" class="boton" onClick="imprSelec('reporte');"></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="<< Back" class="boton" onClick="self.location='index.php?cmd=reservations'"></td>
  </tr>
</table></form>

<br>
<br>


<?php } 
if ($act=="update"){

$Reservation = $_POST['Reservation'];
$status = $_POST['status'];


        $update = $db->consulta("UPDATE `reservations` SET `status`='".$status."' WHERE `id`='".$Reservation."'");
if($status==3){		
	$sqlInventory = $db->consulta("DELETE FROM `adventures_inventory` WHERE `reservations_id`='".$Reservation."'");
}
if($status==4){
	$sqlInventory = $db->consulta("DELETE FROM `adventures_inventory` WHERE `reservations_id`='".$Reservation."'");
}
		
?>
<!--<script language="javascript">
                < ! --
       document.location='index.php?cmd=reservations';
                //-- >
                </script>
               
               
               -->
<center>
        <br><br>
<span class="textos"><h4>Order <em>No.<? echo $Reservation; ?></em></h4> <br /><h5>Send Customer Notification for Proceed to Payment</h5></span><br />
<br>

<br>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><input name="SI" type="button" id="SI" value="Yes" onClick="self.location='index.php?cmd=reservations&act=notify&id=<? echo $Reservation; ?>'" class="boton"/>
</td>
    <td align="center"><input name="NO" type="button" id="NO" value="No" onClick="self.location='index.php?cmd=reservations'" class="boton"/></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</center>
<?php
}
////////// NOTIFICAR Cliente ////////
if($act=="notify"){

$sql = $db->consulta("SELECT * FROM `reservations` WHERE `id`='".$_REQUEST['id']."'");
$Invoice = $db->fetch_array($sql);

$carro=$_SESSION['carro']; 

$sqlLineas = $db->consulta("SELECT * FROM `reservations_line` WHERE `reservations_id`='".$Invoice['id']."'");

while($Lineas= $db->fetch_array($sqlLineas)){
	
$sqlAdventure = $db->consulta("SELECT `name`,`locations_id` FROM `adventures` WHERE `id`='".$Lineas['adventures_id']."'");
list($Aventure,$LocationID)=$db->fetch_array($sqlAdventure);
$sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$LocationID."'");
list($LocationName) = $db->fetch_array($sqlLocation);
list($Dia,$LaFecha)=explode(',',$Lineas['fecha']);
	
			  
//$sqlInventory = $db->consulta("INSERT INTO `adventures_inventory` (`date`,`reserved`,`adventures_id`,`reservations_id`) VALUES ('".$Lineas['date']."','".$Lineas['people']."','".$Lineas['adventures_id']."','".$Invoice['id']."')");

}


if($Invoice['status']==1){
$estado = '<b><font color="#FF9900">Pending</font></b>';	
}
if($Invoice['status']==2){
$estado = '<b><font color="#006600">Approved</font></b>';	
}
if($Invoice['status']==3){
$estado = '<b><font color="#003399">Return</font></b>';	
}
if($Invoice['status']==4){
$estado = '<b><font color="#990000">Canceled</font></b>';	
}
if($Invoice['status']==5){
$estado = '<b><font color="#006600">Payment Complete</font></b>';	
}

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
      <a href="http://www.costaricaraw.com/dev" target="_blank">www.costaricaraw.com/dev </a></p></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#666 1px solid;border-right:#666 1px solid;">
              <tr>
                <td colspan="3"><strong>Order Number: <span class="reciboN">#'.$Invoice['id'].'</span></strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="5">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="datos">Date: '.NombrarFecha($Invoice['date']).'</td>
              </tr>
			    <tr>
                <td colspan="3" class="datos">'.$estado.'</td>
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
    <td colspan="3"><strong>Balance Due:</strong> <span style="color:#CC0000">$'.$Invoice['balance'].'</span></td>
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
			 
if($Lineas['deposit']==0){
	$BalanceDue="";
}else{
	$BalanceDue = "<br><b>Deposit:</b> $".$Lineas['deposit']."<br><b>Balance Due:</b> <span style=\"color:#CC0000\">$".$Lineas['balance']."</span>";
}	

if($Lineas['pickup']){
	$PickupText = "<br><strong>Place of pick-up:</strong> ".$Lineas['pickup']."<br>";
	
}	
if($SpecialNT){
	$SpecialNote = "<br><span style='color:#900;'><strong>Special Note:</strong></span> ".$SpecialNT."<br>";
}		 
if($Lineas['item']){
$Item = "<br><b>Item:</b> ".$Lineas['item'];
}			 
			  
		 $bodyHTML .= "<b>Adventure: </b>".$Aventure."<br><b>Location: ".$LocationName."</b><br><b>Date:</b> ".$Lineas['fecha']."".$Item."<br><b>Departure:</b> ".$Lineas['departure']."<br><b>Return:</b> ".$Lineas['end']."<br><b>Qty:</b> ".$Lineas['people']."<br><b>Cost:</b> $".$Lineas['price']."<br><b>Total:</b> $".$Lineas['total']."".$BalanceDue."<br><strong>Note: Balance for each item is due upon arrival.</strong>".$PickupText.$SpecialNote."<hr>";
		 
unset($SpecialNT);
unset($PickupText);		 
unset($SpecialNote);	
unset($Item);	        
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
    <td colspan="3">"This person must be present with ID/Passport at time of check-in/departure!" <br><br>
	<strong>Note: Balance for each item is due upon arrival.</strong><br><br>
Thanks for your reservation 
</td>
  </tr>
</table><br>';

$sqlReferral = $db->consulta("SELECT * FROM `affiliates` WHERE `id`='".$Invoice['tracking']."'");
$Referal = $db->fetch_array($sqlReferral);
$Adicional2 = $Referal['name'];


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
www.costaricaraw.com/dev<br />
Turrialba, Cartago. Costa Rica
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
www.costaricaraw.com/dev<br />
Turrialba, Cartago. Costa Rica
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
      <a href="http://www.costaricaraw.com/dev" target="_blank">www.costaricaraw.com/dev </a></p></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#666 1px solid;border-right:#666 1px solid;">
              <tr>
                <td colspan="3"><strong>Order Number: <span class="reciboN">#'.$Invoice['id'].'</span></strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="5">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="datos">Date: '.NombrarFecha($Invoice['date']).'</td>
              </tr>
			   <tr>
                <td colspan="3" class="datos">'.$estado.'</td>
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


	$BalanceDue = "<b>Balance Due:</b> <span style=\"color:#CC0000\">$".$Lineas['balance']."</span>";


if($Lineas['pickup']){
	$PickupText = "<br><strong>Place of pick-up:</strong> ".$Lineas['pickup']."<br>";
	
}	
if($SpecialNT){
	$SpecialNote = "<br><span style='color:#900;'><strong>Special Note:</strong></span> ".$SpecialNT."<br>";
}	
if($Lineas['item']){
$Item = "<br><b>Item:</b> ".$Lineas['item'];
}
	 $emailAventuras .= "<b>Adventure: </b>".$Aventure."<br><b>Location: ".$LocationName."</b><br><b>Date:</b> ".$Lineas['fecha']."".$Item."<br><b>Departure:</b> ".$Lineas['departure']."<br><b>Return:</b> ".$Lineas['end']."<br><b>Qty:</b> ".$Lineas['people']."<br>".$BalanceDue.".<br><strong>Note: Balance for each item is due upon arrival.</strong>".$PickupText.$SpecialNote."<hr>";
	
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
    <td colspan="3">"This person must be present with ID/Passport at time of check-in/departure!" <br><br>
Thanks for your reservation 
</td>
  </tr>
</table><br><br />
Costa Rica Raw Adventure<br />
www.costaricaraw.com/dev<br />
Turrialba, Cartago. Costa Rica
</body>
</html>';	  
			  
		
		 
		 @mail($emailnot,"New Reservation #".$Invoice['id'],$emailAventuras,$headers);
		// @mail("arodriguez@jarscr.com","New Reservation #".$reserveNumber,$emailAventuras,$headers);
unset($SpecialNote);
unset($PickupText);
unset($SpecialNT);	
unset($Item);		 
		  }


mail($Invoice['email'],"New Reservation #".$Invoice['id'],$mensaje_formato,$headers);
@mail("booked@costaricaraw.com/dev","New Reservation #".$Invoice['id'],$mensaje_formato_two,$headers);
//@mail("arodriguez@jarscr.com","New Reservation #".$Invoice['id'],$mensaje_formato_two,$headers);

        ?>
<script language="javascript">
                <!--
				        alert('Customer Notification Complete'),
       document.location='index.php?cmd=reservations';
                //-->
                </script>
        <?
}

?>
