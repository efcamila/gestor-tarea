<?= $cabecera;?>
<title>Archivados</title>

<?php
foreach ($tareas as $tarea) {
?>
  <div class="container">
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-color" id="<?= $tarea['color'] ?>">
        </div>
        <div class="accordion-item-header">
          <?= $tarea['asunto'] ?>
        </div>
        <div class="accordion-item-body">

          <div class="accordion-item-body-content">
            <?= $tarea["descripcion"]; ?>
          </div>
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
                  if ($subtarea['idTarea'] == $tarea['id']) {
                    echo '
                        <tr>
                          <th scope="row">' . $subtarea['descripcion'] . '</th>
                          <td>' . $subtarea['nombre'] . " " . $subtarea['apellido'] . '</td>
                          <td>' . $subtarea['d_estado'] . '</td>
                          <td>
                        </tr>
                      </tbody>';
                  }
                }
                ?>
            </table>
          </div>
        </div>
        <div class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 15px">
          <?php
          if ($tarea['estado'] == 4) {
            echo '<div class="progress-bar" style="width: 100%;background-color:#74FF71"></div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
} ?>

<script src="<?php echo base_url('/js/acordeon.js') ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>