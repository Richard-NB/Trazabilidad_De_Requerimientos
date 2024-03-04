<?php
    $IdProyecto = $_GET["id"];

    $sql = $conexion->prepare("select revision1.NumeroIteracionRevision1,proyecto.IdProyecto from Revision1
    inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision2.NumeroIteracionRevision2, proyecto.IdProyecto from Revision2
    inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision3.NumeroIteracionRevision3, proyecto.IdProyecto from Revision3
    inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision4.NumeroIteracionRevision4, proyecto.IdProyecto from Revision4
    inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision5.NumeroIteracionRevision5, proyecto.IdProyecto from Revision5
    inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision6.NumeroIteracionRevision6, proyecto.IdProyecto from Revision6
    inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision7.NumeroIteracionRevision7, proyecto.IdProyecto from Revision7
    inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision8.NumeroIteracionRevision8, proyecto.IdProyecto from Revision8
    inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision9.NumeroIteracionRevision9, proyecto.IdProyecto from Revision9
    inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision10.NumeroIteracionRevision10, proyecto.IdProyecto from Revision10
    inner join requerimiento on Revision10.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision11.NumeroIteracionRevision11, proyecto.IdProyecto from Revision11
    inner join requerimiento on Revision11.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto'
    UNION
    select revision12.NumeroIteracionRevision12, proyecto.IdProyecto from Revision12
    inner join requerimiento on Revision12.IdRequerimiento = requerimiento.IdRequerimiento
    inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
    where proyecto.IdProyecto = '$IdProyecto';");
    $sql->execute();
    $datos = $sql->fetchAll(PDO::FETCH_OBJ);
?>