<?= $cabecera ?>

<div class="container">
    <div class="row justify-content-center">
        <h3>Editar subtarea</h3>
        <?php
        $url_creador = "actualizar/" . $subtarea[0]['id'];
        $url_responsable = "actualizarestado/" . $subtarea[0]['id'];
        ?>
        <form action="<?php if ($subtarea[0]['idCreador'] == session('id')) {
                            echo $url_creador;
                        } else if ($subtarea[0]['idResponsable'] == session('id')) {
                            echo $url_responsable;
                        } ?>" method="post" name="formSubtarea" class="col-sm col-md">

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción (*)</label>
                <?php if ($subtarea[0]['idCreador'] == session('id')) {
                    echo '<input type="text" class="form-control" id="descripcion" name="descripcion" value="' . $subtarea[0]["descripcion"] . '">';
                } else if ($subtarea[0]['idResponsable'] == session('id')) {
                    echo '<span class="form-control">' . $subtarea[0]["descripcion"] . '</span>';
                }
                ?>
                <?php echo '<p style="color:red">' . session('errors.descripcion') . '</p>' ?>

            </div>

            <div class="mb-3">
                <label for="responsable" class="form-label">Email del usuario responsable (*)</label>
                <?php if ($subtarea[0]['idCreador'] == session('id')) {
                    echo '<input type="text" class="form-control" id="responsable" name="responsable" value="' . $subtarea[0]['email'] . '">';
                } else if ($subtarea[0]['idResponsable'] == session('id')) {
                    echo '<span class="form-control">' . $subtarea[0]["email"] . '</span>';
                }
                ?>
                <?php echo '<p style="color:red">' . session('errors.responsable') . '</p>' ?>
            </div>

            <div class="mb-3">
                <label for="prioridad" class="form-label">Prioridad (opcional)</label>
                <?php if ($subtarea[0]['idCreador'] == session('id')) { ?>
                    <select class="form-select" id="prioridad" name="prioridad">
                        <option <?php if ($subtarea[0]['prioridad'] == 1) echo 'selected' ?> value="1">Baja</option>
                        <option <?php if ($subtarea[0]['prioridad'] == 2) echo 'selected' ?> value="2">Media</option>
                        <option <?php if ($subtarea[0]['prioridad'] == 3) echo 'selected' ?> value="3">Alta</option>
                    </select>
                <?php } else if ($subtarea[0]['idResponsable'] == session('id')) {
                    echo '<span class="form-control">' . $subtarea[0]["d_prioridad"] . '</span>';
                } ?>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado (*)</label>
                <select class="form-select" id="estado" name="estado">
                    <option <?php if ($subtarea[0]['estado'] == 1) echo 'selected' ?> value="1">Definida</option>
                    <option <?php if ($subtarea[0]['estado'] == 2) echo 'selected' ?> value="2">En proceso</option>
                    <option <?php if ($subtarea[0]['estado'] == 3) echo 'selected' ?> value="3">Finalizada</option>
                </select>
                <?php echo '<p style="color:red">' . session('errors.estado') . '</p>' ?>
            </div>

            <div class="mb-3">
                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento (opcional)</label>
                <?php if ($subtarea[0]['idCreador'] == session('id')) { ?>
                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value=<?= $subtarea[0]['fechaVencimiento'] ?>>
                <?php } else if ($subtarea[0]['idResponsable'] == session('id')) {
                    if ($subtarea[0]['fechaVencimiento'] != '0000-00-00') {
                        echo '<span class="form-control">' . $subtarea[0]["fechaVencimiento"] . '</span>';
                    } else {
                        echo '<span class="form-control">Sin fecha de vencimiento</span>';
                    }
                } ?>
            </div>

            <div class="mb-3">
                <label for="comentario" class="form-label">Comentario (opcional) </label>
                <input type="text" class="form-control" id="comentario" name="comentario" value="<?= $subtarea[0]['comentario'] ?>">
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>

    </div>
    </form>
</div>
</div>
<script src="<?php echo base_url('/js/selector-colores.js') ?>"></script>
</body>

</html>