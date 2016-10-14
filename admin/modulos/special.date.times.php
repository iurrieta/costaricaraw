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


if($accion=="savecopy"){
$sqlRec= $db->consulta("SELECT * FROM `adventures_times` WHERE `adventure`='".$_REQUEST['adventure']."' ORDER By `departure` DESC");
  while($TimeAdventure=$db->fetch_array($sqlRec)){
	
		$sqlAdd = "INSERT INTO `adventure_offert` (`adventure`,`spaces`,`price`,`departure`,`arrival`,`required`,`date`,`item`) VALUES ('".$adventure."','".$TimeAdventure['spaces']."','".$TimeAdventure['price']."','".$TimeAdventure['departure']."','".$TimeAdventure['arrival']."','".$TimeAdventure['required']."','".$date."','".$TimeAdventure['item']."')";
	$ejecutar = $db->consulta($sqlAdd);

  
  }
  
  $Action = "document.location='special.date.php?adventure=".$adventure."';";
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
<?=$Action?>

</script>
</head>

<body>  <form action="special.date.times.php" method="post">
          <input type="hidden" name="accion" value="savecopy" />
          <input type="hidden" name="adventure" value="<?=$adventure?>" />
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#F2E4C2" class="titulo"><strong>Choose the Date</strong></td>
  </tr>
  <tr>
    <td><strong>Date:</strong></td>
    <td colspan="3"><input name="date1" type="text" class="date-pick" id="date1" style="width:100px;" value="" size="12"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input type="submit" name="Continue" id="Continue" value="Continue" /></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    </tr>
    </table>      
    </form>    
</body>
</html>