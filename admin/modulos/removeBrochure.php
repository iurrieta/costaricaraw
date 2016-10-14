<?php
require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";
$db = new MySQL(); 

@unlink('../../flyer/'.$_GET['flyer']);
if($_REQUEST['cc']=="img"){
	$update = $db->consulta("UPDATE `adventures` SET `flyerimg`='' WHERE `id`='".$_GET['adv']."'");
}else{
	$update = $db->consulta("UPDATE `adventures` SET `flyer`='',`flyertype`='',`flyertext`='',`flyerimg`='' WHERE `id`='".$_GET['adv']."'");
}
?>
<script>
window.close();
</script>