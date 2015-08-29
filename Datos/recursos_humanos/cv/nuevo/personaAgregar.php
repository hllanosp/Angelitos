<?php

include '../../../conexion/config.inc.php';

function limpiar($tags)
{
    $tags = strip_tags($tags);
    return $tags;
}

//Información Personal
if(isset($_POST['agregarPE'])){
    if (!empty($_POST['identidad']) and !empty($_POST['primerNombre']) and !empty($_POST['primerApellido']) and !empty($_POST['segundoApellido'])
        and !empty($_POST['direccion']) and !empty($_POST['email'])) {
        $identi = limpiar((string)$_POST['identidad']);
        $pNombre = limpiar((string)$_POST['primerNombre']);
        $sNombre = limpiar((string)$_POST['segundoNombre']);
        $pApellido = limpiar((string)$_POST['primerApellido']);
        $sApellido = limpiar((string)$_POST['segundoApellido']);
        $fNac = limpiar(date((string)$_POST['fecha']));
        $sexo = (string)$_POST['sexo'];
        $direc = limpiar((string)$_POST['direccion']);
        $email = limpiar((string)$_POST['email']);
        $estCivil = (string)$_POST['estCivil'];
        $nacionalidad = (string)$_POST['nacionalidad'];
        
        $date = date('Y-m-d');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($fNac < $date) {
                $pame = $db->prepare("INSERT INTO persona (N_identidad, Primer_nombre, Segundo_nombre, Primer_apellido,
                    Segundo_apellido, Fecha_nacimiento, Sexo, Direccion, Correo_electronico, Estado_Civil, Nacionalidad)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                if($pame -> execute(array($identi,$pNombre,$sApellido,$fNac,$sexo,$direc,$email,$estCivil,$nacionalidad))){
                    $mensaje = " ".$pNombre . " " . $pApellido . " ha sido agregado(a) con éxito!";
                    $codMensaje = 1;
                }else{
                    $mensaje = 'error al ingresar el registro o registro actualmente existente';
                    $codMensaje = 0;
                }
                $pame -> closeCursor();
            }else{
                $mensaje = 'Fecha incorrecta, datos no serán guardados!';
                $codMensaje = 0;
            }
        }else {
            $mensaje = 'Correo electrónico inválido, datos no serán guardados!';
            $codMensaje = 0;
        }
    }
}


//Idioma
if (isset($_POST['identi']) and isset($_POST['agregarIDI'])) {
    $identidad = $_POST['identi'];
    $idioma = $_POST['idioma'];
    $nivel = $_POST['nivel'];

    $pame = $db->prepare("SELECT ID_Idioma FROM idioma WHERE Idioma = ?");
    $pame -> execute(array($idioma));
    
    if ($rows = $pame->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($rows as $row) {
            $idIdioma = $row['ID_Idioma'];
        }
        $pame -> closeCursor();
        $pame = $db->prepare("INSERT INTO idioma_has_persona (Id, ID_Idioma, N_identidad, Nivel) VALUES (DEFAULT,?,?,?)");

        if($pame -> execute(array($idIdioma, $identidad, $nivel))){

            $mensaje = 'Idioma ha sido agregada con éxito!';
            $codMensaje = 1;

        }else{
            $mensaje = 'error al ingresar el registro de idioma';
            $codMensaje = 0;

        }
        $pame -> closeCursor();
    }
    $pame -> closeCursor();
}

