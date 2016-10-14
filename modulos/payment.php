<br>
<br>
<br>
<div style="color: #900; font-size:14px; font-weight:bold;" align="center"><?php echo $_REQUEST['msg']; ?></div>
<br>
<br>
<br>

<?php
$sql = $db->consulta("SELECT * FROM `reservations` WHERE `id`='".$_REQUEST['aid']."'");
$Invoice = $db->fetch_array($sql);
$agree = "Please confirm you agree terms and conditions!";

?>
<script>
<!--
 function step(reserveForm) {
	
 
  if(reserveForm.agree.checked)
 { 
  document.reserveForm.submit(); 
  }else{
 alert("Please confirm you agree terms and conditions!"); reserveForm.agree.focus(); return; 
  }
 
   }
-->
</script>   
<form action="#" method="post" enctype="multipart/form-data" name="reserveForm" id="reserveForm">
<input name="act" value="update" type="hidden">
<input name="order" value="<?php echo $Invoice['id']; ?>" type="hidden">
<input name="amount" value="<?php echo $Invoice['amount']; ?>" type="hidden">
<input name="email" value="<?php echo $Invoice['email']; ?>" type="hidden">
<input name="name" value="<?php echo $Invoice['name']; ?>" type="hidden">
<input name="lastname" value="<?php echo $Invoice['lastname']; ?>" type="hidden">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#723838">
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><table width="90%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="250" height="100" rowspan="3" align="center" valign="top"><h2>Costa Rica Raw<br>
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
        <td height="35" colspan="4" bgcolor="#FFFFFF"><strong>Personal Information</strong></td>
        </tr>
      <tr>
        <td width="100" bgcolor="#FFFFFF"><strong>Name:</strong></td>
        <td bgcolor="#FFFFFF"><strong><?php echo $Invoice['name']; ?></strong></td>
        <td width="100" bgcolor="#FFFFFF"><strong>Lastname:</strong></td>
        <td bgcolor="#FFFFFF"><strong><?php echo $Invoice['lastname']; ?></strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>Email:</strong></td>
        <td bgcolor="#FFFFFF"><strong><?php echo $Invoice['email']; ?></strong></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
     
      <tr>
        <td height="35" colspan="4" bgcolor="#FFFFFF"><strong>Adventure Information</strong></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#723838">
          <tr>
         
            <td bgcolor="#FFFFFF"><strong>Adventure</strong></td>
             <td bgcolor="#FFFFFF"><strong>Location</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>Day</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>Date</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>Departure</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>Ending</strong></td>
             <td align="center" bgcolor="#FFFFFF"><strong>Qty</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>Cost</strong></td>
              <td align="center" bgcolor="#FFFFFF"><strong>Total</strong></td>
            
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
           
            <td bgcolor="#FFFFFF" ><strong><em><?php echo $Aventure; ?> (<?php echo $LocationName; ?>)</em></strong></td>
            <td bgcolor="#FFFFFF" ><strong><em><?php echo $LocationName; ?></em></strong></td>
            <td bgcolor="#FFFFFF"><em><?php echo $Dia; ?></em></td>
            <td bgcolor="#FFFFFF"><em><?php echo $LaFecha; ?></em></td>
            <td bgcolor="#FFFFFF"><em><?php echo $Lineas['departure']; ?></em></td>
            <td bgcolor="#FFFFFF"><em><?php echo $Lineas['end']; ?></em></td>
             <td bgcolor="#FFFFFF" align="center"><strong><em><?php echo $Lineas['people']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center"><strong><em>$<?php echo $Lineas['price']; ?></em></strong></td>
            <td bgcolor="#FFFFFF" align="center"><strong><em>$<?php echo $Lineas['total']; ?></em></strong></td>
          </tr>
          <?php } ?>
      </table>
      
      <table width="100%" border="0" cellspacing="1" cellpadding="2">  
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      <tr>
        <td bgcolor="#FFFFFF"><strong>Total:</strong></td>
        <td bgcolor="#FFFFFF"><strong>$<?php echo number_format($Invoice['amount'],2,'.',','); ?></strong></td>
        <td bgcolor="#FFFFFF"><strong>Payment Method:</strong></td>
        <td bgcolor="#FFFFFF"><strong><?php if($Invoice['paymentMethod']=="citi"){ echo "<img src='images/tarjetas.gif' alt='Credit Card'>"; }else{ echo "Other Method"; } ?></strong></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
      <tr>
        <td height="50" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF">
          
          <input name="agree" type="checkbox" /><strong><a href="index.php?cmd=travel&pag=9">I Agree Terms and Conditions</a></strong>        </td>
        </tr>
      
    </table>
    
    </td>
  </tr>
</table><br>
<br><table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><input type="submit" name="Submit" id="button" value="Pay Now!" class="button" >&nbsp;</td>
    </tr>
</table></form>
<br>
<br>