<!--   Core JS Files   -->

<script src="<?= constant('__baseurl__') ?>public/js/core/popper.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/core/bootstrap.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/plugins/chartjs.min.js"></script>

<!-- Custom Scripts -->
<script src="<?= constant('__baseurl__') ?>public/js/argon-dashboard.min.js?v=2.0.4"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/custom.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/schedule.js"></script>
<!-- App Script (debe ir al final) -->
<script src="<?= constant('__baseurl__') ?>public/js/custom/accountingDashboard.js"></script>
<script src="<?= constant('__baseurl__') ?>public/js/custom/adminDashboard.js"></script>

<script>
  var accordion = document.querySelectorAll('.accordion-collapse')
  accordion.forEach(function(element) {
    var collapse = new bootstrap.Collapse(element, {
      toggle: false
    })
  });
</script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= constant('__baseurl__') ?>public/js/argon-dashboard.min.js?v=2.0.4"></script>

<script src="<?= constant('__baseurl__') ?>public/js/app.js"></script>

</body>

</html>