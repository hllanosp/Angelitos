
<?php
	if(!isset($_SESSION))
	{
	  session_start();
	}
	if(!isset($_SESSION['auntentificado'] ) ) {
		header("location: ".$maindir."login/login.php");
	 }
	else {
	}

 ?>
