$(document).ready(function(){
	$('#alert').hide();
	$('#btn-edit').click(function(e){
		e.preventDefault();
		if (!confirm("¿Esta seguro que deseas editar?")) {
			return false;
		}
		var form = $(this).parents('form');
		var urleditar = form.attr('action');

		$('#alert').show();
		$.post(urleditar,form.serialize(),function(result){
			$('#proyectos').html(result.total);
			$('#alert').html(result.mensaje);
			location.href ="http://app.test/registro";
		}).fail(function(){
			$('#alert').html('Algo salio mal');
		});
	});
});
