<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna1 = $_POST["comuna1"];
    $comuna2 = $_POST["comuna2"];

 	$query = "SELECT Personal
            FROM Personal,Unidades,Unidades_Comunas,Comunas 
            WHERE Comunas.nombre LIKE LOWER('%$comuna1%')
            AND Comunas.comid = Unidades_Comunas.comid
            AND Unidades_Comunas.uid = Unidades.uid
            INTERSECT
            SELECT Personal
            FROM Personal,Unidades,Unidades_Comunas,Comunas 
            WHERE Comunas.nombre LIKE LOWER('%$comuna2%')
            AND Comunas.comid = Unidades_Comunas.comid
            AND Unidades_Comunas.uid = Unidades.uid 
            ;";
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
    echo "<h2> Jefes de unidades que realizan despachos a la comuna de  $comuna1 y $comuna2 </h2>";
	foreach ($jefes as $jefe) {
  		echo "<tr> <td>$despacho[0]</td> <td>$despacho[1]</td> <td>$despacho[2]</td> <td>$despacho[3]</td> <td>$despacho[4]</td> <td>$despacho[5]</td> <td>$despacho[6]</td></tr>";
	}
  ?>
	</table>
    </div>

<?php include('../templates/footer.html'); ?>