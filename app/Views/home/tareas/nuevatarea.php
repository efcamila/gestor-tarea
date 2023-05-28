<?= $cabecera ?>

<div class="container">
  <div class="row justify-content-center">
    <h3>Crear nueva tarea</h3>
    <form action="validartarea" method="post" name="formTarea" class="col-sm col-md col-lg">
      <div id="div-color" class="<?php echo old('color') ?>">
        <input id="color" type="hidden" name="color" value="<?php echo old('color') ?>">
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
        <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo old('asunto') ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.asunto') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción (*)</label>
        <input type="text" class="form-control" id="descripcion" name="descripcionTarea" value="<?php echo old('descripcionTarea') ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.descripcionTarea') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="prioridad" class="form-label">Prioridad (*)</label>
        <div class="mb-3">
          <select class="form-select" id="prioridad" name="prioridad" value="<?php echo old('prioridad') ?>">
            <option <?php if (old('prioridad') == 1) echo 'selected' ?> value="1">Baja</option>
            <option <?php if (old('prioridad') == 2) echo 'selected' ?> value="2">Media</option>';}
            <option <?php if (old('prioridad') == 3) echo 'selected' ?> value="3">Alta</option>';}?>
          </select>
          <?php echo '<p style="color:red">' . session('errors_tarea.prioridad') . '</p>' ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento (*)</label>
        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo old('fecha_vencimiento') ?>">
        <?php echo '<p style="color:red">' . session('errors_tarea.fecha_vencimiento') . '</p>' ?>
      </div>
      <div class="mb-3">
        <label for="fecha_recordatorio" class="form-label">Fecha de recordatorio (opcional) </label>
        <input type="date" class="form-control" id="fecha_recordatorio" name="fecha_recordatorio" value="<?php echo old('fecha_recordatorio') ?>">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Crear</button>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url('/js/selector-colores.js') ?>"></script>
</body>

</html>