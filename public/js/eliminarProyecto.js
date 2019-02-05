$(document).ready(function(){
	$('#alert').hide();
	$('.btn-delete').click(function(e){
		e.preventDefault();
		if (!confirm("¿Esta seguro de eliminar?")) {
			return false;
		}
		var row = $(this).parents('tr');
		var form = $(this).parents('form');
		var urleliminar = form.attr('action');

		$('#alert').show();
		$.post(urleliminar,form.serialize(),function(result){
			row.fadeOut();
			$('#proyectos').html(result.total);
			$('#alert').html(result.mensaje);
		}).fail(function(error){
			$('#alert').html('Algo salio mal '+error);
		});
	});
});