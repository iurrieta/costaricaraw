<?php
require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";
$db = new MySQL(); 

$accion = $_REQUEST['accion'];
$dep = $_REQUEST['departureM'];
$ret = $_REQUEST['endingM'];
$estado = $_REQUEST['status'];
$required = $_REQUEST['required'];
$spaces = $_REQUEST['newspace'];
$adventure = $_REQUEST['adventure'];
$price = $_REQUEST['price'];
$item = $_REQUEST['item'];

$departure = $_POST['departureH'].":".$_POST['departureM']." ".$_POST['departureTime'];
$ending = $_POST['endingH'].":".$_POST['endingM']." ".$_POST['endingTime'];

if($accion=="eliminar"){
	
	$sqlDel = $db->consulta("DELETE FROM `adventures_times` WHERE `id`='".$_GET['idLinea']."'");
}
if($accion=="actualizar"){
	
	$subtotal = $_POST['cantidad']*$_POST['precio']; 
	$sqlUpdate = $db->consulta("UPDATE `adventures_times` SET `spaces`='".$spaces."',`departure`='".$departure."',`arrival`='".$ending."',`required`='".$required."',`status`='".$estado."',`price`='".$price."',`item`='".$item."' WHERE `id`='".$_POST['idLinea']."'");
}
if($accion=="agregar"){
	list($producto,$precio) = explode("-",$_POST['producto']);	
	$subtotal = $_POST['cantidad']*$precio; 
	$sqlAdd = "INSERT INTO `adventures_times` (`adventure`,`spaces`,`departure`,`arrival`,`required`,`status`,`price`,`item`) VALUES ('".$adventure."','".$spaces."','".$departure."','".$ending."','".$required."','".$estado."','".$price."','".$item."')";
	$ejecutar = $db->consulta($sqlAdd);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Special Dates for Adventures</title>
<link rel="stylesheet" type="text/css" media="screen" href="../../css/datePicker.css">
<style>
/* CALENDARIO */
body{
	font-size:12px;
}
#cal {
	color:#333;
	background-color:#ccc;
	border: 1px solid;
	border-color: #1a4551;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
}
#cal td {
	text-align:center;
	width: 60px;
	height:60px;
	background-color: #FFF;
}
tr#days-of-week td { background-color: #aaa;}
#cal thead td {
	background-color: #CAE8F0;
	font-size: 12px;
	font-weight: bold;
}
#cal thead a{ color: #000;}
.cal-available{
	color: #090;
	text-decoration:none;
}
a.cal-available:visited{
	color: #090;
	text-decoration:none;
}
.cal-unavailable {
	color: #900;
/*	text-decoration:none;*/
	text-decoration:line-through
}
a.cal-unavailable:visited {
	color: #900;
/*	text-decoration:none;*/
	text-decoration:line-through
}
#cal .cal-prev-month-day, #cal .cal-next-month-day {
	color: #990;
}
#cal-current-day {
	background-color: #CCC !important;
}
/* CALENDARIO */
a.dp-choose-date {
	float: left;
	width: 16px;
	height: 16px;
	padding: 0;
	margin: 5px 3px 0;
	display: block;
	text-indent: -2000px;
	overflow: hidden;
	background: url(../images/calendar.png) no-repeat; 
}
a.dp-choose-date.dp-disabled {
	background-position: 0 -20px;
	cursor: default;
}
/* makes the input field shorter once the date picker code
 * has run (to allow space for the calendar icon
 */
input.dp-applied {
	width: 140px;
	float: left;
}
</style>
<!-- required plugins -->
</head>

<body>
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#F2E4C2" class="titulo"><strong>Adventure Departure/Check-in times:</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td><strong>Departure</strong></td>
       <td><strong>Ending</strong></td>
        <td><strong>Price</strong></td>
        <td><strong>Item</strong></td>
        <td><strong>Maximum Persons</strong></td>
       
        <td><strong>Required</strong></td>
        <td><strong>Status</strong></td>
        <td colspan="2" align="center"><strong>Options</strong><strong></strong></td>
        </tr>
         <form action="special.time.php" method="post">
          <input type="hidden" name="accion" value="agregar" />
          <input type="hidden" name="adventure" value="<?=$adventure?>" />
    
          <tr>
     <td> <select name="departureH" id="departureH" class="cajas">
      
