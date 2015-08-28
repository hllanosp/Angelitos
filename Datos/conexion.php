<?php 
$conectar = new mysqli('localhost','root','','prueba');
//$cn = mysql_connect("localhost","root","");
//mysql_select_db("poa", $cn);

$enlace = mysql_connect('localhost', 'root', '');
mysql_select_db('prueba', $enlace);
if (!$enlace) {
    die('No se pudo conectar: ' . mysql_error());
}



?>
