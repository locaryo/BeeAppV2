<?php require constant("__layout__") . "header.php"; ?>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <?php require constant("__layout__") . "nav.php"; ?>

    <?php require constant("__layout__") . "aside.php"; ?>
    <main class="main-content position-relative border-radius-lg ">
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
            <!-- filtro -->
            <div class="card row mx-5 my-4">
                <div class="card-header pb-0">
                    <h6 class="text-center">Filtrar Secciones</h6>
                </div>
                <!-- row1 -->
                <div class="d-flex justify-content-around desktop-to-mobile">
                    <!-- Select de Docente -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Seccion: </span>
                            <select class="form-control" id="docente-asignar">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->horarios as $seccion): ?>
                                    <option value="<?= $seccion['seccion'] ?>">
                                    <?= $seccion['seccion'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nivel: </span>
                            <select class="form-control" id="docente-asignar">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->horarios as $nivel): ?>
                                    <option value="<?= $nivel['nivel'] ?>">
                                        <?= $nivel['nivel'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Meteria: </span>
                            <select class="form-control" id="docente-asignar">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->array as $docente): ?>
                                    <option value="<?= $docente['id'] ?>">
                                        <?= $docente['p_nombre'] . " " . $docente['p_apellido'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- row3 -->
                <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                    <button class="btn btn-primary" id="btn-asignar">Filtrar</button>
                </div>
            </div>

            <div class="card row">
                <div class="card-header pb-0">
                    <h6 class="text-center">Consultar Secciones</h6>
                </div>
                <!-- row1 -->
                <div class="d-flex justify-content-evenly align-items-center desktop-to-mobile">
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
                        <tbody id="results-body-desktop">

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </main>

    <?php require constant("__layout__") . "scripts.php"; ?>

</body>

</html>