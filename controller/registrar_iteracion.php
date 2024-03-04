<?php

    include "./../model/conexion.php";

    if(isset($_POST["btnRegistrar"])){
        if(!empty($_POST["NumeroIteracion"]) and !empty($_POST["FechaIteracion"]) 
        and !empty($_POST["EtapaRevision"]) and !empty($_POST["EstadoRequerimiento"])
        and !empty($_POST["IdRequerimiento"]) and !empty($_POST["IdProyecto"])){

            $IdProyecto = $_POST["IdProyecto"];
            $IdRequerimiento = $_POST["IdRequerimiento"];
            $NumeroIteracion = $_POST["NumeroIteracion"];
            $FechaIteracion = $_POST["FechaIteracion"];
            $EtapaRevision = $_POST["EtapaRevision"];
            $EstadoRequerimiento = $_POST["EstadoRequerimiento"];

            /*echo $IdProyecto.'<br/>';
            echo $IdRequerimiento.'<br/>';
            echo $NumeroIteracion.'<br/>';
            echo $FechaIteracion.'<br/>';
            echo $EtapaRevision.'<br/>';
            echo $EstadoRequerimiento.'<br/>';*/


            $sql="INSERT INTO `$EtapaRevision` (`NumeroIteracion$EtapaRevision`,`Fecha$EtapaRevision`, 
            `Nombre$EtapaRevision`, `EstadoRequerimiento$EtapaRevision`, `IdRequerimiento`) 
            VALUES (:NumeroIteracion$EtapaRevision, :Fecha$EtapaRevision, 
            :Nombre$EtapaRevision, :EstadoRequerimiento$EtapaRevision, :IdRequerimiento);";

            $sql= $conexion->prepare($sql);
            $sql->bindParam(':NumeroIteracion'.$EtapaRevision, $NumeroIteracion);
            $sql->bindParam(':Fecha'.$EtapaRevision, $FechaIteracion);
            $sql->bindParam(':Nombre'.$EtapaRevision, $EtapaRevision);
            $sql->bindParam(':EstadoRequerimiento'.$EtapaRevision, $EstadoRequerimiento);
            $sql->bindParam(':IdRequerimiento', $IdRequerimiento);
            $sql->execute();
        }else{
            echo "error";
        }
        header("location: ./../matriz.php?id=$IdProyecto");
    }else{
        echo "Error";
    }