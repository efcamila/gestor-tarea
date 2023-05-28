<?= $cabecera ?>

<div class="container mt-4">
    <h2 class="mb-3"><?=$tarea[0]['asunto'] ?></h2>
   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Creador/a</th>
                <th scope="col">Email</th>
                <th scope="col">Estado</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Creada</th>
                <th scope="col">Vencimiento</th>
                <th scope="col">Recordatorio</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?=$tarea[0]['descripcion']?></td>
                    <td><?=$tarea[0]['nombre'].' '.$tarea[0]['apellido']?></td>
                    <td><?=$tarea[0]['email']?></td>
                    <td><?=$tarea[0]['e_d']?></td>
                    <td><?=$tarea[0]['p_d']?></td>
                    <td><?=$tarea[0]['fechaCreacion']?></td>
                    <td><?php if ($tarea[0]['fechaVencimiento'] == '0000-00-00') {
                            echo 'Sin vencimiento';
                        } else {
                            echo $tarea[0]['fechaVencimiento'];
                        } ?></td>
                    <td><?= $tarea[0]['fechaRecordatorio'] ?></td>
                </tr>
        </tbody>
    </table>

    <h4 class="mt-3 mb-3">Subtareas</h4>
   
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Responsable</th>
                <th scope="col">Email</th>
                <th scope="col">Estado</th>
                <th scope="col">Prioridad</th>
                <th scope="col">Creación</th>
                <th scope="col">Vencimiento</th>
                <th scope="col">Comentario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subtareas as $subtarea) { ?>
                <tr <?php if ($subtarea['estado'] == 3) echo 'class="table-success"' ?>>
                    <td><?= $subtarea['descripcion'] ?></td>
                    <td><?= $subtarea['nombre'] . ' ' . $subtarea['apellido'] ?></td>
                    <td><?= $subtarea['email'] ?></td>
                    <td><?= $subtarea['d_estado'] ?></td>
                    <td><?= $subtarea['d_prioridad'] ?></td>
                    <td><?= $subtarea['fechaCreacion'] ?></td>
                    <td><?php if ($subtarea['fechaVencimiento'] == '0000-00-00') {
                            echo 'Sin vencimiento';
                        } else {
                            echo $subtarea['fechaVencimiento'];
                        } ?></td>
                    <td><?= $subtarea['comentario'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>