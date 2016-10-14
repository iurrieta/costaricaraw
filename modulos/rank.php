<?php
/* 
MOD BY MARCOFBB, AUTOMATIZADO Y MEJORADO, CON SISTEMA DE PASS Y TODO :P 

contacto: marco.fbb@gmail.com

*/
$pass2 = "1"; // la pass para que nadie pueda crear ranking
$web = "www.costaricaraw.com/dev"; // tu web xD no es nesesario pero para que quede mas automatisado el script
	//funcion para conectar con la base de datos
	function conectar(){
		// Conexi�n a la base de datos
		if ( file_exists("includes/dbConf.php")){
              include('includes/dbConf.php');

        } else {
               include('../includes/dbConf.php');
        }
		
		$dbhost=_DBSERVER;
		$dbusername=_DBUSER; //nombre del usuario
		$dbuserpass=_DBPASS; //password o contrase�a del usuario		
		$dbname=_DBNAME;//nombre de la base de datos
		$link = mysql_connect($dbhost, $dbusername,$dbuserpass);
		mysql_select_db($dbname, $link);
			
		return $link;
	}
		
	$id = $_GET['adv'];//pagina, apartado o noticia que se quiere votar
	
	if($id!=""){
		$voto = $_GET['v'];//voto del usuario
		$link = conectar();//conectamos a la base de datos			
		
		//obtenemos la IP del usuario
		if ($_SERVER) {
			if ( $_SERVER[HTTP_X_FORWARDED_FOR] ) {
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} elseif ( $_SERVER["HTTP_CLIENT_IP"] ) {
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		} else {
			if ( getenv( "HTTP_X_FORWARDED_FOR" ) ) {
				$realip = getenv( "HTTP_X_FORWARDED_FOR" );
			} elseif ( getenv( "HTTP_CLIENT_IP" ) ) {
				$realip = getenv( "HTTP_CLIENT_IP" );
			} else {
				$realip = getenv( "REMOTE_ADDR" );
			}
		}					
														
		$fecha = date('Y-m-d');
		//actualizamos la tabla de votos realizadas por los usuarios y borramos lo que sean del dia anterior
		$result = mysql_query("DELETE FROM votos_usuarios WHERE dataCreate <> '".$fecha."'");
	
		//comprobamos que este usuario ya no haya realizado un voto (identificacion por IP)
		$result = mysql_query("SELECT * FROM votos_usuarios WHERE ip = '".$realip."' and id = $id");								
		$row = mysql_fetch_row($result);
		
		/*$versiesta = mysql_query("SELECT count(*) FROM rank WHERE id =$id",$link);
		$verResultado = mysql_num_rows($versiesta);
		if($verResultado==0){
		$result = mysql_query("INSERT INTO `rank` (`id`,`votos`,`media`) VALUES ('$id','0','0')",$link);
		}
		*/
		if($voto){
		//el usuario no ha votado para este apartado
		if($row[0]==""){	
			$result = mysql_query("SELECT `votos`,`media` FROM `adventures` WHERE `id`='".$id."'",$link);
			$row = mysql_fetch_row($result);
		
			$auxmedia = $row[1];		
			$votos =$row[0] + 1;			
			$media = (($row[0] * $auxmedia) + $voto)/ $votos;			
			//actualizamos el voto							
			$result = mysql_query("UPDATE `adventures` SET `votos`='".$votos."', `media`='".$media."' WHERE `id`='".$id."'");				
			mysql_query("INSERT INTO votos_usuarios(id,ip,dataCreate)VALUES($id,'".$realip."','".$fecha."')");			
			echo " vote successful";
		}else{ //el usuario ya ha votado para este apartado
			echo " You already voted";	
		}
		}
	}
?>
