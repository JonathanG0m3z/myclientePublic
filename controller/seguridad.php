<script src="../app/lib/js/funcionalert.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
	if ( !isset($_SESSION['usuario']) && !isset($_SESSION['permiso']))
	{
		echo "<script type='text/javascript'>
		alerta('Usted no se ha identificado','error','../');
		</script>";
	}

?>
