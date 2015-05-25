<?php

interface Connection
{

	function connect($hostName, $user, $password, $databaseName);
	function disconnect($enlace);
	function execute($query);
	
}

?>