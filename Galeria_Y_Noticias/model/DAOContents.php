<?php

Class DAOContents {

	private static $instance = NULL;
	public static $dbUser;
	public static $dbPassword;
	public static $dbName;
	public static $hostName;
	public static $ruta_galeria;

	private function __construct() {
		$this -> dbUser = "root";
		$this -> dbPassword = "root";
		$this -> hostName = "localhost";
		$this -> dbName = "galeria_y_noticias";
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new DAOContents();
		}
		return self::$instance;
	}

	////////////////////////////////////////////////////
	//Convierte fecha de mysql a normal
	////////////////////////////////////////////////////
	public function cambiaf_a_normal($fecha) {
		preg_match("#([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})#", $fecha, $mifecha);
		$lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
		return $lafecha;
	}

	////////////////////////////////////////////////////
	//Convierte fecha de normal a mysql
	////////////////////////////////////////////////////

	public function cambiaf_a_mysql($fecha) {
		preg_match("#([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})#", $fecha, $mifecha);
		$lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
		return $lafecha;
	}

}
?>