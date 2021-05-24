<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna = $_POST["comuna"];

 	$query = "SELECT Vehiculos.vid, Vehiculos.uid, Vehiculos.patente, Vehiculos.estado, Vehiculos.tipo FROM Comunas,Direcciones,Unidades,Vehiculos WHERE Comunas.nombre LIKE LOWER('%$comuna%') 
            AND Comunas.comid = Direcciones.comid AND Direcciones.dirid = Unidades.direccion AND Vehiculos.uid = Unidades.uid;";
	$result = $db -> prepare($query);
	$result -> execute();
	$vehiculos = $result -> fetchAll();
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
	foreach ($vehiculos as $vehiculo) {
  		echo "<tr> <td>$vehiculo[0]</td> <td>$vehiculo[1]</td> <td>$vehiculo[2]</td> <td>$vehiculo[3]</td> <td>$vehiculo[4]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
