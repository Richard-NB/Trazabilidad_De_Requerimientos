<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Matriz de trazabilidad de requerimientos</title>
</head>
<body class="fondo">
    <div class="form_login">
        <form action="" method="post">
            <h2 class="login_title">Acceso al sistema</h2>
            <div class="login_user">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput1" name="EmailUsuario" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput1" name="ContrasenaUsuario" placeholder="Contraseña" required>
            </div>
            <?php include "controller/iniciar_sesion.php" ?>
            <button type="submit" class="btn btn-primary form-control" name="btnIngresar">Acceder</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e02429dd15.js" crossorigin="anonymous"></script>
</body>
</html>