<?php

    include "./../model/conexion.php";

    if(isset($_POST["btnRegistrar"])){
        if(!empty($_POST["NombreProyecto"]) and !empty($_POST["CodigoProyecto"]) 
        and !empty($_POST["InicioProyecto"]) and !empty($_POST["IdUsuario"])){

            $IdUsuario = $_POST["IdUsuario"];
            $NombreProyecto = $_POST["NombreProyecto"];
            $CodigoProyecto = $_POST["CodigoProyecto"];
            $InicioProyecto = $_POST["InicioProyecto"];

            $sql="INSERT INTO `proyecto` (`CodigoProyecto`,`NombreProyecto`, `InicioProyecto`, `IdUsuario`) 
            VALUES (:CodigoProyecto, :NombreProyecto, :InicioProyecto, :IdUsuario);";

            $sql= $conexion->prepare($sql);
            $sql->bindParam(':CodigoProyecto', $CodigoProyecto);
            $sql->bindParam(':NombreProyecto', $NombreProyecto);
            $sql->bindParam(':InicioProyecto', $InicioProyecto);
            $sql->bindParam(':IdUsuario', $IdUsuario);
            $sql->execute();
        }
        header("location: ./../index.php");
    }else{
        echo "Error";
    }
?>