<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT Direcciones.nombre FROM Direcciones, Unidades WHERE Direcciones.dirid = Unidades.direccion;";
	$result = $db -> prepare($query);
	$result -> execute();
	$direcciones = $result -> fetchAll();
  ?>

	<div align="center">
	<table>
    <tr>
      <th>Direccion</th>
    </tr>
  <?php
	echo "<h2> Direcciones de todas las unidades presentes en la base de datos </h2>";
	foreach ($direcciones as $direccion) {
  		echo "<tr> <td>$direccion[0]</td> </tr>";
	}
  ?>
	</table>
    </div>

<?php include('../templates/footer.html'); ?>