<?php
for ($i = 1; $i <= 12; $i++) {
    echo '<option value="'.$i.'"';
	if($i==$Hora){ echo "selected"; }
	echo '>'.$i.'</option>';
}
   ?>
      </select>
      <select name="departureM" id="departureM" class="cajas">
        <option value="00" <? if($Minuto=="00"){ echo "selected"; } ?>>00</option>
        <option value="15" <? if($Minuto=="15"){ echo "selected"; } ?>>15</option>
        <option value="30" <? if($Minuto=="30"){ echo "selected"; } ?>>30</option>
        <option value="45" <? if($Minuto=="45"){ echo "selected"; } ?>>45</option>
      </select>
      <select name="departureTime" id="departureTime" class="cajas">
        <option value="AM" <? if($Tiempo=="AM"){ echo "selected"; } ?>>AM</option>
        <option value="PM" <? if($Tiempo=="PM"){ echo "selected"; } ?>>PM</option>
      </select></td>
     <td> <select name="endingH" id="endingH" class="cajas">
      
<?php
for ($i = 1; $i <= 12; $i++) {
    echo '<option value="'.$i.'"';
	if($i==$HoraE){ echo "selected"; }
	echo '>'.$i.'</option>';
}
   ?>
      </select>
      <select name="endingM" id="endingM" class="cajas">
        <option value="00" <? if($MinutoE=="00"){ echo "selected"; } ?>>00</option>
        <option value="15" <? if($MinutoE=="15"){ echo "selected"; } ?>>15</option>
        <option value="30" <? if($MinutoE=="30"){ echo "selected"; } ?>>30</option>
        <option value="45" <? if($MinutoE=="45"){ echo "selected"; } ?>>45</option>
      </select>
      <select name="endingTime" id="endingTime" class="cajas">
        <option value="AM" <? if($TiempoE=="AM"){ echo "selected"; } ?>>AM</option>
        <option value="PM" <? if($TiempoE=="PM"){ echo "selected"; } ?>>PM</option>
      </select> </td>
    
      <td><label for="price"></label>
        <input name="price" type="text" id="price" size="10" /></td>
      <td><label for="item"></label>
        <input name="item" type="text" id="item" size="15" /></td>
      <td><input name="newspace" type="text" class="cantidad" value="" size="10" id="newspace" /></td>
      <td><input name="required" type="text" class="cantidad" value="" size="7" id="required" /></td>
      <td>
        <label>
          <input name="status" type="radio" id="status_0" value="1" checked="checked" />
          Enable</label>
        <br />
        <label>
          <input type="radio" name="status" value="2" id="status_1" />
          Disable</label>
      </td>
        <td width="16"><input type="image" src="../../images/plus.gif" width="13" height="13" value="add" /></td>
        <td width="16">&nbsp;</td>
      </tr>
      </form>
