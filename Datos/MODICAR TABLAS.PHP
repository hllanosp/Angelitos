para cargar
  include '../../conexion/config.inc.php';
  $query  = $db->prepare("SELECT * FROM universidad inner join pais on pais.Id_pais=universidad.Id_pais");
  $query->execute();
  $result1 = $query->fetchAll();
  foreach($result1 as $row)

  para isertar