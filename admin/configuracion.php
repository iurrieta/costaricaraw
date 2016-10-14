<?php
/* APLICACION */
define("_APP_VERSION","0.1");
define("_APP_NAME","Costa Rica Raw Adventures");
define("_APP_KEY","ABQIAAAAGpEWenySjkI7QuRAy1fXBxRKlB8UcEfFhE3uLHKmL85ANiO0NhR_PhGLFVubDwsmu463D7hkdY3kQw");
/* APLICACION */



/* DIRECTORIOS */
$INCLUDE_DIR = "../includes";
$CLASS_DIR = $INCLUDE_DIR."/clases";
$MODULES_DIR = "../modulos";
$FUNCTION_DIR = $INCLUDE_DIR."/funciones";
/* DIRECTORIOS */

/* IDIOMA PREDETERMINADO */
$DEFAULT_LANGUAGE = "ENGLISH";
/* IDIOMA PREDETERMINADO */

/* INCLUDES */
require_once $INCLUDE_DIR . "/" . "dbConf.php";
require_once $INCLUDE_DIR . "/" . "archivos.php";
require_once $CLASS_DIR . "/clase.conexion.php";
//require_once $CLASS_DIR . "/clase.idioma.php";
require_once $CLASS_DIR . "/clase.sha256.php";
require_once $INCLUDE_DIR . "/" . "funciones.php";
require_once $FUNCTION_DIR . "/" . "seguridad.php";
//require_once $CLASS_DIR.'/GTranslate.php';
/* INCLUDES */

/* Extraer Valores */
$action = $_REQUEST['action'];
/* Extraer Valores */
?>
