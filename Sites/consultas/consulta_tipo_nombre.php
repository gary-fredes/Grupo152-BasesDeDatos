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

	<table>
    <tr>
      <th>Direccion</th>
    </tr>
  <?php
	foreach ($direcciones as $direccion) {
  		echo "<tr> <td>$direccion</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
