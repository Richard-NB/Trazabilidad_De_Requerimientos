<?php

    include "model/conexion.php";

    session_start();

    if(isset($_POST["btnIngresar"])){
        if(!empty($_POST["EmailUsuario"]) and !empty($_POST["ContrasenaUsuario"])){

            $EmailUsuario = $_POST["EmailUsuario"];
            $ContrasenaUsuario = $_POST["ContrasenaUsuario"];

            $sql="select * from usuario where EmailUsuario='$EmailUsuario' and ContrasenaUsuario='$ContrasenaUsuario' ;";
            $sql= $conexion->prepare($sql);
            $sql->execute();

            if($datos = $sql->fetchAll(PDO::FETCH_OBJ)){
                if($sql->rowCount() > 0) { 
                    foreach($datos as $dato) {
                        $_SESSION["id"]= $dato->IdUsuario;
                        $_SESSION["nombre"]= $dato->NombreUsuario;
                        $_SESSION["email"]= $dato->EmailUsuario;
                        $_SESSION["clave"]= $dato->ContrasenaUsuario;
                    }
                }
                header("location: index.php");
            }else{
                echo "Credenciales incorrectas";
            }
            
        }else{
            echo "Complete los campos";
        }

    }
?>