<table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="middle">
 <?php 
if($carro){
$Item = $_REQUEST['Item'];	
//si el carro no está vacío, mostramos los productos
?>
            <div>
              <div align="center"><strong><br>
              <br>
                <font color="#20220C" size="+2">Please confirm information.</font><br />
              <br />
              </strong></div>
            </div>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr bgcolor="#b6c4e4"> 
    <td width="150" height="30" bgcolor="#CC9900" class="Estilo11"><div class="Estilo11"><strong>Adventure</strong></div></td>
     <td height="30" bgcolor="#CC9900" class="Estilo11"><div class="Estilo11"><strong>Location</strong></div></td>
   
     <td bgcolor="#CC9900" class="Estilo11"><span style="display:none;" id="Item"><strong>Item </strong></span></td>
   
    <td bgcolor="#CC9900" class="Estilo11"><strong>Day </strong></td>
   
    <td bgcolor="#CC9900" class="Estilo11"><strong>Date</strong></td>
    <td bgcolor="#CC9900" class="Estilo11" align="center"><strong>Check-in<br />Departure</strong></td>
    <!--td bgcolor="#CC9900" class="Estilo11" align="center"><strong>Check-out<br />Ending</strong></td-->
        <td width="40" align="center" bgcolor="#CC9900" class="Estilo11"><strong><span class="Estilo11">Qty</span></strong></td>

    <td width="40"  bgcolor="#CC9900" class="Estilo11"><div class="Estilo11"><strong>Cost</strong></div></td>
      <td width="40"  bgcolor="#CC9900" class="Estilo11"><div class="Estilo11"><strong>
        Total</strong></div></td>
      <td width="40" align="center"  bgcolor="#CC9900" class="Estilo11"><strong>Deposit<br />
        Total Due</strong></td>
    <td width="70" align="center" bgcolor="#CC9900" class="Estilo11"><div class="Estilo11"><strong>Remove</strong></div></td>
  
  </tr>
  <?php
  $color=array("#ccc","#fff");
  $contador=0;
  //las 2 líneas anteriores sirven para hacer una tabla con colores alternos
  $suma=0;
  //antes de recorrer todos los valores de la matriz carro, ponemos a cero la variable $suma,
  //en la que iremos sumando los subtotales del costo de cada item por la cantidad de unidades que se especifiquen
   foreach($carro as $k => $v){
  
   $sqlCart = $db->consulta("SELECT * FROM `adventures` WHERE `id`='".$v['id']."'");
   $Adventure = $db->fetch_array($sqlCart);
   $sqlLocation = $db->consulta("SELECT `name` FROM `locations` WHERE `id`='".$Adventure['locations_id']."'");
	list($LocationName) = $db->fetch_array($sqlLocation);
	
	
	if($v['specialDate']){
	$sqlHorario = $db->consulta("SELECT * FROM `adventure_offert` WHERE `id`='".$v['horario']."'");
	$Horario = $db->fetch_array($sqlHorario);	
	}else{
	$sqlHorario = $db->consulta("SELECT * FROM `adventures_times` WHERE `id`='".$v['horario']."'");
	$Horario = $db->fetch_array($sqlHorario);
	}
	
	$subto=$v['cantidad']*$v['precio'];
   
   if($v['deposit']){
	$subtoD=$v['cantidad']*$v['deposit'];
	$suma = $suma+$subtoD;	   
   }else{
   $suma=$suma+$subto;
   }
   $contador++;//este es el contador que usamos para los colores alternos
   list($Dia,$LaFecha)=explode(',',$v['fechaTexto']);
    ?>
  <form name="a<?php echo $v['identificador'] ?>" method="post" action="modulos/update.php?<?php echo SID ?>" id="a<?php echo $v['identificador'] ?>">
  <?
  $precio =  number_format($v['precio'],0,'.',',');
  ?>  <tr bgcolor="<?php echo $color[$contador%2]; ?>" class='prod'> 
  
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><a href="index.php?cmd=adventures&adv=<?php echo $v['id'] ?>"><b><?php echo $Adventure['name']; ?></b></a></td>
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><b><?php echo $LocationName; ?></b></td>
       
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><?php if($v['item']){ echo $v['item']; echo "
	  <script>
	  document.getElementById('Item').style.display='block';
	  </script>"; } ?></td>
    
      
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><?php echo $Dia; ?></td>
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><?php echo $LaFecha; ?></td>
      <td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><?php echo $Horario['departure']; ?></td>
      <!--td align="left" bgcolor="<?php echo $color[$contador%2]; ?>"><?php echo $Horario['arrival']; ?></td-->
    <td align="center" valign="top"> 
      <strong>  <?php echo $v['cantidad'] ?></strong>
        <input name="id" type="hidden" id="id" value="<?php echo $v['id'] ?>">
		</td>
      <td  valign="top" bgcolor="<?php echo $color[$contador%2]; ?>"><div align="right" class="Estilo12">$<?php echo $precio ?></div></td>
      <td  valign="top" bgcolor="<?php echo $color[$contador%2]; ?>"><div align="right" class="Estilo12">$<?php echo number_format($subto,0,'.',','); ?></div></td>
      <td  valign="top" bgcolor="<?php echo $color[$contador%2]; ?>"><div align="right" class="Estilo12">$<?php echo number_format($subtoD,0,'.',','); ?></div></td>
     
      <td align="center" valign="top" bgcolor="<?php echo $color[$contador%2]; ?>"><a href="modulos/remove.php?id=<?php echo $v['identificador'] ?>"><img src="images/remove.png" width="24"  border="0"></a></td>
  </tr></form>
  <?php 
  //por cada item creamos un formulario que submite a agregar producto y un link que permite eliminarlos
$cant = $v['cantidad'];
$cantidad = $cantidad + $cant;
$Deposito = $Deposito + $v['deposit'];

unset($subtoD);
unset($subto);
}

$total = $suma;
?>
  <tr class='prod'> 
      <td height="35" colspan="8" align="right" bgcolor="#CC9900"><span class="Estilo11"><strong>Total</strong></span><strong>&nbsp; Amount Due</strong>&nbsp;</td>
      <td height="35" colspan="2" align="right" bgcolor="#CC9900"><div align="right"><span class="Estilo11"><strong>$<?php echo number_format($total,0,'.',',');?></strong></span></div></td>
      <td bgcolor="#CC9900">&nbsp;</td>
  </tr>
  <tr class='prod'>
  <td height="35" colspan="11" align="right" bgcolor="#CC9900"><strong>Note: Balance for each item is due upon arrival.</strong></td>
    </tr>
      </table> 


<br /><br />
 <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><a href="index.php"><img src="images/continue_shpping.png" border="0" alt="Continue Shopping" /></a></td>
    <td align="center"><a href="empty.php"><img src="images/empty_cart.png" alt="Empty Shopping Cart" border="0" /></a></td>
    <td align="center"><a href="index.php?cmd=buy"><img src="images/buy_now.png" border="0" alt="Buy Now" /></a></td>
  </tr>
</table>

 
<?php }else{ 
//header("Location:index.php?".SID); 
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center"> <h4>Shopping Cart is empty. </h4>
 <br />

  <input type="button" name="comprar" value="Continue Shopping" class="boton" onClick="self.location='index.php'">
 </div>
  <?php }?>
  </td></tr></table>
	
