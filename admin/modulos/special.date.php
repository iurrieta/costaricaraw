<?php
require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";
$db = new MySQL(); 

$accion = $_REQUEST['accion'];
$date = $_REQUEST['date1'];
$price = $_REQUEST['price'];
$spaces = $_REQUEST['newspace'];
$adventure = $_REQUEST['adventure'];
$required = $_REQUEST['required'];
$departure = $_POST['departureH'].":".$_POST['departureM']." ".$_POST['departureTime'];
$ending = $_POST['endingH'].":".$_POST['endingM']." ".$_POST['endingTime'];
$item = $_REQUEST['item'];

if($accion=="eliminar"){
	
	$sqlDel = $db->consulta("DELETE FROM `adventure_offert` WHERE `id`='".$_GET['idLinea']."'");
}
if($accion=="actualizar"){
	
	$subtotal = $_POST['cantidad']*$_POST['precio']; 
	$sqlUpdate = $db->consulta("UPDATE `adventure_offert` SET `spaces`='".$spaces."',`date`='".$date."',`price`='".$price."',`departure`='".$departure."',`arrival`='".$ending."',`required`='".$required."',`item`='".$item."' WHERE `id`='".$_POST['idLinea']."'");
}
if($accion=="agregar"){
	list($producto,$precio) = explode("-",$_POST['producto']);	
	$subtotal = $_POST['cantidad']*$precio; 
	$sqlAdd = "INSERT INTO `adventure_offert` (`adventure`,`spaces`,`date`,`price`,`departure`,`arrival`,`required`,`item`) VALUES ('".$adventure."','".$spaces."','".$date."','".$price."','".$departure."','".$ending."','".$required."','".$item."')";
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
#cal {
	color:#333;
	background-color:#ccc;
	border: 1px solid;
	border-color: #1a4551;
	font: 11px Verdana, Arial, Helvetica, sans-serif;
}
body{
	font-size:12px;
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
<script type="text/javascript" src="../../js/date.js"></script>
<!--[if IE]><script type="text/javascript" src="../js/jquery.bgiframe.js"></script><![endif]-->
<!-- jquery.datePicker.js -->
<script type="text/javascript" src="../../lib/jquery.js"></script>
<script type="text/javascript" src="../../js/jquery.datePicker.js"></script>
<script type="text/javascript" charset="utf-8">

$(function()

{

	$('.date-pick')

		.datePicker()

		.bind(

			'focus',

			function()

			{

				$(this).dpDisplay();

			}

		).bind(

			'blur',

			function(event)

			{

				// works good in Firefox... But how to get it to work in IE?

				if ($.browser.mozilla) {



					var el = event.explicitOriginalTarget

					

					var cal = $('#dp-popup')[0];

				

					while (true){

						if (el == cal) {

							return false;

						} else if (el == document) {

							$(this).dpClose();

							return true;

						} else {

							el = $(el).parent()[0];

						}

					}

				}

			}

		);

});

		</script>
</head>

<body>
<table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#F2E4C2" class="titulo"><strong>Special Dates</strong></td>
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
       <td><strong>Day</strong></td>
        <td><strong>Price</strong></td>
        <td><strong>Item</strong></td>
        <td><strong>Maximum </strong></td>
        <td><strong>Required</strong></td>
       
         <td colspan="2" align="center"><strong>Options</strong><strong></strong></td>
        </tr>
         <form action="special.date.php" method="post">
          <input type="hidden" name="accion" value="agregar" />
          <input type="hidden" name="adventure" value="<?=$adventure?>" />
    
          <tr>
            <td><select name="departureH" id="departureH" class="cajas">
      
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
            <td>
            
            <select name="endingH" id="endingH" class="cajas">
      
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
      </select> 
            </td>
     <td><input name="date1" type="text" class="date-pick" id="date1" style="width:100px;" value="" size="12"/></td>
        <td><input name="price" type="text" class="cantidad" value="" size="8" id="price" /></td>
        <td><label for="item"></label>
        <input name="item" type="text" id="item" size="15" /></td>
      <td><input name="newspace" type="text" class="cantidad" value="" size="7" id="newspace" /></td>
      <td><input name="required" type="text" class="cantidad" value="" size="7" id="required" /></td>
     
      <td width="16"><input type="image" src="../../images/plus.gif" width="13" height="13" value="add" /></td>
        <td width="16">&nbsp;</td>
      </tr>
      </form>
<tr><td colspan="9"><hr size="1" width="100%" noshade="noshade" /></td></tr>
  <?
  $sqlRec= $db->consulta("SELECT * FROM `adventure_offert` WHERE `adventure`='".$_REQUEST['adventure']."' ORDER By `date` DESC");
  while($Special=$db->fetch_array($sqlRec)){
	
	 ?>
     <form action="special.date.php" method="post">
     <input type="hidden" name="idLinea" value="<?=$Special['id']?>" />
     <input type="hidden" name="accion" value="actualizar" />
      <input type="hidden" name="adventure" value="<?=$Special['adventure']?>" />
      <tr>
        <td> <select name="departureH" id="departureH" class="cajas">
      
<?php
list($Hora,$MinutoTime)=explode(':',$Special['departure']);
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
list($HoraE,$MinutoTimeE)=explode(':',$Special['arrival']);
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
      </select></td>
     <td><input name="date1" type="text" class="date-pick" id="date1" style="width:100px;" value="<?=$Special['date']?>" size="12"/></td>
        <td><input name="price" type="text" class="cantidad" value="<?=$Special['price']?>" size="8" id="price" /></td>
        <td><label for="item"></label>
        <input name="item" type="text" id="item" size="15" value="value="<?=$Special['item']?>"" /></td>
      <td><input name="newspace" type="text" class="cantidad" value="<?=$Special['spaces']?>" size="7" id="newspace" /></td>
      <td><input name="required" type="text" class="cantidad" value="<?=$Special['required']?>" size="7" id="required" /></td>
      
      <td width="16"><input type="image" src="../../images/pencil.gif" width="16" height="16" value="update" /></td>
        <td width="16"><img src="../../images/minus.gif" width="13" height="13"  style="cursor: pointer;" onclick="self.location='special.date.php?accion=eliminar&idLinea=<?=$Special['id']?>&adventure=<?=$adventure?>';" /></td>
      </tr>
      </form>
 <?
  }
  ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><label>
      <input name="button2" type="button" class="boton" id="button2" value="Close Windows" onclick="window.close();" />
    </label></td>
  </tr>
</table>
</body>
</html>