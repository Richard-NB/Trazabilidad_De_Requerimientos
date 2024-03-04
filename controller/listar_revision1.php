<?php
    $IdProyecto = $_GET["id"];

    $sql = $conexion->prepare("select distinct usuario.IdUsuario, usuario.NombreUsuario, proyecto.NombreProyecto, 
    requerimiento.NombreRequerimiento, iteracion.EtapaRevision ,iteracion.NumeroIteracion  
    from iteracion
    INNER JOIN
    requerimiento ON iteracion.IdRequerimiento = requerimiento.IdRequerimiento
    INNER JOIN
    proyecto ON requerimiento.IdProyecto = proyecto.IdProyecto
    INNER JOIN
    usuario ON proyecto.IdUsuario = usuario.IdUsuario
    WHERE
    iteracion.EtapaRevision = 'Revisión 1' and proyecto.IdProyecto = '$IdProyecto';");
    $sql->execute();
    $datos = $sql->fetchAll(PDO::FETCH_OBJ);
?>