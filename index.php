<?php 
    session_start(); 
    if(empty($_SESSION["id"])){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Matriz de trazabilidad de requerimientos</title>
</head>
<body>
    <div class="nav">
        <div class="nav_container">
            <h4>Matriz de trazabilidad de requerimientos</h4>
            <h4 class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Hola, <?php echo $_SESSION["nombre"] ?></h4>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Nuevo Proyecto</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="controller/cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Proyecto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="controller/registrar_proyecto.php" method="post">
                    <div class="modal-body">
                        <div class="container">
                            
                            <input type="hidden" name="IdUsuario" value="<?php echo $_SESSION["id"]?>">
                            <div class="mt-2 mb-3 row">
                                <label for="inputText" class=" col-form-label col-sm-3">Proyecto</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height: 50px" name="NombreProyecto" 
                                    pattern="[A-ZÁÉÍÓÚ][a-zA-ZÁÉÍÓÚáéíóú\s]*" title="El nombre debe empezar con mayúscula y solo puede contener letras"
                                    aria-label="With textarea" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputText" class=" col-form-label col-sm-3">Código</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="CodigoProyecto" 
                                    pattern="P\d{3}" title="El código debe tener una 'P' seguida de tres dígitos"
                                    id="inputText" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputText" class=" col-form-label col-sm-3">Inicio</label>
                                <div class="col-sm-5">
                                    <input class="form-control" type="date" name="InicioProyecto"  min="2023-01-01" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" name="btnRegistrar">Guardar</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <div class="card_container">
        <?php
            include "model/conexion.php"; 
            include "controller/listar_proyectos.php";
                if($sql->rowCount() > 0) { 
                    foreach($datos as $dato) { ?>
                        <div class="card" style="width: 18rem;">
                            <img src="img/img.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                            <h5 class="card-title"><?php echo $dato->NombreProyecto;?></h5>
                            <p class="card-text">Proyecto creado el <?php echo $dato->InicioProyecto;?></p>
                            <a href="matriz.php?id=<?php echo $dato->IdProyecto?>" class="btn btn-primary">Ir al Proyecto</a>
                            </div>
                        </div> <?php
                    }
                }else{ ?>
                    <div class="card" style="width: 18rem;">
                        <img src="img/img.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Sistema de información #N</h5>
                            <p class="card-text">Proyecto creado el ##/##/####</p>
                            <a href="#" class="btn btn-primary">Ir al Proyecto</a>
                        </div>
                    </div> <?php
                } ?>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>