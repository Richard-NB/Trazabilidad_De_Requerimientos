<?php

    include "./../model/conexion.php";

    if(isset($_POST["btnRegistrar"])){
        if(!empty($_POST["CodigoRequerimiento"]) and !empty($_POST["NombreRequerimiento"]) 
        and !empty($_POST["DescripcionRequerimiento"]) and !empty($_POST["PrioridadRequerimiento"])
        and !empty($_POST["IdProyecto"])){

            $IdProyecto = $_POST["IdProyecto"];
            $CodigoRequerimiento = $_POST["CodigoRequerimiento"];
            $NombreRequerimiento = $_POST["NombreRequerimiento"];
            $DescripcionRequerimiento = $_POST["DescripcionRequerimiento"];
            $PrioridadRequerimiento = $_POST["PrioridadRequerimiento"];

            $sql="INSERT INTO `requerimiento` (`CodigoRequerimiento`,`NombreRequerimiento`, `DescripcionRequerimiento`, `PrioridadRequerimiento`, `IdProyecto`) 
            VALUES (:CodigoRequerimiento, :NombreRequerimiento, :DescripcionRequerimiento, :PrioridadRequerimiento, :IdProyecto);";

            $sql= $conexion->prepare($sql);
            $sql->bindParam(':CodigoRequerimiento', $CodigoRequerimiento);
            $sql->bindParam(':NombreRequerimiento', $NombreRequerimiento);
            $sql->bindParam(':DescripcionRequerimiento', $DescripcionRequerimiento);
            $sql->bindParam(':PrioridadRequerimiento', $PrioridadRequerimiento);
            $sql->bindParam(':IdProyecto', $IdProyecto);
            $sql->execute();
        }
        header("location: ./../matriz.php?id=$IdProyecto");
    }else{
        echo "Error";
    }
?>