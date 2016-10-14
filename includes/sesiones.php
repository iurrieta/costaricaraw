<?php
@ini_set("session.use_only_cookies","1");
@ini_set("session.use_trans_sid","0");
//if (time() - $_SESSION["time"] < 9000)  {
$_SESSION["time"] = time();
/*}else{
$_SESSION['carro'] = NULL;
$_SESSION['carro'] = "";
unset($_SESSION['carro']);
}*/

if($_SESSION['carro']){
$segundos = time();
$tiempo_transcurrido = $segundos;
$tiempo_maximo = $_SESSION['inicio'] + ( $_SESSION['intervalo'] * 60 ) ; // se multiplica por 60 segundos ya que se configura en minutos

	if($tiempo_transcurrido > $tiempo_maximo){
		$_SESSION['carro'] = NULL;
		$_SESSION['carro'] = "";
		unset($_SESSION['carro']);
		unset($_SESSION['inicio']);
		unset($_SESSION['intervalo']);
	}else{
		$_SESSION['inicio'] = time();
	} 

}
$loginEmail=  $_SESSION['affiliateID'];
$refererID=  $_SESSION['kid'];
$affiliateHome=  $_SESSION['affiliateHome'];
$loginID = $_SESSION['affiliateName'];
$loginEmail=  $_SESSION['topAdventure'];
$loginID = $_SESSION['time'];
?>