//Formación Académica
if (isset($_POST['identi']) and isset($_POST['agregarFA'])) {
    $tipoE = $_POST['tipoEFA'];
    $nomTitulo = $_POST['tituloFA'];
    $idUni = $_POST['universidadFA'];
    $identidad = $_POST['identi'];
    
    $pame = $db->prepare("INSERT INTO estudios_academico (ID_Estudios_academico, Nombre_titulo,ID_Tipo_estudio, N_identidad, Id_universidad)
                    VALUES (DEFAULT,?,?,?,?)");
    if($pame -> execute(array($nomTitulo, $tipoE, $identidad, $idUni))){
        $mensaje = 'Formación Académica ha sido agregada con éxito!';
        $codMensaje = 1;
   }else{
        $mensaje = 'error al ingresar el registro de formacion academica ';
        $codMensaje = 0;
   }
   $pame -> closeCursor();
}

//Experiencia laboral
if (isset($_POST['agregarEL'])) {
    $nomEmp = $_POST['nombreEmpresa'];
    $tiempo = $_POST['tiempoLab'];
    $identi = $_POST['identi'];
    $cargo  = $_POST['cargoEL'];
    
    $pame = $db->prepare("INSERT INTO experiencia_laboral (ID_Experiencia_laboral, Nombre_empresa, Tiempo, N_identidad) VALUES (DEFAULT,?,?,?)");
    $pame -> execute(); 
    if($pame -> execute(array($nomEmp, $tiempo, $identi))){
        $pame -> closeCursor();
        $pame = $db->prepare("SELECT MAX(ID_Experiencia_laboral) AS id FROM experiencia_laboral");
        $pame -> execute();
        if ($rows = $pame->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($rows as $row) {
                $idEperiencia = trim($row[0]);
            }
            $pame -> closeCursor();
            $pame = $db->prepare("INSERT INTO `experiencia_laboral_has_cargo`(`ID_Experiencia_laboral`, `ID_cargo`) VALUES (?,?)");
            if($pame -> execute(array($idEperiencia,$cargo))){
                $codMensaje = 1;
            }else{
                $codMensaje = 0;
            }
        }else{
            $mensaje = 'error al ingresar el registro de experiencia laboral ';
            $codMensaje = 0;
        }
    }else{
        $mensaje = 'error al ingresar el registro de experiencia laboral ';
        $codMensaje = 0;
    }
    $pame -> closeCursor();
}

//Experiencia Académica
if (isset($_POST['agregarEA'])) {
    $nomInst = $_POST['nombreInst'];
    $tiempo = $_POST['tiempoAcad'];
    $identi = $_POST['identi'];
    $idClase = $_POST['clases'];
    
    $pame = $db->prepare("INSERT INTO experiencia_academica (ID_Experiencia_academica, Institucion, Tiempo, N_identidad)
                                    VALUES (DEFAULT,'$nomInst','$tiempo','$identi')");
   if($pame -> execute(array($nomInst,$tiempo,$identi))){
        $pame -> closeCursor();
        $pame = $db->prepare("SELECT MAX(ID_Experiencia_academica) AS id FROM experiencia_academica");
        $pame -> execute();
        if ($rows = $pame->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($rows as $row) {
                $idExAca = trim($row[0]);
            }
            echo "$idExAca";
            echo "$idClase";
            $pame -> closeCursor();
            $pame = $db->prepare("INSERT INTO `clases_has_experiencia_academica`(`ID_Clases`, `ID_Experiencia_academica`) VALUES (?,?)"); 
            if($pame -> execute(array($idClase,$idExAca))){
                $mensaje = 'Experiencia académica ha sido agregada con éxito!!';
                $codMensaje = 1;
            }else{
                $mensaje = 'error al ingresar el registro de experiencia academica 3';
                $codMensaje = 0;  
            }
        }else{
            $mensaje = 'error al ingresar el registro de experiencia academica 2';
            $codMensaje = 0;
        }
    }else{
        $mensaje = 'error al ingresar el registro de experiencia academica 1';
        $codMensaje = 0;
    }
    $pame -> closeCursor(); 
}


//numeros de telefono
if(isset($_POST['agregarTEL'])){
    if (!empty($_POST['identi']) and !empty($_POST['telef']) ) {
        $tipo = $_POST['tipo'];
        $telef = $_POST['telef'];
        $identi = $_POST['identi'];
        
        $pame = $db->prepare("INSERT INTO telefono (ID_Telefono, Tipo, Numero, N_identidad)
             VALUES (DEFAULT,?,?,?)");
        if($pame -> execute(array($tipo,$telef,$identi))){
            $mensaje = 'Teléfono ha sido agregado con éxito!';
            $codMensaje = 1;
        }else{
            $mensaje = 'error al ingresar el registro de numero telefonico';
            $codMensaje = 0;
        }
    }else{
        $mensaje = 'error al ingresar el registro de numero telefonico campos vacios o errores con servidor';
        $codMensaje = 0;
    }
}
?>
