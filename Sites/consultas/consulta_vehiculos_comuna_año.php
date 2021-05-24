<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["comuna"];
  $año = $_POST["año"];

 	$query = "SELECT Vehiculos.vid, Vehiculos.uid, Vehiculos.patente, Vehiculos.estado, Vehiculos.tipo FROM Comunas,Direcciones,Despachos,Vehiculos WHERE Comunas.nombre LIKE LOWER('%$comuna%') 
     AND Despachos.fecha BETWEEN '$año-01-01' AND '$año-12-31' AND Despachos.destino = Direcciones.dirid AND Direcciones.comid = Comunas.comid AND Vehiculos.vid = Despachos.vid;";
	$result = $db -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
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
	foreach ($pokemones as $pokemon) {
  		echo "<tr><td>$pokemon[0]</td><td>$pokemon[1]</td><td>$pokemon[2]</td><td>$pokemon[3]</td><td>$pokemon[4]</td><td>$pokemon[5]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
