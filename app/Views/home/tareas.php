<?= $cabecera ?>
<div class="container">
  <div class="accordion">
    <div class="row">
      <div class="col">
        <a class="btn btn-crear" href="<?php echo base_url('home/tareas/nuevatarea') ?>">Crear nueva tarea</a>
      </div>
      <div class="col offset-md-6">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ordenar por <?= $orden ?>
          </button>
          <ul class="dropdown-menu">
            <form action="tareas" method="get" name="ordenar">
              <button class="dropdown-item" type="submit" name="orden" value="recientes">Tareas recientes</button>
              <button class="dropdown-item" type="submit" name="orden" value="primeras">Primeras tareas</button>
              <button class="dropdown-item" type="submit" name="orden" value="vencimiento">Cerca de vencimiento</button>
              <button class="dropdown-item" type="submit" name="orden" value="prioridad">Prioridad (Alta a Baja)</button>
            </form>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php foreach ($tareas as $tarea) { ?>
  <div class="container">
    <div class="accordion">
      <div class="accordion-item">

        <div class="accordion-color" id="<?= $tarea['color'] ?>"></div>

        <div class="accordion-item-header">
          <?= $tarea["asunto"]; ?>
          <a href="<?= base_url('home/tarea/' . $tarea['id']) ?>" class="btn btn-light right-3">Ver en detalle</a>
          <?php if ($tarea['idCreador'] == session('id')) { ?>
            <div class="dropdown right">
              <button class="btn-opcion" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis fa-lg"></i>
              </button>
              <ul class="dropdown-menu ">
                <?php if ($tarea['estado'] == 3 && $tarea['idCreador'] == session('id')) { ?>
                  <li><a class="btn-archivar dropdown-item" title="Archivar tarea" class="btn-borrar" href="<?= base_url('/home/tareas/archivar/' . $tarea['id']) ?>"><i class="fa-regular fa-folder-open"></i>Archivar</a></li>
                <?php } ?>
                <li><a title="Editar tarea" class=" dropdown-item" href="<?= base_url('/home/tareas/editar/' . $tarea['id']) ?>"><i class="fa-solid fa-pencil" style="color: #273d62;"></i>Editar</a></li>
                <li><a class="btn-borrar dropdown-item" title="Eliminar tarea" href="<?= base_url('/home/tareas/eliminar/' . $tarea['id']) ?>"><i class="fa-solid fa-x" alt="Eliminar"></i>Eliminar</a></li>
              </ul>
            </div>
          <?php } else if ($tarea['idUsuario'] == session('id')) { ?>
            <i title="Participas en esta tarea" class="fa-solid fa-people-group right"></i>
          <?php } ?>
        </div>

        <div class="accordion-item-body">
          <div class="accordion-item-body-content"><?= $tarea["descripcion"]; ?></div>
          <?php if ($tarea['idCreador'] == session('id') && $tarea['estado'] < 3) { ?>
            <a class="btn btn-small btn-crear mb-3" href="<?= base_url('home/subtareas/nuevasubtarea/' . $tarea['id']) ?>">Crear una subtarea</a>
          <?php } ?>

          <div class="accordion-table">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Subtareas</th>
                  <th scope="col">Responsable</th>
                  <th scope="col">Estado</th>
                  <th scope="col" colspan="2"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subtareas as $subtarea) {
                  if ($subtarea['idTarea'] == $tarea['id']) { ?>
                    <tr>
                      <th scope="row"><?= $subtarea['descripcion'] ?></th>
                      <td><?= $subtarea['nombre'] . " " . $subtarea['apellido'] ?></td>
                      <td><?= $subtarea['d_estado'] ?></td>
                    <?php }
                  if ($subtarea['idCreador'] == session('id') && $tarea['estado'] < 3 && $subtarea['estado'] < 3) { ?>
                      <td><a title="Eliminar subtarea" class="btn-borrar" href="<?= base_url('/home/tareas/eliminarsubtarea/' . $subtarea['id']) ?>"><i class="fa-solid fa-x"></i></a></td>
                      <td><a title="Editar subtarea" href="<?= base_url('/home/tareas/editarsubtarea/' . $subtarea['id']) ?>"><i class="fa-solid fa-pencil" style="color: #273d62;"></i></a></td>
                    <?php } else if ($subtarea['idResponsable'] == session('id') && $tarea['estado'] < 3 && $subtarea['estado'] < 3) { ?>
                      <td><a href="<?= base_url('/home/tareas/editarsubtarea/' . $subtarea['id']) ?>"><i class="fa-solid fa-pencil" style="color: #273d62;"></i></a></td>
                    <?php } ?>
                    </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
        </div>

        <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
          <?php
          if ($tarea['estado'] == 2) {
            echo '<div class="progress-bar" style="width: 50%;background-color:#FFFF71"></div>';
          }
          if ($tarea['estado'] == 3) {
            echo '<div class="progress-bar" style="width: 100%;background-color:#74FF71"></div>';
          } ?>
        </div>

      </div>
    </div>
  </div>
<?php } ?>

<script src="<?php echo base_url('/js/acordeon.js') ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script type="text/javascript">
  function confirmacion(e) {
    if (confirm("¿Estás seguro de eliminarlo? Una vez eliminado, no podrás recuperarlo.")) {
      return true;
    } else {
      e.preventDefault();
    }
  }
  let borrarLink = document.querySelectorAll(".btn-borrar");

  for (var i = 0; i < borrarLink.length; i++) {
    borrarLink[i].addEventListener('click', confirmacion);
  }

  function confirmacion_a(e) {
    if (confirm("¿Estás seguro de archivarlo? Una vez archivado, solo podrás verlo desde la pestaña 'Archivados'.")) {
      return true;
    } else {
      e.preventDefault();
    }
  }
  let archivar = document.querySelectorAll(".btn-archivar");

  for (var i = 0; i < archivar.length; i++) {
    archivar[i].addEventListener('click', confirmacion_a);
  }
</script>
</body>