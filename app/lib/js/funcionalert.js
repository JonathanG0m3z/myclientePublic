function alerta(texto, icono, link) {
	Swal.fire({
		title: texto,
		icon: icono,
		showConfirmButton: false,
		position: 'top',
		timer: '1500',
		timerProgressBar: 'true',
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
		stopKeydownPropagation: true,
	});
	setTimeout(function () {
		window.location.replace(link);
	}, 1500);
}
//echo "alerta('Datos ingresados correctamente','success','clientes.php?idu=&user=');";
//echo "alerta('¡ERROR DE CONEXIÓN!','error','clientes.php?idu=&user=');";
//<script src="../app/lib/js/funcionalert.js"></script>
//<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>