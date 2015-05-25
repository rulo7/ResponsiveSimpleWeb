<?php
include_once ("connection/FactoryConnection.php");
include_once ("DAOContents.php");

class Galery {

	private $connection;
	private static $instance;
	private function __construct() {
		$this -> connection = FactoryConnection::getInstance() -> getConnection('MySQL');
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new Galery();
		}
		return self::$instance;
	}

	public function insert($archivo, $descripcion) {

		//Insercion en la BBDD

		$query = "INSERT INTO galeria(nombre_archivo, descripcion) values('" . $archivo . "', '" . $descripcion . "')";

		$link = $this -> connection -> connect(DAOContents::getInstance() -> hostName, DAOContents::getInstance() -> dbUser, DAOContents::getInstance() -> dbPassword, DAOContents::getInstance() -> dbName);

		$result = $this -> connection -> execute($query);
		$this -> connection -> disconnect($link);

		return true;
	}

	public function getGalery() {

	
		$query = "SELECT * FROM galeria ORDER BY `id` DESC";
		
		$link = $this -> connection -> connect(DAOContents::getInstance() -> hostName, DAOContents::getInstance() -> dbUser, DAOContents::getInstance() -> dbPassword, DAOContents::getInstance() -> dbName);

		$result = $this -> connection -> execute($query);

		$this -> connection -> disconnect($link);

		return $result;
	}

	public function delete($archivo) {

		//Insercion en la BBDD

		$query = "DELETE FROM `galeria` WHERE `nombre_archivo`='" . $archivo . "'";

		$link = $this -> connection -> connect(DAOContents::getInstance() -> hostName, DAOContents::getInstance() -> dbUser, DAOContents::getInstance() -> dbPassword, DAOContents::getInstance() -> dbName);

		$result = $this -> connection -> execute($query);
		$this -> connection -> disconnect($link);

		return true;
	}

}
?>
