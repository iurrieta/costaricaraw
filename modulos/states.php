<?
//set IE read from page only not read from cache
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

header("content-type: application/x-javascript; charset=ISO-8859-2");

$data=$_GET['data'];
$val=$_GET['val'];

include('../includes/configuracion.php');
$db = new MySQL();


if ($data=='states') {  // first dropdown
  echo "<select name='states' class='input' onChange=\"dochange('cities', this.value)\">\n";
  echo "<option value='0'>== Seleccione su Provincia ==</option>\n";
  $result=$db->consulta("select `id`, `provincia` from distritos GROUP by `provincia` ORDER By provincia ASC");
  while(list($id, $name)=$db->fetch_array($result)){
       echo "<option value=\"$name\" >$name</option> \n" ;
  }
} else if ($data=='cities') { // second dropdown
  echo "<select name='cities' class='input' onChange=\"dochange('distrito', this.value)\">\n";
  echo "<option value='0'>== Seleccione su cantón ==</option>\n";                   
  $result=$db->consulta("SELECT `provincia`, `canton` FROM distritos WHERE `provincia` = '$val' GROUP by `canton`");
  while(list($id, $name)=$db->fetch_array($result)){
       echo "<option value=\"$id-$name\" >$name</option> \n" ;
  }
}else if ($data=='distrito') { // tirt dropdown
  list($provincia,$canton) = explode("-",$val);	
  echo "<select name='distrito' class='input' >\n";
  echo "<option value='0'>== Seleccione su distrito ==</option>\n";                   
  $result=$db->consulta("SELECT `id`, `distrito` FROM distritos WHERE `canton` = '$canton' AND `provincia` = '$provincia' ORDER BY `distrito` ASC");
  while(list($id, $name)=$db->fetch_array($result)){
       echo "<option value=\"$name\" >$name</option> \n" ;
  }
}
echo "</select>\n";
?>
