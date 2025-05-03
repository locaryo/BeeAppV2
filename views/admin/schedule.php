<?php
require constant("__layout__") . "header.php";
include __DIR__ . '/../../config/config.php';
?>

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
            <div class="card row mx-5 my-4">
                <div class="card-header pb-0">
                    <h6 class="text-center">Asignar Horario</h6>
                </div>
                <!-- row1 -->
                <div class="d-flex justify-content-evenly align-items-center desktop-to-mobile">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Dia:</span>
                            <select class="form-control" id="dia-asignar">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Hora-inicio:</span>
                            <input type="time" class="form-control" id="hora-inicio-asignar">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Hora-fin:</span>
                            <input type="time" class="form-control" id="hora-fin-asignar">
                        </div>
                    </div>
                </div>
                <!-- row2 -->
                <div class="d-flex justify-content-evenly align-items-center desktop-to-mobile">
                    <!-- Select de Docente -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Docente: </span>
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

                    <!-- Select de Materia -->
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-default">Materia: </span>
                            <select class="form-control" id="materia-asignar">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- row3 -->
                <div class="d-flex justify-content-center align-items-center desktop-to-mobile">
                    <button class="btn btn-primary" id="btn-asignar">Asignar</button>
                </div>
            </div>
            <!-- tabla de horario -->
            <div class="card table-responsive">
                <form class="px-2 py-1" method="post" action="<?= constant('__baseurl__') ?>home/submit_schedule">
                    <div class="card-header pb-0">
                        <h6 class="text-center">Tabla de Horario</h6>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Año: </span>
                                <select class="form-control" name="nivel">
                                    <?php foreach ($this->grades as $nivel): ?>
                                        <option value="<?= $nivel['grades'] ?>"><?= $nivel['grades'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Seccion: </span>
                                <select class="form-control" name="seccion">
                                    <?php foreach ($this->sections as $seccion): ?>
                                        <option value="<?= $seccion['sections'] ?>"><?= $seccion['sections'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Mencion: </span>
                                <select class="form-control" name="mencion">
                                    <?php foreach ($this->mentions as $mencion): ?>
                                        <option value="<?= $mencion['mentions'] ?>"><?= $mencion['mentions'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="tabla-horario">
                        <thead>
                            <tr>
                                <th class="text-center" style="border-width: 1px;">Horas</th>
                                <th class="text-center" style="border-width: 1px;">Lunes</th>
                                <th class="text-center" style="border-width: 1px;">Martes</th>
                                <th class="text-center" style="border-width: 1px;">Miercoles</th>
                                <th class="text-center" style="border-width: 1px;">Jueves</th>
                                <th class="text-center" style="border-width: 1px;">Viernes</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary" id="btn-asignar">Cargar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require constant("__layout__") . "scripts.php"; ?>

</body>

<script>
    const docentesMaterias = <?= json_encode($this->array) ?> ? <?= json_encode($this->array) ?> : [];
    document.addEventListener("DOMContentLoaded", function() {
        const selectDocente = document.getElementById("docente-asignar");
        const selectMateria = document.getElementById("materia-asignar");

        // Limpiar materias
        function limpiarMaterias() {
            selectMateria.innerHTML = '<option value="0">Seleccionar</option>';
        }

        // Evento al cambiar docente
        selectDocente.addEventListener("change", function() {
            const docenteId = this.value;
            limpiarMaterias();

            if (docenteId === "0") return;

            // Filtra las materias por docente
            const materias = docentesMaterias
                .filter(item => item.id == docenteId)
                .map(item => item.areas_formacion);

            // Evita duplicados
            const materiasUnicas = [...new Set(materias)];

            // Agrega al select
            materiasUnicas.forEach(materia => {
                const option = document.createElement("option");
                option.value = materia.toUpperCase();
                option.textContent = materia.toUpperCase();
                selectMateria.appendChild(option);
            });
        });
    });
</script>


</html>