<?php
session_start();
require ("usuario.php");
require ("persona.php");
require ("./clases/AccesoDatos.php");

////////////INRGESO/////////////////
if (isset($_POST['boton'], $_POST['usuario'],$_POST['pass']))
{
	if ($_POST['boton']=="Ingresar")
	{
		$devolucion=usuario::login($_POST['usuario'], $_POST['pass']);

		if ($devolucion!=false)
		{
			$_SESSION['usuario']=$devolucion[0]['usuario'];
			$_SESSION['admin']=$devolucion[0]['admin'];			
			header("Location: derivacion.php");
		}
		else
		{
			header("Location: index.html");
		}

	}
	elseif ($_POST['boton']=="Crear Cuenta") 
	{
		Usuario::Guardar($_POST['usuario'],$_POST['pass']);
		header("Location: index.html");
	}
}
//////////////////DERIVACION/////////////////////////////
if ($_POST['boton']=="Ir")
{
			if ($_POST['grupo']=="edesur")
			{
				header("Location: edesur.php");
			}
			elseif ($_POST['grupo']=="metrogas")
			{
				header("Location: metrogas.php");
			}
			elseif ($_POST['grupo']=="telecomunicaciones")
			{
				header("Location: telecomunicaciones.php");
			}
			elseif ($_POST['grupo']=="aysa")
			{
				header("Location: aysa.php");
			}
			elseif ($_POST['grupo']=="todos")
			{
				header("Location: todos.php");
			}
			//var_dump($_POST);
}
////////////////////INRGESO///////////////////
if (isset($_POST['boton']))
{
	if ($_POST['boton']=="Agregar") 
	{
		//echo("agregaaaaa");
		persona::Guardar($_POST['numero'],$_POST['empresa'],$_POST['monto'],$_POST['fecha'], $_POST['grupo']);
	}

	else if ($_POST['boton']=="Mostrar") 
	{
		//echo("muestraaaa");
		echo(persona::LeerPersonas($_POST['grupo'], $_POST['anio'])) ;
	}

	else if ($_POST['boton']=="MostrarTodos") 
	{
		//echo("muestraaaa");
		echo(persona::LeerPersonasTodos($_POST['grupo'], $_POST['anio'])) ;
	}

	else if ($_POST['boton']=="archivados") 
	{
		//echo("muestraaaa");
		echo(persona::archivados($_POST['grupo'], $_POST['anio'])) ;
	}

	else if ($_POST['boton']=="archivadosAdmin") 
	{
		//echo("muestraaaa");
		echo(persona::archivadosAdmin($_POST['grupo'], $_POST['anio'])) ;
	}

	else if ($_POST['boton']=="impagasAdmin") 
	{
		//echo("muestraaaa");
		echo(persona::LeerPersonasTodosAdmin($_POST['grupo'], $_POST['anio'])) ;
	}
	else if ($_POST['boton']=="Modificar") 
	{
		//echo("muestraaaa");
		echo(persona::LeerPersonas()) ;
	}
	else if ($_POST['boton']=="salir")
	{
		session_unset();
		session_destroy();
		echo "salir";
	}

}

if (isset($_POST['borrar']))
{
	Persona::BorrarPersonas("personas.txt");
}

if (isset($_POST['Eliminar']))
{
	Persona::Eliminar($_POST['Eliminar']);
	//header("Location: paginadatos.php");
}

if (isset($_POST['EliminarDefinitivo']))
{
	Persona::EliminarDefinitivo($_POST['EliminarDefinitivo']);
	//header("Location: paginadatos.php");
}
?>