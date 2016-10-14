<?php
$zone=3600*-6; 
$Fecha = gmdate("Y/m/d", time() + $zone);
$diaArray = array($lang['domingo'],$lang['lunes'],$lang['martes'],$lang['miercoles'],$lang['jueves'],$lang['viernes'],$lang['sabado']);
$MesArray = array("",$lang['enero'],$lang['febrero'],$lang['marzo'],$lang['abril'],$lang['mayo'],$lang['junio'],$lang['julio'],$lang['agosto'],$lang['septiembre'],$lang['octubre'],$lang['noviembre'],$lang['diciembre']);
$DiaNombre = $diaArray[date('N',strtotime($Fecha))];
$Mes = $MesArray[date('n',strtotime($Fecha))];
$Year = date('Y',strtotime($Fecha));
$Dia = date('d',strtotime($Fecha));
$fecha_texto = $DiaNombre.' '.$Dia.' de '.$Mes.', '.$Year;
?>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="creditos">2010-<?php echo date('Y');?> <strong><? echo _APP_NAME; ?></strong>. <?php echo $lang['rights_reserved']; ?><br /><? echo $fecha_texto; ?><br />Version <? echo _APP_VERSION; ?></td>
  </tr>
</table>

