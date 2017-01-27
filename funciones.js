function tabla(cod)
{
	var f=$.ajax
	(
		{
			url:"nexoadministrador.php",
			type:"post",
			data:
			{
				boton:"Mostrar",
				anio:$("#anio").val(),
				grupo: cod,
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tablapersonas").html(algo);
		}
	);	
}

function tablaTodos(cod)
{
	var f=$.ajax
	(
		{
			url:"nexoadministrador.php",
			type:"post",
			data:
			{
				boton:"MostrarTodos",
				anio:$("#anio").val(),
				grupo: $("#grupo").val(),
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tablapersonas").html(algo);
		}
	);	
}
function archivados(cod)
{
	var f=$.ajax
	(
		{
			url:"nexoadministrador.php",
			type:"post",
			data:
			{
				boton:"archivados",
				anio:$("#anio").val(),
				grupo: $("#grupo").val(),
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tablapersonas").html(algo);
		}
	);	
}
function borrar()
{
	var f=$.ajax({
		url:"nexoadministrador.php",
		type:"post",
		data:{
			borrar:"true"
		}});
	f.done(function(r) {
		tabla();
		$("#tabla").html("");});	
}

function Eliminar(indice)
{
	var f=$.ajax({
		url:"nexoadministrador.php",
		type:"post",
		data:{
			Eliminar: indice
		}});
	
	f.done(function(r) {
		swal("Liquidacion archivada exitosamente", "", "success");
		tabla($("#subgrupo").val());
		$("#tabla").html("");});	
}

function EliminarDefinitivo(indice)
{
	var f=$.ajax({
		url:"nexoadministrador.php",
		type:"post",
		data:{
			EliminarDefinitivo: indice
		}});
	
	f.done(function(r) {
		swal("Liquidacion eliminada exitosamente", "", "success");
		tabla($("#subgrupo").val());
		$("#tabla").html("");});	
}
function agregar(grupo)
{
	var f=$.ajax({
		url:"nexoadministrador.php",
		type:"post",
		data:{
			boton: "Agregar",
			numero: $("#numero").val(),
			monto: $("#monto").val(),
			empresa: $("#empresa").val(),
			fecha: $("#fecha").val(),
			grupo: grupo,
		}});
	f.done(function(r) {
		tabla(grupo);
		swal("Liquidacion ingresada exitosamente", "", "success");
		$("#tabla").html("");});	
}

function Modificar(indice)
{
	var f=$.ajax({
		url:"nexoadministrador.php",
		type:"post",
		data:{
			Modificar: indice
		}});
	f.done(function(r) {
		tabla();
		$("#tabla").html("");});	
}

function salir()
{
	var f=$.ajax(
		{
			url: "nexoadministrador.php",
			type: "post",
			data:
			{
				boton: "salir"
			}

		}
	);
	f.done (function(salir)
		{
			if (salir=="salir")
			{
				window.location.href = "index.html";
			}

			
		});
}

function impagasAdmin()
{
	var f=$.ajax
	(
		{
			url:"nexoadministrador.php",
			type:"post",
			data:
			{
				boton:"impagasAdmin",
				anio:$("#anio").val(),
				grupo: $("#grupo").val(),
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tablapersonas").html(algo);
		}
	);	
}
function archivadosAdmin()
{
	var f=$.ajax
	(
		{
			url:"nexoadministrador.php",
			type:"post",
			data:
			{
				boton:"archivadosAdmin",
				anio:$("#anio").val(),
				grupo: $("#grupo").val(),
			}
		}
	);
	f.done
	(
		function(algo) 
		{
			$("#tablapersonas").html(algo);
		}
	);	
}