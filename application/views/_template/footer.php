	<footer class="main-footer">
	<strong>Copyright &copy; <?php echo date("Y");?></strong> RPS V.1
	</footer>
</div>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/dist/js/bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/dist/js/moment.min.js"></script>

<!--<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<!-- datepicker -->
<script src="<?php echo base_url();?>assets/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/dist/js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/dist/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/dist/js/fastclick.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/dist/js/select2.full.min.js"></script>
<!-- CK Editor -->
<script src="<?php echo base_url();?>assets/dist/ckeditor/ckeditor.js"></script>
<!-- fancybox -->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/jquery.fancybox.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/dist/css/calendar/fullcalendar/main.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/css/calendar/fullcalendar-interaction/main.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/css/calendar/fullcalendar-daygrid/main.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/css/calendar/fullcalendar-timegrid/main.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/css/calendar/fullcalendar-bootstrap/main.min.js"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('.select2').select2();
		$('.tabel_list').DataTable();

	});
</script>
