<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna = $_POST["comuna"];

 	$query = "SELECT Vehiculos FROM Comunas,Direcciones,Unidades,Vehiculos WHERE Comunas.nombre LIKE LOWER('%$comuna%') 
            AND Comunas.comid = Direcciones.comid AND Direcciones.dirid = Unidades.direccion AND Vehiculos.uid = Unidades.uid;";
	$result = $db -> prepare($query);
	$result -> execute();
	$direcciones = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>vid</th>
      <th>uid</th>
      <th>Patente</th>
      <th>Estado</th>
      <th>Tipo</th>
    </tr>
  <?php
	foreach ($direcciones as $direccion) {
  		echo "<tr> <td>$direccion[0]</td> <td>$direccion[1]</td> <td>$direccion[2]</td> <td>$direccion[3]</td> <td>$direccion[4]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
