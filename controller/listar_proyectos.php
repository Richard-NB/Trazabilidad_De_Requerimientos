<?php

    $IdUsuario = $_SESSION["id"];

    $sql = $conexion->prepare("select*from proyecto where IdUsuario='$IdUsuario';");
    $sql->execute();
    $datos = $sql->fetchAll(PDO::FETCH_OBJ);
?>