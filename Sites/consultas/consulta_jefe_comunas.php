<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $comuna1 = $_POST["comuna1"];
    $comuna2 = $_POST["comuna2"];

 	$query = "SELECT Personal.pid, Personal.nombre, Personal.rut, Personal.sexo, Personal.edad, Unidades.uid
            FROM Personal,Unidades,Comunas_unidades,Comunas 
            WHERE Comunas.nombre LIKE LOWER('%$comuna1%')
            AND Comunas.comid = Comunas_unidades.comid
            AND Comunas_unidades.uid = Unidades.uid
            INTERSECT
            SELECT Personal.pid, Personal.nombre, Personal.rut, Personal.sexo, Personal.edad, Unidades.uid
            FROM Personal,Unidades,Comunas_unidades,Comunas 
            WHERE Comunas.nombre LIKE LOWER('%$comuna2%')
            AND Comunas.comid = Comunas_unidades.comid
            AND Comunas_unidades.uid = Unidades.uid
            ;";
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

    <div align='center'>
	<table>
    <tr>
      <th>pid</th>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Sexo</th>
      <th>Edad</th>
      <th>Unidad Jefatura</th>
    </tr>
  <?php
    echo "<h2> Jefes de unidades que realizan despachos a la comuna de  $comuna1 y $comuna2 </h2>";
	foreach ($jefes as $jefe) {
  		echo "<tr> <td>$jefe[0]</td> <td>$jefe[1]</td> <td>$jefe[2]</td> <td>$jefe[3]</td> <td>$jefe[4]</td> <td>$jefe[5]</td> <td>$jefe[6]</td></tr>";
	}
  ?>
	</table>
    </div>

<?php include('../templates/footer.html'); ?>