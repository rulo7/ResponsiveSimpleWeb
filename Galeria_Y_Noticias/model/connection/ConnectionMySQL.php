<?php

include_once ("interfaces/Connection.php");

class ConnectionMySQL implements Connection
{
	private $user;
	private $password;
	private $databaseName;
	private $hostName;
	
	public function __construct()
	{
		$this->hostName = NULL;
		$this->user = NULL;
		$this->password = NULL;
		$this->databaseName = NULL;
	}
	
	//@override
	public function connect($hostName, $user, $password, $databaseName)
	{
	
		$this->hostName = $hostName;
		$this->user = $user;
		$this->password = $password;
		$this->databaseName = $databaseName;
	
		$enlace = mysql_connect($this->hostName, $this->user, $this->password);
		
		if (!$enlace) 
		{
			die('No pudo conectarse: ' . mysql_error() . '<br>');
		}
		else
		{			
			// 'Conectado satisfactoriamente';
			$bd_seleccionada = mysql_select_db($this->databaseName);
			
			if (!$bd_seleccionada) 
			{
				die ('No se puede usar' . mysql_error() . '<br>');
			}
		}
		return $enlace;
	}
	
	//@override
	public function disconnect($enlace)
	{
		mysql_close($enlace);		
	}
	
	//@override
	public function execute($query)
	{		   
		$resultado = mysql_query($query);		
		
		if (!$resultado) 
		{
			$mensaje  = 'Consulta no valida: ' . mysql_error() . '<br>';
			die($mensaje);
		}
		
		return $resultado;
				
	}

}


?>