<?php  
class MySQL{  

private $conexion;  
private $total_consultas;  

	function __destruct() {
		if (!is_resource($this->conexion)){
			mysql_close($this->conexion);
			//print_r($this->link);
		}
	}
	function __construct() {
		$this->MySQL();
	}


	public function MySQL(){  
		if(!isset($this->conexion)){  
			$this->conexion = (mysql_connect(_DBSERVER,_DBUSER,_DBPASS)) or die(mysql_error());  
			mysql_select_db(_DBNAME,$this->conexion) or die(mysql_error());  
		}  
	}  

	public function consulta($consulta){  
		$this->total_consultas++;  
		$resultado = mysql_query($consulta,$this->conexion);  
		if(!$resultado){  
		  echo 'MySQL Error: '.$consulta.' [ '.mysql_error().' ] ';  
		  exit;  
		}  
	return $resultado;   
	}  

	public function fetch_array($consulta){   
		return mysql_fetch_array($consulta);  
	} 
	
	public function fetch_row($consulta){   
		return mysql_fetch_row($consulta);  
	}  

	public function num_rows($consulta){   
		return mysql_num_rows($consulta);  
	}  
	
	public function GetResults($consulta,$col,$val){
		return mysql_result($consulta,$col,$val);
	}

	public function getTotalConsultas(){  
		return $this->total_consultas;  
	}  
	
	public function getRowAffected(){
		return mysql_affected_rows($this->conexion);
	}
	
	public function getLastID(){
		return mysql_insert_id($this->conexion);
	}
}
?>  