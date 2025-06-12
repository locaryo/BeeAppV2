<?php if (isset($_SESSION['message'])): ?>
  <div class="d-flex justify-content-center" style="position: absolute;z-index: 1;width: 100%;">
    <div class="alert alert-primary text-center text-white" role="alert">
      <strong><?php echo $_SESSION['message']; ?></strong>
    </div>
  </div>
  <?php unset($_SESSION['message']); ?>
<?php endif ?>

<div class="container-fluid pt-5" data-vista='envioPago'>

  <div class="row">

    <form class="needs-validation" novalidate action="<?= constant('__baseurl__') ?>home/register_service_payment" method="post">

      <div class="card mb-4">

        <div class="card-header pb-0 bg-primary opacity-8 mb-2">
          <h6 class="text-white">Nueva Factura: Pago de Servicio</h6>
        </div>

        <!-- desktop -->
        <div class="row mx-1">
          <div class="form-group col-12 col-sm-6 col-md-4 px-2">
            <label for="example-text-input" class="form-label required">Tipo de Servicio</label>
            <select class="form-control" id="gasto-tipo" name="servicio" required>
              <option selected disabled value="">Seleccionar</option>
              <?php foreach ($this->income_source as $value): ?>
                <option nameValue="<?= $value['expenses'] ?>" value="<?= $value['id'] ?>" title="<?= $value['description'] ?>"><?= $value['expenses'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2 position-relative d-filtro d-none">
            <label for="example-text-input" class="form-label required">Filtrar Docente</label>
            <input class="form-control" type="text" id="filtrar-docente" name="filtro-docente" role="listbox" autocomplete="off" required>
            <datalist class="filterable-list p-1 overflow-y-auto rounded-0 rounded-bottom position-absolute bg-white border-bottom border-end border-start border-primary" id="personalList">
              <input list="" type="text" class="d-none" id="teacher-id" name="id-docente">
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2">
            <label for="example-text-input" class="form-label required">Monto</label>
            <input class="form-control" type="text" id="amount-bs" name="monto" placeholder="Monto en Bolivares" required>
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-amount d-none">
            <label for="example-text-input" class="form-control-label">Monto USD-BCV</label>
            <input class="form-control" type="text" id="amount-usd-bcv">
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2">
            <label for="example-text-input" class="form-label">Metodo de Pago</label>
            <select class="form-control" id="pago-tipo" name="metodo_pago">
              <?php foreach ($this->payment_mehtod as $value): ?>
                <option nameValue="<?= $value['payment_method'] ?>" value="<?= $value['id'] ?>"><?= $value['payment_method'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2 d-reference d-none">
            <label for="example-text-input" class="form-label required">Referencia</label>
            <input class="form-control" type="text" name="referencia" required>
          </div>

          <div class="form-group col-12 col-sm-6 col-md-4 px-2">
            <label for="example-text-input" class="form-label required">Fecha de Pago</label>
            <input class="form-control" type="date" name="fecha" required>
          </div>
          <div class="form-group col-12 col-sm-6 col-md-4 px-2">
            <label for="example-text-input" class="form-label">Nota</label>
            <input class="form-control" type="text" name="nota">
          </div>
        </div>
        <div class="col-auto">
          <p class="card-text px-3 mb-3"><span class="text-danger">(*)</span> Indica que el campo es obligatorio.</p>
        </div>
        <div class="row mx-1 justify-content-center mt-2">
          <div class="col-12 col-sm-4 d-grid px-2">
            <button class="btn btn-primary" type="send">Registrar</button>
          </div>
          <div class="col-12 col-sm-4 d-grid px-2">
            <button class="btn btn-secondary go-back" type="button">Regresar</button>
          </div>
        </div>

      </div>

    </form>

  </div>

</div>