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
        <?php endif; ?>
        <form action="<?= constant('__baseurl__') ?>home/submit_sections" method="POST" enctype="multipart/form-data">
            <div class="container-fluid py-4">
                <div class="d-flex justify-content-around desktop-to-mobile" style="left: 0;right: 0;top: 20px;">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Año</label>
                            <select class="form-control" id="select-grade">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->grades as $grade): ?>
                                    <option value="<?= $grade['id'] ?>"><?= $grade['grades'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Sección</label>
                            <select class="form-control" id="select-section">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->sections as $section): ?>
                                    <option value="<?= $section['id'] ?>"><?= $section['sections'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Mención</label>
                            <select class="form-control" id="select-mention">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($this->mentions as $mention): ?>
                                    <option value="<?= $mention['id'] ?>"><?= $mention['mentions'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row pb-8 z-index-2">
                    <div class="d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-header pb-0 bg-primary opacity-8 mb-2 text-center">
                                <h6 class="text-white">Alumnos en el Aula</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">

                                <div class="d-none d-md-flex d-lg-flex d-xl-flex table-responsive p-0 desktop-to-mobile">
                                    <table class="table align-items-center" id="results">
                                        <thead>
                                            <tr>
                                                <th style="width: 300px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                                <th style="width: 300px;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cedula</th>
                                            </tr>
                                        </thead>
                                        <tbody id="results-body-desktop">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="d-flex justify-content-center">
                        <div class="col-12 col-sm-4 d-grid px-2">
                            <button class="btn btn-danger" type="submit">Eliminar Aula</button>
                        </div>
                    </div> -->

                </div>

                <?php require constant("__layout__") . "footer.php"; ?>
            </div>
        </form>
    </main>

    <?php require constant("__layout__") . "scripts.php"; ?>

</body>

</html>