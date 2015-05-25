<?php

include_once ("ConnectionMySQL.php");

class FactoryConnection
{
	private static $instance = NULL;
	
	private function __contruct() {	}
	
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new FactoryConnection();
		}
		
		return self::$instance;
	}     
	
	public function getConnection($tipo){		
		if($tipo == 'MySQL')
		{
			return new ConnectionMySQL();
		}		
	}
}
?>