<tr><td colspan="9"><hr size="1" width="100%" noshade="noshade" /></td></tr>
  <?
  $sqlRec= $db->consulta("SELECT * FROM `adventures_times` WHERE `adventure`='".$_REQUEST['adventure']."' ORDER By `departure` DESC");
  while($TimeAdventure=$db->fetch_array($sqlRec)){
	
	 ?>
     <form action="special.time.php" method="post">
     <input type="hidden" name="idLinea" value="<?=$TimeAdventure['id']?>" />
     <input type="hidden" name="accion" value="actualizar" />
      <input type="hidden" name="adventure" value="<?=$TimeAdventure['adventure']?>" />
      <tr>
     <td>   <select name="departureH" id="departureH" class="cajas">
      
<?php
list($Hora,$MinutoTime)=explode(':',$TimeAdventure['departure']);
list($Minuto,$Tiempo)=explode(' ',$MinutoTime);

for ($i = 1; $i <= 12; $i++) {
    echo '<option value="'.$i.'"';
	if($i==$Hora){ echo "selected"; }
	echo '>'.$i.'</option>';
}
   ?>
      </select>
      <select name="departureM" id="departureM" class="cajas">
        <option value="00" <? if($Minuto=="00"){ echo "selected"; } ?>>00</option>
        <option value="15" <? if($Minuto=="15"){ echo "selected"; } ?>>15</option>
        <option value="30" <? if($Minuto=="30"){ echo "selected"; } ?>>30</option>
        <option value="45" <? if($Minuto=="45"){ echo "selected"; } ?>>45</option>
      </select>
      <select name="departureTime" id="departureTime" class="cajas">
        <option value="AM" <? if($Tiempo=="AM"){ echo "selected"; } ?>>AM</option>
        <option value="PM" <? if($Tiempo=="PM"){ echo "selected"; } ?>>PM</option>
      </select></td>
     <td> <select name="endingH" id="endingH" class="cajas">
      
<?php
list($HoraE,$MinutoTimeE)=explode(':',$TimeAdventure['arrival']);
list($MinutoE,$TiempoE)=explode(' ',$MinutoTimeE);

for ($i = 1; $i <= 12; $i++) {
    echo '<option value="'.$i.'"';
	if($i==$HoraE){ echo "selected"; }
	echo '>'.$i.'</option>';
}
   ?>
      </select>
      <select name="endingM" id="endingM" class="cajas">
        <option value="00" <? if($MinutoE=="00"){ echo "selected"; } ?>>00</option>
        <option value="15" <? if($MinutoE=="15"){ echo "selected"; } ?>>15</option>
        <option value="30" <? if($MinutoE=="30"){ echo "selected"; } ?>>30</option>
        <option value="45" <? if($MinutoE=="45"){ echo "selected"; } ?>>45</option>
      </select>
      <select name="endingTime" id="endingTime" class="cajas">
        <option value="AM" <? if($TiempoE=="AM"){ echo "selected"; } ?>>AM</option>
        <option value="PM" <? if($TiempoE=="PM"){ echo "selected"; } ?>>PM</option>
      </select> </td>
      <td><input name="price" type="text" id="price" size="10" value="<?=$TimeAdventure['price']?>" /></td>
       <td><label for="item"></label>
        <input name="item" type="text" id="item" size="15" value="<?=$TimeAdventure['item']?>" /></td>
      <td><input name="newspace" type="text" class="cantidad" value="<?=$TimeAdventure['spaces']?>" size="10" id="newspace" /></td>
    
   <td><input name="required" type="text" class="cantidad" value="<?=$TimeAdventure['required']?>" size="7" id="required" /></td>
      <td>
        <label>
          <input name="status" type="radio" id="status_0" value="1" <?php if($TimeAdventure['status']==1){ echo "checked"; }?>/>
          Enable</label>
        <br />
        <label>
          <input type="radio" name="status" value="0" id="status_1" <?php if($TimeAdventure['status']==0){ echo "checked"; }?>/>
          Disable</label>
      </td>
        <td width="16"><input type="image" src="../../images/pencil.gif" width="16" height="16" value="update" /></td>
        <td width="16"><img src="../../images/minus.gif" width="13" height="13"  style="cursor: pointer;" onclick="self.location='special.time.php?accion=eliminar&idLinea=<?=$TimeAdventure['id']?>&adventure=<?=$adventure?>';" /></td>
      </tr>
      </form>
 <?
  }
  ?>
    </table>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" onclick="document.location='special.date.times.php?adventure=<?=$adventure?>&accion=copy'" name="button" id="button" value="Convert in Special Date" /> &nbsp;&nbsp;<label>
      <input name="button2" type="button" class="boton" id="button2" value="Close Windows" onclick="window.close();" />
    </label></td>
  </tr>
</table>
</body>
</html>