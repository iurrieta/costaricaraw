<?php
require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";
$db = new MySQL(); 



$update = $db->consulta("UPDATE `affiliates` SET `logo`='' WHERE `id`='".$_GET['aff']."'");

?>
<script>
window.opener.location.reload();
window.close();
</script>