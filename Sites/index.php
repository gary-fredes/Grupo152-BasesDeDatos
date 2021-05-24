<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Pokemón </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre pokemones.</p>

  <br>

  <h3 align="center"> ¿Quieres conocer las direcciones de las unidades?</h3>

  <form align="center" action="consultas/consulta_direccion_unidades.php" method="post">
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Vehiculos de las unidades en la comuna</h3>

  <?php
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre FROM Comunas;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_vehiculos_unidades_en_comuna.php" method="post">
    Seleccinar una comuna:
    <select name="comuna">
      <?php
      
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Vehiculos que han realizado un despacho a cierta comuna durante cierto año</h3>

  <?php
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre FROM Comunas;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_vehiculos_comuna_año.php" method="post">
    Comuna:
    <select name="comuna">
      <?php
      
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>

    Año:
    <input type="number" name="año" min="1990" max="2030">
    <br/><br/>

    <input type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <br>

  <h3 align="center">Vehiculos de las unidades en la comuna</h3>

  <?php
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre FROM Comunas;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_vehiculos_unidades_en_comuna.php" method="post">
    Seleccinar una comuna:
    <select name="comuna">
      <?php
      
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
</html>
