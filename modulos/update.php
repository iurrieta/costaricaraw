<?php 
session_start(); 

extract($_REQUEST); 

if(!$cantidad){ $cantidad=1; } 

$carro=$_SESSION['carro']; 
 
$carro[md5($id)]=array('identificador'=>md5($id),'cantidad'=>$cantidad,'nombre'=>$row['nombre'],'precio'=>$row['precio'],'id'=>$id); 

$_SESSION['carro']=$carro; 

header("Location:../index.php?s=cart"); 
?> 
