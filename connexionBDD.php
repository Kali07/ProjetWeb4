<?php

try
{
    $db = new PDO('mysql:host=localhost; dbname=workshop3; charset=utf8', 'root', 'Kalikondo98', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	
	return $db;
	}

catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


?>