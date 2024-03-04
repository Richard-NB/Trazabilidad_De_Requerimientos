<?php

    try{
        $conexion = new PDO("mysql:local=localhost;port=3306;dbname=trazabilidad4","root","");
        return $conexion;   
    }catch(Exception $e){
        print "Error de conexion: ". $e->getMessage()." <br/>";
    }

?>