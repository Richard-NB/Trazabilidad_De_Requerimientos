<?php

    $IdProyecto = $_GET["id"];

    $sql = $conexion->prepare("select*from requerimiento where IdProyecto='$IdProyecto';");
    $sql->execute();
    $datos = $sql->fetchAll(PDO::FETCH_OBJ);
?>