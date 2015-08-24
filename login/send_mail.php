<!-- Se encargara de revisar si el email ingresado se encuentra registrado en la base de datos
      -generara una nueva contrasena (funciones/generar_pass.php)
      -se actualizara la contrasena del usuario
      -y se enviara un correo electronico de notificacion.
-->

<?php

  // import necesarios
  include("../conexion/config.inc.php");
  include("../funciones/generar_pass.php");


  $email = $_POST['email'];
  $user = $_POST['usuario_forgot'];

	$query =  $db->prepare("select email from usuario where email = '".$email."' and usuario = '".$user."';");
	$query->execute();
	$result = $query ->rowCount();

  //si el pass y el usuario ingresado coinciden con algun registro
  if ($result>0) {
    include ('../funciones/generar_pass.php');
    $query =  $db->prepare("update usuario set contrasena = '".$cad."'  where email = '".$email."' ;");
  	$query->execute();

    $destinatario = $email;
    $asunto = "Este mensaje es de prueba";

    $cuerpo = "
    <html>
    <head>
       <title>Prueba de correo</title>
    </head>
    <body style = 'background-color: rgba(92, 0, 142, 0.5); color:white;'>
    <h1 style = 'color:white'>Fundacion Angelitos</h1>
    <p>
    <b style = 'color:white'>Regeneracion de contrasena</b>.su contrasena ha sido modificada con exito....
    </p>
    <hr>
    </hr>
    <p style = 'color:white'>
    su nueva contrasena es ".$cad."
    </p>
    <hr></hr>
    </body>
    </html>
    ";

    //para el envío en formato HTML
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    //dirección del remitente
    $headers .= "From: Hector llanos <hllanos@angelitos.esy.es>\r\n";

    mail($destinatario,$asunto,$cuerpo,$headers) ;


    echo "<div>
            <a href='#' class ='close' data-dismiss='alert'>&times;</a>
              <strong> Exito!</strong> correo electronico enviado correctamente...=".$cad."
            </div>";
  }
  else {
    echo "<div>
            <a href='#' class ='close' data-dismiss='alert'>&times;</a>
              <strong> Error! </strong> email o usuario no se encuentra registrado...
            </div>";
  }

 ?>
