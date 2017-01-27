<?php
//session_start();
class Persona
{
	public $numero;
	public $empresa;
	public $monto;
	public $fecha;
	public $grupo;
	
	/*function __construct($nombre, $edad, $cargo, $sexo, $liberado)
	{
		$this->nombre=$nombre;
		$this->edad=$edad;
		$this->cargo=$cargo;	
		$this->sexo=$sexo;	
		$this->liberado=$liberado;			
	}*/
public static function AsignarRuta($codigo)
{
	if ($codigo==1)
	{
		$ruta="empresas/edesur.txt";
	}
	elseif ($codigo==2)
	{
		$ruta="empresas/metrogas.txt";
	}
	elseif ($codigo==3)
	{
		$ruta="empresas/telecomunicaciones.txt";
	}
	return $ruta;
}


public static function Guardar($numero,$empresa, $monto, $fecha, $grupo)
{
	//var_dump($_SESSION);
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("
		INSERT into 
		empresas (numero, empresa, grupo, fecha, monto, operador)
		values(:numero, :empresa, :grupo, :fecha, :monto, :operador)"
		);
	$consulta->bindValue(':numero',$numero, PDO::PARAM_STR);
	$consulta->bindValue(':empresa',$empresa, PDO::PARAM_STR);
	$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
	$consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
	$consulta->bindValue(':monto',$monto, PDO::PARAM_STR);	
	$consulta->bindValue(':operador',$_SESSION['usuario'], PDO::PARAM_STR);
	$consulta->execute();
}

public static function LeerPersonas($codigo, $anio)
{
	
	if ($codigo!=0)
	{
		$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas where grupo = :grupo and fecha like '%$anio%' ORDER BY empresa ");
		$consulta->bindValue(':grupo',$codigo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Accion  </th>	
						<th>  Dias impagos  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				$tiempo=round((strtotime('now') - strtotime($personaAux->fecha))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->fecha."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>
							<td><input type='button' class='round medium green button' value='Cobrada' id='btnEliminar' onclick='Eliminar($personaAux->id)'/>
							
							<input type='button' class='round medium orange button' value='Eliminar' id='btnModificar' onclick='EliminarDefinitivo($personaAux->id)' /></td>

							<td>".$tiempo."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
	}

	//////////////////////////////////////TODAS LAS EMPRESAS////////////////////////////////////
	else
	{
		$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas WHERE fecha like '%$anio%' ORDER By empresa");
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha   </th>	
						<th>  Monto Liquidacion  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->fecha."</td>
							<td>$ ".$personaAux->monto."</td>
						</tr>";
			}
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".$total."</td>";	
		$tabla.= "</table>";
	}
	//////////////////////////////////////////////////////////////////////////
	return $tabla;
}

public static function LeerPersonasTodos($grupo, $anio)
{
if ($grupo=="todos")
{
			$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas WHERE fecha like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Accion  </th>	
						<th>  Dias impagos  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				$tiempo=round((strtotime('now') - strtotime($personaAux->fecha))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->fecha."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>
							<td><input type='button' class='round medium green button' value='Cobrada' id='btnEliminar' onclick='Eliminar($personaAux->id)'/>
							
							<input type='button' class='round medium orange button' value='Eliminar' id='btnModificar' onclick='EliminarDefinitivo($personaAux->id)' /></td>

							<td>".$tiempo."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
}
else
{
			$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas where empresa = :grupo and fecha like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Accion  </th>	
						<th>  Dias impagos  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				$tiempo=round((strtotime('now') - strtotime($personaAux->fecha))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->fecha."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>
							<td><input type='button' class='round medium green button' value='Cobrada' id='btnEliminar' onclick='Eliminar($personaAux->id)'/>
							
							<input type='button' class='round medium orange button' value='Eliminar' id='btnModificar' onclick='EliminarDefinitivo($personaAux->id)' /></td>

							<td>".$tiempo."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
}
		


	return $tabla;
}

public static function LeerPersonasTodosAdmin($grupo, $anio)
{
if ($grupo=="todos")
{
			$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas WHERE fecha like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Dias impagos  </th>	
						<th>  Operador  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				$tiempo=round((strtotime('now') - strtotime($personaAux->fecha))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->fecha."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>
							
							<td>".$tiempo."</td>
							<td>".$personaAux->operador."</td>
						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
}


	return $tabla;
}

public static function archivados($grupo, $anio)
{
	if ($grupo=="todos")
	{
				$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from historial WHERE ingreso like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Dias impagos  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				//var_dump($personaAux);
				$tiempo=round((strtotime('now') - strtotime($personaAux->ingreso))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->ingreso."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>

							<td>".$tiempo."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
	}
	else
	{
				$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from historial where empresa = :grupo and ingreso like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Dias impagos  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				//var_dump($personaAux);
				$tiempo=round((strtotime('now') - strtotime($personaAux->ingreso))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->ingreso."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>

							<td>".$tiempo."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
	}



	return $tabla;
}

public static function archivadosAdmin($grupo, $anio)
{
	if ($grupo=="todos")
	{
				$total=0;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from historial WHERE ingreso like '%$anio%' ORDER BY empresa");
		$consulta->bindValue(':grupo',$grupo, PDO::PARAM_STR);
		$consulta->execute();			
		$array= $consulta->fetchAll(PDO::FETCH_CLASS, "persona");	

		$tabla= "<table class='table table-hover table-responsive'>
				<thead>
					<tr>
						<th>  Numero   </th>
						<th>  Empresa   </th>
						<th>  Fecha Liquidacion   </th>	
						<th>  Monto Liquidacion  </th>
						<th>  Dias impagos  </th>
						<th>  Operador  </th>				
					</tr> 
				</thead>";   	

			foreach ($array as $personaAux)
			{
				//var_dump($personaAux);
				$tiempo=round((strtotime('now') - strtotime($personaAux->ingreso))/60/60/24);
				$total+=$personaAux->monto;
				$tabla.= " 	<tr>
							<td>".$personaAux->numero."</td>
							<td>".$personaAux->empresa."</td>
							<td>".$personaAux->ingreso."</td>
							<td>$ ".number_format($personaAux->monto, 2,',','.')."</td>

							<td>".$tiempo."</td>
							<td>".$personaAux->operador."</td>

						</tr>";
			}	
		$tabla.="<td> Total </td> <td></td>";
		$tabla.="<td>$ ".number_format($total, 2,',','.')."</td>";
		$tabla.= "</table>";
	}

	return $tabla;
}

public static function BorrarPersonas($ruta)
{
	if (file_exists($ruta))
	{
		unlink($ruta); 
	}
}

public static function Eliminar($indice)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas where id = :indice");
	$consulta->bindValue(':indice',$indice, PDO::PARAM_STR);
	$consulta->execute();
	$eliminado=$consulta->fetchAll(PDO::FETCH_CLASS, "persona");
	//var_dump($eliminado);

	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("
	INSERT into
	historial (numero, empresa, ingreso, monto, operador) 
	values (:numero, :empresa, :ingreso, :monto, :operador)");
	$consulta->bindValue(':numero',$eliminado[0]->numero, PDO::PARAM_STR);
	$consulta->bindValue(':empresa',$eliminado[0]->empresa, PDO::PARAM_STR);
	$consulta->bindValue(':ingreso',$eliminado[0]->fecha, PDO::PARAM_STR);
	$consulta->bindValue(':monto',$eliminado[0]->monto, PDO::PARAM_STR);
	$consulta->bindValue(':operador',$_SESSION['usuario'], PDO::PARAM_STR);
	$consulta->execute();

	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from empresas where id = :indice");
	$consulta->bindValue(':indice',$indice, PDO::PARAM_STR);
	$consulta->execute();
}

public static function EliminarDefinitivo($indice)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empresas where id = :indice");
	$consulta->bindValue(':indice',$indice, PDO::PARAM_STR);
	$consulta->execute();
	$eliminado=$consulta->fetchAll(PDO::FETCH_CLASS, "persona");
	//var_dump($eliminado);

	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("
	INSERT into
	eliminadas (numero, empresa, ingreso, monto, operador) 
	values (:numero, :empresa, :ingreso, :monto, :operador)");
	$consulta->bindValue(':numero',$eliminado[0]->numero, PDO::PARAM_STR);
	$consulta->bindValue(':empresa',$eliminado[0]->empresa, PDO::PARAM_STR);
	$consulta->bindValue(':ingreso',$eliminado[0]->fecha, PDO::PARAM_STR);
	$consulta->bindValue(':monto',$eliminado[0]->monto, PDO::PARAM_STR);
	$consulta->bindValue(':operador',$_SESSION['usuario'], PDO::PARAM_STR);
	$consulta->execute();

	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("DELETE from empresas where id = :indice");
	$consulta->bindValue(':indice',$indice, PDO::PARAM_STR);
	$consulta->execute();
}

 public static function TraerTodos($ruta)
 {
 	$lista=array();
	if (file_exists($ruta))
	{
		$file=fopen($ruta,"r");	
	}
	while (!(feof($file)))
	{
		$aux=fgets($file);
		$unaPersona=explode("-", $aux);
		$unaPersona[0]=trim($unaPersona[0]);
		if ($unaPersona[0]!="")
		{
			$lista[]=new Persona($unaPersona[0],$unaPersona[1],$unaPersona[2],$unaPersona[3],$unaPersona[4]);
		}
		
	}
	fclose($file);
	return $lista;
 }



}


?>