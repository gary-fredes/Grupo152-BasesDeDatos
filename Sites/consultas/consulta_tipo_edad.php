<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo = $_POST["comuna"];
    $min = $_POST["min"];
    $max = $_POST["max"];

 	$query = "SELECT Despachos.did, Despachos.fecha, Despachos.origen, Direcciones.nombre, Despachos.id_compra, Vehiculos, Personal.nombre FROM Despachos,Personal,Direcciones,Comunas WHERE Comunas.nombre LIKE LOWER('%$comuna%') 
            AND Comunas.comid = Direcciones.comid AND Direcciones.dirid = Despachos.destino AND Personal.pid = Despachos.pid
            AND Personal.edad BETWEEN $min AND $max;";
	$result = $db -> prepare($query);
	$result -> execute();
	$despachos = $result -> fetchAll();
  ?>

    <div align='center'>
	<table>
    <tr>
      <th>did</th>
      <th>Fecha</th>
      <th>Origen</th>
      <th>Destino</th>
      <th>Id compra</th>
      <th>Vehiculo</th>
      <th>Repartidor</th>
    </tr>
  <?php
    echo "<h2> Despachos realizados a la comuna de $comuna por repartidores con edades entre $min y $max </h2>";
	foreach ($despachos as $despacho) {
  		echo "<tr> <td>$despacho[0]</td> <td>$despacho[1]</td> <td>$despacho[2]</td> <td>$despacho[3]</td> <td>$despacho[4]</td> <td>$despacho[5]</td> <td>$despacho[6]</td></tr>";
	}
  ?>
	</table>
    </div>

<?php include('../templates/footer.html'); ?>