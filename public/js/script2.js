$(document).ready(function(){
	  Carga();
});

function Carga(){

	var tablaDatos = $("#datos");
	var route = "http://localhost:8000/generos";

		$("#datos").empty();
	$.get(route, function(res){
		$(res).each(function(key,value){
			tablaDatos.append("<tr><td>"+value.genre+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal'	>Editar</button><button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'>Eliminar</button></td></tr>");
		});
	});
}


function Eliminar(btn){
	var route = "http://localhost:8000/genero/"+btn.value+"";
	var token = $("#token").val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'DELETE',
		dataType: 'json',
		success: function(){ //se ejecuta cuando la accion es correcta
			Carga();
			$("#msj-success").fadeIn(); //envia el mensaje de muestra
		}
	});
}

function Mostrar(btn){
	var route = "http://localhost:8000/genero/"+btn.value+"/edit";

	$.get(route, function(res){
		$("#genre").val(res.genre);
		$("#id").val(res.id);
	});
}


$("#actualizar").click(function(){
	var value = $("#id").val();
	var dato = $("#genre").val();
	var route = "http://localhost:8000/genero/"+value+"";
	var token = $("#token").val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data: {genre: dato},
		success: function(){ //se ejecuta cuando la accion es correcta
			Carga();
			$("#myModal").modal('toggle'); //oculta el panel modal
			$("#msj-success").fadeIn(); //envia el mensaje de muestra
		}
	});
});