<?php
    $IdProyecto = $_GET['id'];
    $sql = $conexion->prepare("select*from proyecto where IdProyecto='$IdProyecto';");
    $sql->execute();
    $datos = $sql->fetchAll(PDO::FETCH_OBJ);
?>