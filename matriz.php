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
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title>Matriz de trazabilidad de requerimientos</title>
</head>
<body>
    <div class="nav">
        <div class="nav_container">
            <h4>Matriz de trazabilidad de requerimientos</h4>
            <h4 class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Hola, <?php echo $_SESSION["nombre"] ?></h4>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php">Mis proyectos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="controller/cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>

    <table class="description table table-hover table-bordered">
        <thead>
            <?php include "model/conexion.php";  ?>
            <?php include "controller/datos_proyecto.php"; ?>
            <?php
            if($sql->rowCount() > 0) { 
                foreach($datos as $dato) { ?>
                    <tr>
                        <th class="table-info text-center align-middle" width="130px" rowspan="2">PROYECTO</th>
                        <th class="table-info" width="100px">NOMBRE</th>
                        <th width="500px"><?php echo $dato->NombreProyecto;?></th>
                    </tr>
                    <tr>
                        <th class="table-info" width="100px">INICIO</th>
                        <th width="500px"><?php echo $dato->InicioProyecto;?></th>
                    </tr>
                <?php }
            } ?>
        </thead> 
    </table>
       
    <div class="section">
        <div class="description-action">
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requerimientoModal">
                Nuevo Requerimiento
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="requerimientoModal" tabindex="-1" aria-labelledby="requerimientoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="requerimientoModalLabel">Nuevo Requerimiento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="controller/registrar_requerimiento.php" method="post">
                            <div class="modal-body container">
                                <input type="hidden" name="IdProyecto" id="IdProyecto" value="<?php echo $_GET["id"];?>">

                                <div class="mt-2 mb-3 row">
                                    <label for="inputText" class=" col-form-label col-sm-3">Código</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="inputText" 
                                        pattern="RF\d{3}" title="La funcionalidad debe tener una 'RF' seguida de tres dígitos"
                                        name="CodigoRequerimiento" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputText" class=" col-form-label col-sm-3">Funcionalidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputText" 
                                        pattern="[A-ZÁÉÍÓÚ][a-zA-ZÁÉÍÓÚáéíóú\s]*" title="La descripción debe empezar con mayúscula y solo puede contener letras"
                                        name="NombreRequerimiento" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputText" class=" col-form-label col-sm-3">Descripción</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px" aria-label="With textarea" 
                                        pattern="[A-ZÁÉÍÓÚ][a-zA-ZÁÉÍÓÚáéíóú\s]*" title="La descripción debe empezar con mayúscula y solo puede contener letras"
                                        name="DescripcionRequerimiento" required></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputText" class=" col-form-label col-sm-3">Prioridad</label>
                                    <div class="col-sm-4">
                                        <select class="form-select" aria-label="Default select example" name="PrioridadRequerimiento">
                                            <option value="Alta">Alta</option>
                                            <option value="Media" selected>Media</option>
                                            <option value="Baja">Baja</option>
                                        </select>
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
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#iteracionModal">
                Nueva Iteración
                </button>

                <!-- Modal -->
                <div class="modal fade" id="iteracionModal" tabindex="-1" aria-labelledby="iteracionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="iteracionModalLabel">Nueva Iteración</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="controller/registrar_iteracion.php" method="post">
                                <div class="modal-body container">
                                    <input type="hidden" name="IdProyecto" id="IdProyecto" value="<?php echo $_GET["id"];?>">
                                    <div class="mt-2 mb-3 row">
                                        <label for="inputText" class=" col-form-label col-sm-3">Iteración</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="number" type="number" min="1" name="NumeroIteracion" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputText" class=" col-form-label col-sm-3">Fecha</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="date"  min="2023-01-01" name="FechaIteracion" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputText" class=" col-form-label col-sm-3">Etapa</label>
                                        <div class="col-sm-5">
                                            <select class="form-select" aria-label="Default select example" name="EtapaRevision">
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {?>
                                                <option value="<?= "Revision".$i ?>"><?php echo "Revisión " . $i ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Requerimiento</label>
                                        <select class="form-select" aria-label="Default select example" name="IdRequerimiento">
                                            <?php 
                                                include "controller/listar_requerimientos.php";
                                                if($sql->rowCount() > 0) { 
                                                    foreach($datos as $dato) { ?>
                                                        <option value="<?php echo $dato->IdRequerimiento;?>"><?php echo $dato->NombreRequerimiento;?></option>
                                                    <?php }
                                                } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputText" class=" col-form-label col-sm-3">Realizado</label>
                                        <div class="col-sm-5 d-flex gap-3 align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Si" id="flexRadioDefault1" name="EstadoRequerimiento">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                Si
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="No" id="flexRadioDefault2" name="EstadoRequerimiento" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                                </label>
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
            </div>

        </div>
        <select class="input-group-text" id="lista1">
        <?php 
            include "controller/listar_iteraciones.php";
            if($sql->rowCount() > 0) { 
                foreach($datos as $dato) { ?>
                    <option value="<?php echo $dato->NumeroIteracionRevision1 ?>"><?php echo "Iteración ". $dato->NumeroIteracionRevision1 ?></option>
            <?php }
            }else{ ?>
                <option value="1">Sin iteraciones</option> <?php
            } ?>
        </select>

    </div>
    
    <div class="container">
        <div class="table table-responsive mt-5">
            <table class="table table-hover table-bordered">
                <thead class="text-center">
                    <tr>
                        <th class="table-primary" colspan="5" >Requerimiento</th>
                        <th class="table-primary" colspan="12">Fases</th>
                    </tr>
                    <tr>

                        <th class="table-info align-middle" rowspan="2">Código</th>
                        <th class="table-info align-middle" rowspan="2">Prioridad</th>
                        <th class="table-info align-middle" rowspan="2">Funcionalidad</th>
                        <th class="table-info align-middle" rowspan="2">Avance</th>
                        <th class="table-info" colspan="4" rowspan="1">Elaboración</th>
                        <th class="table-info" colspan="4" rowspan="1">Construcción</th>
                        <th class="table-info" colspan="4" rowspan="1">Transición</th>
                    </tr>
                    <tr>
                        <th class="table-info" rowspan="1" colspan="1">R1</th>
                        <th class="table-info" rowspan="1" colspan="1">R2</th>
                        <th class="table-info" rowspan="1" colspan="1">R3</th>
                        <th class="table-info" rowspan="1" colspan="1">R4</th>
                        <th class="table-info" rowspan="1" colspan="1">R5</th>
                        <th class="table-info" rowspan="1" colspan="1">R6</th>
                        <th class="table-info" rowspan="1" colspan="1">R7</th>
                        <th class="table-info" rowspan="1" colspan="1">R8</th>
                        <th class="table-info" rowspan="1" colspan="1">R9</th>
                        <th class="table-info" rowspan="1" colspan="1">R10</th>
                        <th class="table-info" rowspan="1" colspan="1">R11</th>
                        <th class="table-info" rowspan="1" colspan="1">R12</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="select2tabla">	

			    </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		//$('#listaiteraciones').val(1);
		recargarLista();

		$('#lista1').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"datos.php?id=<?php echo $_GET["id"];?>",
			data:" iteracion=" + $('#lista1').val(),
			success:function(r){
				$('#select2tabla').html(r);
			}
		});
	}
</script>