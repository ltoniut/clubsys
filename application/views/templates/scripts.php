	<!-- jQuery -->
	<script src="<?php echo base_url("assets/js/jquery-2.1.1.min.js"); ?>"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script>
	$(document).ready(function() {
		$('.success').hide();
		$('.danger').hide();
		<?php
		if($this->session->flashdata('msj_exito')) {
			echo "$('.success').html('"
				.$this->session->flashdata('msj_exito')
				."').show();";
		}
		if($this->session->flashdata('msj_error')) {
			echo "$('.error').html('"
				.$this->session->flashdata('error')
				."').show();";
		}
		?>

		$(<?php echo "'li > a[href=\"" . current_url() . "\"]'"; ?>).parent().addClass('active');
		
	});	
	</script>
