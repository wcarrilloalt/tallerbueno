<?php
// Error Reporting
error_reporting(E_ALL);

define('DIR_SYSTEM','C:/xampp/htdocs/taller1/');

// Check Version
if (version_compare(phpversion(), '5.3.0', '<') == true) {
	exit('PHP5.3+ Required');
}

include_once(DIR_SYSTEM."config.php");

function library($class) {
	$file = DIR_SYSTEM . 'library/' . str_replace('\\', '/', strtolower($class)) . '.php';

	if (is_file($file)) {
		include_once($file);

		return true;
	} else {
		return false;
	}
}

spl_autoload_register('library');

// Conecta a la base de datos enviada como ambiente
function conectar($cod_ambiente) {
	/*
	  1: Oracle
	  2: MySQL
	*/
	switch ($cod_ambiente) {
		case 1:
   	           $db = new DB('oracle'
	                       ,DB_HOSTNAME_ORA
						   ,DB_USERNAME_ORA
						   ,DB_PASSWORD_ORA
						   ,DB_SERVICE_NAME_ORA
						   ,DB_PORT_ORA);		
		break;

		case 2:
   	           $db = new DB(DB_DRIVER_MySQL
	                       ,DB_HOSTNAME_MySQL
						   ,DB_USERNAME_MySQL
						   ,DB_PASSWORD_MySQL
						   ,DB_DATABASE_MySQL
						   ,DB_PORT_MySQL);
		break;
 }
	return $db;
}

  $db = conectar(1);
  $query = $db->query("select USUARIO,nombre_completo from gral.usuarios where estatus = 'IT'");
 
 
 foreach($query->rows as $usuario) {
	 echo $usuario['USUARIO']."-".$usuario['NOMBRE_COMPLETO']."<BR>"; 
 }	 

 /*
 $db = conectar(2);
 $query = $db->query("select * from paises");
 
 
 foreach($query->rows as $pais) {
	 echo $pais['codigo']."-".$pais['nombre']."<BR>"; 
 }	
 
*/
?>