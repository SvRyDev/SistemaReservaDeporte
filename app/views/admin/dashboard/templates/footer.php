<script>
  const base_url = "<?= APP_URL ?>";
</script>



<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
  <p>&copy; 2024 Sistema de Reserva de Deporte. Todos los derechos reservados.</p>
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->


<script src="<?= APP_URL ?>/public/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


<script src="<?= APP_URL ?>/public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= APP_URL ?>/public/assets/extra-libs/sparkline/sparkline.js"></script>



<!--ENLACES WEB - RECOMENDABLE INTEGRARLO DIRECTAMENTE
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 Wave Effects -->

<script src="<?= APP_URL ?>/public/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?= APP_URL ?>/public/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= APP_URL ?>/public/dist/js/custom.min.js"></script>


<!--Custom Validations -->



<script src="<?= APP_URL ?>/public/dist/js/validations/validations.js"></script>
<!--This page JavaScript -->
<!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->

<?php if (isset($data['module'])) {?>
<script src="<?= APP_URL ?>/public/dist/js/modules/<?= $data['module']?>Functions.js"></script>
<?php };?>

<?php
if ($data['module'] == 'reservations') {
  ?>
  <!-- Calendar -->
  <script src="<?= APP_URL ?>/public/assets/libs/fullcalendar-6.1.14/dist/index.global.min.js"></script>
  <script src="<?= APP_URL ?>/public/assets/libs/fullcalendar-6.1.14/dist/index.global.js"></script>
  <script src="<?= APP_URL ?>/public/dist/js/modules/fullCalendarconfig.js"></script>
  <?php
};
?>




<script src="<?= APP_URL ?>/public/assets/libs/moment/min/moment.min.js"></script>
<script src="<?= APP_URL ?>/public/dist/js/jquery.ui.touch-punch-improved.js"></script>
<script src="<?= APP_URL ?>/public/dist/js/jquery-ui.min.js"></script>
<!-- End Calendar -->


<script src="<?= APP_URL ?>/public/assets/libs/flot/excanvas.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot/jquery.flot.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot/jquery.flot.pie.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot/jquery.flot.time.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot/jquery.flot.stack.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="<?= APP_URL ?>/public/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?= APP_URL ?>/public/dist/js/pages/chart/chart-page-init.js"></script>

<script src="<?= APP_URL ?>/public/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?= APP_URL ?>/public/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?= APP_URL ?>/public/assets/extra-libs/DataTables/datatables.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.all.min.js"></script>

</body>

</html>