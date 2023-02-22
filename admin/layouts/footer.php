</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="">Gyan Car Workshop</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <!-- <b>Version</b> 3.1.0 -->
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="../assets/admin_lte3/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/admin_lte3/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../assets/admin_lte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../assets/admin_lte3/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../assets/admin_lte3/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../assets/admin_lte3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../assets/admin_lte3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../assets/admin_lte3/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../assets/admin_lte3/plugins/moment/moment.min.js"></script>
<script src="../assets/admin_lte3/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../assets/admin_lte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../assets/admin_lte3/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/admin_lte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/admin_lte3/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/admin_lte3/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/admin_lte3/dist/js/pages/dashboard.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>


<script src="../assets/admin_lte3/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/admin_lte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/admin_lte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/admin_lte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../assets/admin_lte3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/admin_lte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
        $(function () {
         
            $("#example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        

        $(document).ready(function() {
$('.fa-power-off').on("click", function(){
  
    var existclass = $('.logout-btn');
    if($('.logout-btn').css("display")=="block"){
        $('.logout-btn').css("display", "none");
    }
    else{
      $('.logout-btn').css("display", "block");
    }
});
});
</script>
<script>
    $('#example1').dataTable();
</script>

</body>
</html>