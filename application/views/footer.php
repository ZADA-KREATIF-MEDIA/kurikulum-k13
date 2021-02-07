
        <!-- container-scroller -->
 
        
        <!-- main-panel ends -->
     <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/shared/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
        $('.inputSiswa').select2();
      } );
    </script>
  </body>
</html>