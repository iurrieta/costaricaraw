<?php
session_start();

require_once "../../includes/dbConf.php";
require_once "../../includes/clases/clase.conexion.php";


if (isset($_POST['cmd'])) {
	$db = new MySQL(); 	 
	$loginUsername=$_POST['usuario'];
	$password= md5($_REQUEST['clave']);
	$CRR_Fallo = "index.php?cmd=login&mensaje=error";
	$CRR_Login = "index.php?cmd=logindone&login_access=".time();
	
	$_SESSION["hora"] = $loginDate;	
	$loginIP = $_SERVER['REMOTE_ADDR'];
    
  $QuerySQL = "SELECT * FROM `administrator` WHERE `user`='".$loginUsername."' AND `pass`='".$password."'";
  $sqlLogin= $db->consulta($QuerySQL); 
 
$zone=3600*-6; 
$loginDate = gmdate("Y-m-d H:i:s", time() + $zone);	 
   
  $loginFoundUser = $db->num_rows($sqlLogin);
  if ($loginFoundUser) {
    $LoginData = $db->fetch_array($sqlLogin);    
	$loginID  = $LoginData['id'];
	$loginEmail = $LoginData['email'];
	$loginEstado = $LoginData['status'];
	
		
	
	

    if($loginEstado==0){
    echo '<script>alert("Account Disabled");document.location="../index.php";</script>';
	
	
	 
	}else{
	
	//Sesiones
    $_SESSION['CRR_Admin'] = $loginEmail;
    $_SESSION['CRR_AUserID'] = $loginID;
	$_SESSION['CRR_AEmail'] = $loginEmail;

 
	$_SESSION["time"] = time();
	
	
   echo "<script>document.location='../loading.php'</script>";
	
	}
	
  }
  else {
    echo '<script>alert("Login Error");document.location="../index.php";</script>';
	
		
	
  }
}
?>