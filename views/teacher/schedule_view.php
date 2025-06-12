<?php if (isset($_SESSION['message'])): ?>
    <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100%;">
        <div class="alert alert-primary text-center text-white" role="alert">
            <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php else: ?>

<?php endif; ?>
<div class="container-fluid py-2">
    <div class="card row">
        <div class="card-header pb-0 bg-primary opacity-8 mb-2 text-center">
            <h6 class="text-white">Horarios</h6>
        </div>
        <!-- row1 -->
        <div class="d-flex justify-content-evenly align-items-center overflow-auto desktop-to-mobile">
            <table class="table align-items-center" id="results">
                <thead>
                    <tr>
                        <th style="width: 400px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aula</th>
                        <th style="width: 400px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dia</th>
                        <th style="width: 300px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Horas</th>
                        <th style="width: 300px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Materias</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->horarios as $horario): ?>
                        <tr>
                            <td class="text-center text-uppercase text-sm font-weight-bold mb-0 text-xs"><?= $horario['nivel']; ?> - <?= $horario['seccion']; ?></td>
                            <td class="text-center text-uppercase text-sm font-weight-bold mb-0 text-xs"><?= $horario['dia_semana']; ?></td>
                            <td class="text-center text-sm font-weight-bold mb-0 text-xs"><?= $horario['hora_inicio']; ?> - <?= $horario['hora_fin']; ?></td>
                            <td class="text-center text-uppercase text-sm font-weight-bold mb-0 text-xs"><?= $horario['materia']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>