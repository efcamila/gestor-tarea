<?= $cabecera ?>

<div class="container">
    <div class="row justify-content-center">
        <h3>Crear nueva subtarea</h3>
        <form action="validarsubtarea/<?= $id ?>" method="post" name="formSubtarea" class="col-sm col-md">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción (*)</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo old('descripcion') ?>">
                <?php echo '<p style="color:red">' . session('errors.descripcion') . '</p>' ?>
            </div>
            <div class="mb-3">
                <label for="responsable" class="form-label">Email del usuario responsable (*)</label>
                <div class="mb-3">
                    <input type="text" class="form-control" id="responsable" name="responsable" value="<?php echo old('responsable') ?>">
                    <?php echo '<p style="color:red">' . session('errors.responsable') . '</p>' ?>
                </div>
                <label for="prioridad" class="form-label">Prioridad (opcional)</label>
                <div class="mb-3">
                    <select class="form-select" id="prioridad" name="prioridad">
                        <option <?php if (old('prioridad') == 1) echo 'selected' ?> value="1">Baja</option>
                        <option <?php if (old('prioridad') == 2) echo 'selected' ?> value="2">Media</option>
                        <option <?php if (old('prioridad') == 3) echo 'selected' ?> value="3">Alta</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento (opcional)</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value=<?php echo old('fecha_vencimiento') ?>>
            </div>
            <div class="mb-3">
                <label for="comentario" class="form-label">Comentario (opcional) </label>
                <input type="text" class="form-control" id="comentario" name="comentario" value="<?php echo old('comentario') ?>">
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