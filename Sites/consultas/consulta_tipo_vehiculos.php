<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

    $tipo = $_POST["tipo"];

 	$query = "SELECT Unidades.uid AS id, Direcciones.nombre AS direccion,
            Personal.nombre AS jefe, COUNT(Vehiculos) AS cuenta,
            FROM Unidades,Direcciones,Personal,Vehiculos
            WHERE Vehiculos.tipo LIKE LOWER('%$tipo%') 
            AND Vehiculos.uid = Unidades.uid
            AND Unidades.direccion = Direcciones.dirid
            AND Personal.pid = Unidades.jefe
            GROUP BY Unidades.uid, Direcciones.nombre, Personal.nombre;
            EXCEPT
            SELECT tabla1.id, tabla1.direccion, tabla1.jefe, tabla1.cuenta
            FROM (
            SELECT Unidades.uid AS id, Direcciones.nombre AS direccion,
            Personal.nombre AS jefe, COUNT(Vehiculos) AS cuenta,
            FROM Unidades,Direcciones,Personal,Vehiculos
            WHERE Vehiculos.tipo LIKE LOWER('%$tipo%') 
            AND Vehiculos.uid = Unidades.uid
            AND Unidades.direccion = Direcciones.dirid
            AND Personal.pid = Unidades.jefe
            GROUP BY Unidades.uid, Direcciones.nombre, Personal.nombre;
            ) AS tabla1,
            (
            SELECT Unidades.uid AS id, Direcciones.nombre AS direccion,
            Personal.nombre AS jefe, COUNT(Vehiculos) AS cuenta,
            FROM Unidades,Direcciones,Personal,Vehiculos
            WHERE Vehiculos.tipo LIKE LOWER('%$tipo%') 
            AND Vehiculos.uid = Unidades.uid
            AND Unidades.direccion = Direcciones.dirid
            AND Personal.pid = Unidades.jefe
            GROUP BY Unidades.uid, Direcciones.nombre, Personal.nombre;
            ) AS tabla2
            WHERE tabla1.cuenta < tabla2.cuenta";
	$result = $db -> prepare($query);
	$result -> execute();
	$unidades = $result -> fetchAll();
  ?>

    <div align='center'>
	<table>
    <tr>
      <th>uid</th>
      <th>Direccion</th>
      <th>Jefe</th>
      <th>Cuenta</th>
    </tr>
  <?php
    echo "<h2> Unidad con mas vehiculos de tipo $tipo </h2>";
	foreach ($unidades as $unidad) {
  		echo "<tr> <td>$unidad[0]</td> <td>$unidad[1]</td> <td>$unidad[2]</td> <td>$unidad[3]</td> </tr>";
	}
  ?>
	</table>
    </div>

<?php include('../templates/footer.html'); ?>
