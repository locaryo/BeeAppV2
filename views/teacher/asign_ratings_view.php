<?php if (isset($_SESSION['message'])): ?>
    <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100%;">
        <div class="alert alert-primary text-center text-white" role="alert">
            <strong><?php echo $_SESSION['message']; ?></strong>
        </div>
    </div>
    <?php unset($_SESSION['message']); ?>

<?php endif; ?>
<div class="container-fluid py-2">
    <!-- filtro -->
    <div class="card row mx-1">
        <div class="card-header pb-0 bg-primary opacity-8 mb-2 text-center">
            <h6 class="text-white">Filtrar Aula</h6>
        </div>
        <form action="<?= constant('__baseurl__') ?>teacher/save_ratings" method="POST" enctype="multipart/form-data">
            <!-- row1 -->
            <div class="d-flex justify-content-around desktop-to-mobile">
                <!-- Select de Docente -->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">Seccion: </span>
                        <select class="form-control" id="seccion-asignar-docente" name="seccion">
                            <option value="0">Seleccionar</option>
                            <?php foreach ($this->secciones as $seccion): ?>
                                <option value="<?= $seccion ?>"><?= $seccion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nivel: </span>
                        <select class="form-control" id="nivel-asignar-docente" name="nivel">
                            <option value="0">Seleccionar</option>
                            <?php foreach ($this->niveles as $nivel): ?>
                                <option value="<?= $nivel ?>"><?= $nivel ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">Meteria: </span>
                        <select class="form-control" id="materia-asignar-docente" name="materia">
                            <option value="0">Seleccionar</option>
                            <?php foreach ($this->materias as $materia): ?>
                                <option value="<?= $materia ?>"><?= $materia ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- row3 -->
            <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                <button type="button" class="btn btn-primary" id="btn-asignar-docente">Filtrar</button>
            </div>

            <div class="card row">
                <div class="card-header pb-0 bg-primary opacity-8 mb-2 text-center">
                    <h6 class="text-white">Asignar Notas</h6>
                </div>
                <!-- row1 -->
                <div class="d-flex justify-content-evenly align-items-center overflow-auto desktop-to-mobile">
                    <table class="table align-items-center" id="results">
                        <thead>
                            <tr>
                                <th style="width: 400px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                <th style="width: 400px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notas</th>
                                <th style="width: 300px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody id="results-body-desktop-asignar">

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                <button type="submit" class="btn btn-primary">Cargar</button>
            </div>

        </form>

    </div>
</div>