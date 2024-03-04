<?php 
include "model/conexion.php";
$iteracion=$_POST['iteracion'];
$IdProyecto = $_GET["id"];
    
    if($iteracion == 1){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento, 
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision1 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
    
        $string='<tr>';
                    
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $IdRequerimiento = $dato->IdRequerimiento;
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $sql1 = $conexion->prepare("select requerimiento.IdRequerimiento, requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si'
                and requerimiento.IdRequerimiento = '$IdRequerimiento' 
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $r = $sql1->rowCount()/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td> <tr>';
                }
                
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
    
        echo $string.'</tr>';

    }elseif($iteracion == 2){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision2 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $IdRequerimiento = $dato->IdRequerimiento;
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento' 
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento' 
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td> <tr>';
                }
                
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 3){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision3 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $IdRequerimiento = $dato->IdRequerimiento;
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td> <tr>';
                }
                
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 4){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision4 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $IdRequerimiento = $dato->IdRequerimiento;
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 5){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision5 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()+$sql5->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registrados</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 6){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision6 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registrados</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 7){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision7 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registrados</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 8){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision8 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registrados</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 9){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8,
        revision9.FechaRevision9, Revision9.EstadoRequerimientoRevision9, Revision9.NumeroIteracionRevision9
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join Revision9 on requerimiento.IdRequerimiento = Revision9.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision9 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $sql9 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision9.EstadoRequerimientoRevision9
                from revision9
                inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision9.EstadoRequerimientoRevision9='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql9->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount()
                +$sql9->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision9 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision9 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision9 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registrados</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 10){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8,
        revision9.FechaRevision9, Revision9.EstadoRequerimientoRevision9, Revision9.NumeroIteracionRevision9,
        revision10.FechaRevision10, Revision10.EstadoRequerimientoRevision10, Revision10.NumeroIteracionRevision10
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join Revision9 on requerimiento.IdRequerimiento = Revision9.IdRequerimiento
        inner join Revision10 on requerimiento.IdRequerimiento = Revision10.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision10 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $sql9 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision9.EstadoRequerimientoRevision9
                from revision9
                inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision9.EstadoRequerimientoRevision9='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql9->execute();
                $sql10 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision10.EstadoRequerimientoRevision10
                from revision10
                inner join requerimiento on Revision10.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision10.EstadoRequerimientoRevision10='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql10->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount()
                +$sql9->rowCount()+$sql10->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision9 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision9 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision9 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision10 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision10 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision10 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 11){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8,
        revision9.FechaRevision9, Revision9.EstadoRequerimientoRevision9, Revision9.NumeroIteracionRevision9,
        revision10.FechaRevision10, Revision10.EstadoRequerimientoRevision10, Revision10.NumeroIteracionRevision10,
        revision11.FechaRevision11, Revision11.EstadoRequerimientoRevision11, Revision11.NumeroIteracionRevision11
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join Revision9 on requerimiento.IdRequerimiento = Revision9.IdRequerimiento
        inner join Revision10 on requerimiento.IdRequerimiento = Revision10.IdRequerimiento
        inner join Revision11 on requerimiento.IdRequerimiento = Revision11.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision11 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $sql9 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision9.EstadoRequerimientoRevision9
                from revision9
                inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision9.EstadoRequerimientoRevision9='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql9->execute();
                $sql10 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision10.EstadoRequerimientoRevision10
                from revision10
                inner join requerimiento on Revision10.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision10.EstadoRequerimientoRevision10='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql10->execute();
                $sql11 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision11.EstadoRequerimientoRevision11
                from revision11
                inner join requerimiento on Revision11.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision11.EstadoRequerimientoRevision11='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql11->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount()
                +$sql9->rowCount()+$sql10->rowCount()+$sql11->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision9 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision9 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision9 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision10 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision10 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision10 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision11 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision11 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision11 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }elseif($iteracion == 12){
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8,
        revision9.FechaRevision9, Revision9.EstadoRequerimientoRevision9, Revision9.NumeroIteracionRevision9,
        revision10.FechaRevision10, Revision10.EstadoRequerimientoRevision10, Revision10.NumeroIteracionRevision10,
        revision11.FechaRevision11, Revision11.EstadoRequerimientoRevision11, Revision11.NumeroIteracionRevision11,
        revision12.FechaRevision12, Revision12.EstadoRequerimientoRevision12, Revision12.NumeroIteracionRevision12
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join Revision9 on requerimiento.IdRequerimiento = Revision9.IdRequerimiento
        inner join Revision10 on requerimiento.IdRequerimiento = Revision10.IdRequerimiento
        inner join Revision11 on requerimiento.IdRequerimiento = Revision11.IdRequerimiento
        inner join Revision12 on requerimiento.IdRequerimiento = Revision12.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision12 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $sql9 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision9.EstadoRequerimientoRevision9
                from revision9
                inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision9.EstadoRequerimientoRevision9='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql9->execute();
                $sql10 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision10.EstadoRequerimientoRevision10
                from revision10
                inner join requerimiento on Revision10.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision10.EstadoRequerimientoRevision10='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql10->execute();
                $sql11 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision11.EstadoRequerimientoRevision11
                from revision11
                inner join requerimiento on Revision11.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision11.EstadoRequerimientoRevision11='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql11->execute();
                $sql12 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision12.EstadoRequerimientoRevision12
                from revision12
                inner join requerimiento on Revision12.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision12.EstadoRequerimientoRevision12='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql12->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount()
                +$sql9->rowCount()+$sql10->rowCount()+$sql11->rowCount()
                +$sql12->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision9 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision9 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision9 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision10 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision10 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision10 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision11 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision11 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision11 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision12 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision12 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision12 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }else{
        $sql = $conexion->prepare("select proyecto.IdProyecto, requerimiento.IdRequerimiento, requerimiento.CodigoRequerimiento, requerimiento.PrioridadRequerimiento,
        requerimiento.NombreRequerimiento,  
        revision1.FechaRevision1, Revision1.EstadoRequerimientoRevision1, Revision1.NumeroIteracionRevision1,
        revision2.FechaRevision2, Revision2.EstadoRequerimientoRevision2, Revision2.NumeroIteracionRevision2,
        revision3.FechaRevision3, Revision3.EstadoRequerimientoRevision3, Revision3.NumeroIteracionRevision3,
        revision4.FechaRevision4, Revision4.EstadoRequerimientoRevision4, Revision4.NumeroIteracionRevision4,
        revision5.FechaRevision5, Revision5.EstadoRequerimientoRevision5, Revision5.NumeroIteracionRevision5,
        revision6.FechaRevision6, Revision6.EstadoRequerimientoRevision6, Revision6.NumeroIteracionRevision6,
        revision7.FechaRevision7, Revision7.EstadoRequerimientoRevision7, Revision7.NumeroIteracionRevision7,
        revision8.FechaRevision8, Revision8.EstadoRequerimientoRevision8, Revision8.NumeroIteracionRevision8,
        revision9.FechaRevision9, Revision9.EstadoRequerimientoRevision9, Revision9.NumeroIteracionRevision9,
        revision10.FechaRevision10, Revision10.EstadoRequerimientoRevision10, Revision10.NumeroIteracionRevision10,
        revision11.FechaRevision11, Revision11.EstadoRequerimientoRevision11, Revision11.NumeroIteracionRevision11,
        revision12.FechaRevision12, Revision12.EstadoRequerimientoRevision12, Revision12.NumeroIteracionRevision12
        from requerimiento 
        inner join Revision1 on requerimiento.IdRequerimiento = Revision1.IdRequerimiento
        inner join Revision2 on requerimiento.IdRequerimiento = Revision2.IdRequerimiento
        inner join Revision3 on requerimiento.IdRequerimiento = Revision3.IdRequerimiento
        inner join Revision4 on requerimiento.IdRequerimiento = Revision4.IdRequerimiento
        inner join Revision5 on requerimiento.IdRequerimiento = Revision5.IdRequerimiento
        inner join Revision6 on requerimiento.IdRequerimiento = Revision6.IdRequerimiento
        inner join Revision7 on requerimiento.IdRequerimiento = Revision7.IdRequerimiento
        inner join Revision8 on requerimiento.IdRequerimiento = Revision8.IdRequerimiento
        inner join Revision9 on requerimiento.IdRequerimiento = Revision9.IdRequerimiento
        inner join Revision10 on requerimiento.IdRequerimiento = Revision10.IdRequerimiento
        inner join Revision11 on requerimiento.IdRequerimiento = Revision11.IdRequerimiento
        inner join Revision12 on requerimiento.IdRequerimiento = Revision12.IdRequerimiento
        inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
        inner join usuario on proyecto.IdUsuario = usuario.IdUsuario
        where NumeroIteracionRevision12 = '$iteracion'
        and proyecto.IdProyecto = '$IdProyecto';");
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_OBJ);
        $string='<tr>';
        if($sql->rowCount() > 0) { 
            foreach($datos as $dato) { 
                $string = $string.'<tr> <td class="text-center">'.$dato->CodigoRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->PrioridadRequerimiento .'</td> ';
                $string = $string.'<td class="text-center">'.$dato->NombreRequerimiento .'</td> ';
                $IdRequerimiento = $dato->IdRequerimiento;
                $sql1 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision1.EstadoRequerimientoRevision1
                from revision1
                inner join requerimiento on Revision1.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision1.EstadoRequerimientoRevision1='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql1->execute();
                $sql2 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision2.EstadoRequerimientoRevision2
                from revision2
                inner join requerimiento on Revision2.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision2.EstadoRequerimientoRevision2='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql2->execute();
                $sql3 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision3.EstadoRequerimientoRevision3
                from revision3
                inner join requerimiento on Revision3.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision3.EstadoRequerimientoRevision3='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql3->execute();
                $sql4 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision4.EstadoRequerimientoRevision4
                from revision4
                inner join requerimiento on Revision4.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision4.EstadoRequerimientoRevision4='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql4->execute();
                $sql5 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision5.EstadoRequerimientoRevision5
                from revision5
                inner join requerimiento on Revision5.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision5.EstadoRequerimientoRevision5='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql5->execute();
                $sql6 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision6.EstadoRequerimientoRevision6
                from revision6
                inner join requerimiento on Revision6.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision6.EstadoRequerimientoRevision6='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql6->execute();
                $sql7 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision7.EstadoRequerimientoRevision7
                from revision7
                inner join requerimiento on Revision7.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision7.EstadoRequerimientoRevision7='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql7->execute();
                $sql8 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision8.EstadoRequerimientoRevision8
                from revision8
                inner join requerimiento on Revision8.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision8.EstadoRequerimientoRevision8='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql8->execute();
                $sql9 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision9.EstadoRequerimientoRevision9
                from revision9
                inner join requerimiento on Revision9.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision9.EstadoRequerimientoRevision9='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql9->execute();
                $sql10 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision10.EstadoRequerimientoRevision10
                from revision10
                inner join requerimiento on Revision10.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision10.EstadoRequerimientoRevision10='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql10->execute();
                $sql11 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision11.EstadoRequerimientoRevision11
                from revision11
                inner join requerimiento on Revision11.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision11.EstadoRequerimientoRevision11='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql11->execute();
                $sql12 = $conexion->prepare("select requerimiento.NombreRequerimiento, revision12.EstadoRequerimientoRevision12
                from revision12
                inner join requerimiento on Revision12.IdRequerimiento = requerimiento.IdRequerimiento
                inner join proyecto on requerimiento.IdProyecto = proyecto.IdProyecto
                where revision12.EstadoRequerimientoRevision12='Si' 
                and requerimiento.IdRequerimiento = '$IdRequerimiento'
                and proyecto.IdProyecto = '$IdProyecto';");
                $sql12->execute();
                $r = ($sql1->rowCount()+$sql2->rowCount()+$sql3->rowCount()+$sql4->rowCount()
                +$sql5->rowCount()+$sql6->rowCount()+$sql7->rowCount()+$sql8->rowCount()
                +$sql9->rowCount()+$sql10->rowCount()+$sql11->rowCount()
                +$sql12->rowCount())/12*100;
                $string = $string.'<td class="text-center">'.number_format($r, 2).'% </td>';
                if($dato->EstadoRequerimientoRevision1 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision1 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision1 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision2 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision2 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision2 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision3 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision3 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision3 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision4 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision4 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision4 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision5 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision5 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision5 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision6 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision6 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision6 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision7 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision7 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision7 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision8 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision8 .'</td>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision8 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision9 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision9 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision9 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision10 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision10 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision10 .'</td> ';
                }
                if($dato->EstadoRequerimientoRevision11 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision11 .'</td> ';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision11 .'</td>';
                }
                if($dato->EstadoRequerimientoRevision12 == 'Si'){
                    $string = $string.'<td class="text-center table-success">'.$dato->FechaRevision12 .'</td> <tr>';
                }else{
                    $string = $string.'<td class="text-center">'.$dato->FechaRevision12 .'</td> <tr>';
                }
            } 
        }else{
            $string = $string.'<tr>
                <td colspan="17" class="text-center">No hay iteraciones registradas</td>
            </tr>';
        }
        echo $string.'</tr>';
    }
?>