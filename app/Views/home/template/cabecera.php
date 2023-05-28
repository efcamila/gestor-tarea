<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestor de tareas</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('styles/style.css') ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/e1941971c2.js" crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url('/home/tareas') ?>">Teamplanner</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo base_url('/home/tareas') ?>">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/home/archivado')?>">Archivadas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('/logout') ?>">Salir</a>
              </li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
</nav>