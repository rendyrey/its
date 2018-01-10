<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">E-</span>
							Learning ITS &copy; 2017
						</span>

						&nbsp; &nbsp;
						
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?=base_url()?>assets/js/jquery.2.1.1.min.js"></script>

		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<?=$this->load->view('x-editable_scripts')?>
		<!-- page specific plugin scripts -->
		<script src="<?=base_url()?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?=base_url()?>assets/js/dataTables.tableTools.min.js"></script>
		<script src="<?=base_url()?>assets/js/dataTables.colVis.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?=base_url()?>assets/js/moment.min.js"></script>
		<script src="<?=base_url()?>assets/js/fullcalendar.min.js"></script>
		

		<!-- ace scripts -->
		<script src="<?=base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace.min.js"></script>
<script type="text/javascript">
			
	$(document).ready(function() {
    $('#dynamic-table').DataTable();
} );
		$(document).ready(function() {
    $('#dynamic-table1').DataTable();
} );

	
	
		</script>
		<!-- inline scripts related to this page -->
		
		<script type="text/javascript">
			jQuery(function($) {
	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		 buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
	
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		});
})
		</script>
		<script src="<?=base_url()?>assets/tinymce/tinymce.min.js" type="text/javascript"></script>
		<script>tinymce.init({selector:'textarea'})</script>
	</body>
</html>
