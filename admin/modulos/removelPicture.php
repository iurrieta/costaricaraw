<?php
require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";
$db = new MySQL(); 

@unlink('../../images/locations/'.$_GET['picture']);
@unlink('../../images/locations/medium_'.$_GET['picture']);
@unlink('../../images/locations/small_'.$_GET['picture']);

if($_GET['picID']=="1"){
$field = "pic1";	
}
if($_GET['picID']=="2"){
$field	 = "pic2";
}
if($_GET['picID']=="3"){
$field = "pic3";
}
if($_GET['picID']=="4"){
$field = "pic4";
}
if($_GET['picID']=="5"){
$field = "pic5";
}
if($_GET['picID']=="6"){
$field = "pic6";
}
if($_GET['picID']=="7"){
$field = "pic7";
}
if($_GET['picID']=="8"){
$field = "pic8";
}
if($_GET['picID']=="9"){
$field = "pic9";
}
if($_GET['picID']=="10"){
$field = "pic10";
}
if($_GET['picID']=="11"){
$field = "pic11";
}
if($_GET['picID']=="12"){
$field = "pic12";
}
if($_GET['picID']=="13"){
$field = "pic13";
}
if($_GET['picID']=="14"){
$field = "pic14";
}
if($_GET['picID']=="15"){
$field = "pic15";
}
$update = $db->consulta("UPDATE `locations` SET `".$field."`='' WHERE `id`='".$_GET['adv']."'");

?>
<script>
window.close();
</script>