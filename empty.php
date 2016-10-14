<?php
session_start();
$_SESSION['carro'] = NULL;
unset($_SESSION['carro']);
?>
<script>
document.location='index.php?cmd=cart';
</script>