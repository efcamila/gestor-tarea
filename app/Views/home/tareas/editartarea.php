<?= $cabecera ?>

<div class="container">
  <div class="row justify-content-center">
    <h3>Editar tarea</h3>
    <form action="actualizar/<?= $tarea['id'] ?>" method="post" name="formTarea" class="col-sm col-md col-lg">
      <div id="div-color" class="<?= $tarea['color'] ?>">
        <input id="color" type="hidden" name="color" value="<?= $tarea['color'] ?>">
      </div>
      <div class="container">
        <div class="row">
          <ul>
            <li class="color-item" id="white"></li>
            <li class="color-item" id="red"></li>
            <li class="color-item" id="green"></li>
            <li class="color-item" id="blue"></li>
            <li class="color-item" id="violet"></li>
            <li class="color-item" id="pink"></li>
          </ul>
        </div>
      </div>
      <div class="mb-3">
        <label for="asunto" class="form-label">Asunto (*)</label>
        <input type="text" class="form-control" id="asunto" name="asunto" value="<?= $tarea['asunto'] ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.asunto') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción (*)</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $tarea['descripcion'] ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.descripcion') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="prioridad" class="form-label">Prioridad (*)</label>
        <div class="mb-3">
          <select class="form-select" id="prioridad" name="prioridad">
            <option <?php if ($tarea['prioridad'] == 1) echo 'selected' ?> value="1">Baja</option>
            <option <?php if ($tarea['prioridad'] == 2) echo 'selected' ?> value="2">Media</option>
            <option <?php if ($tarea['prioridad'] == 3) echo 'selected' ?> value="3">Alta</option>
          </select>
          <?php echo '<p style="color:red">' . session('errors_tarea.prioridad') . '</p>' ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento (*)</label>
        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?= $tarea['fechaVencimiento'] ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.fecha_vencimiento') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="fecha_recordatorio" class="form-label">Fecha de recordatorio (opcional) </label>
        <input type="date" class="form-control" id="fecha_recordatorio" name="fecha_recordatorio" value="<?= $tarea['fechaRecordatorio'] ?>">
      </div>
      <input type="hidden" value="<?= $tarea['id'] ?>" name="id">
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url('/js/selector-colores.js') ?>"></script>
</body>

</html>