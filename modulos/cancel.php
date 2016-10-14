<?php
$sql = $db->consulta("DELETE FROM `reservations` WHERE `id`='".$_REQUEST['aid']."'");
$reservLines = $db->consulta("DELETE FROM `reservations_line` WHERE `reservations_id`='".$_REQUEST['aid']."'");
$sqlInventory = $db->consulta("DELETE FROM `adventures_inventory` WHERE `reservations_id`='".$_REQUEST['aid']."'");
?>
<script>
document.location='index.php';
</script>