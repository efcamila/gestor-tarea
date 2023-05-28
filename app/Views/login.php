<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="m-0 vh-100 row justify-content-center aling-item-center">
    <div class="pt-5 col-xxl-6 col-lg-6 col-md-8 col-sm-12">
        <form method="post" action="<?php echo base_url('login/validar')?>">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="Esto es el ingreso del correo">
                <?php echo '<span style="color:red">'.session('errors.email').'</span>' ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php echo '<span style="color:red">'.session('errors.password').'</span>' ?>
            </div>
            <div class="mb-3">
            <?php if(session()->has('error_controller')){
                        echo "<span style='color:red'>".session()->getFlashdata('error_controller')."</span style='color:red'>";
                    }  ?>
            </div>
             <div class="mb-3">
            <button type="submit" class="btn btn-primary">Ingresar</button>
            <a class="btn btn-outline-primary" href="<?php echo base_url('/registro')?>">Registrarse</a>
             </div>
        </form>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>