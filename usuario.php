<?php

class Usuario
{
	public $usuario;
	public $mail;
	public $pass;


	function __construct($usuario, $mail, $pass)
	{
		$this->usuario=$usuario;
		$this->mail=$mail;
		$this->pass=$pass;
	}
public static function login($usuario, $pass)
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				SELECT * 
				from usuarios 
				where usuario = :usuario 
				and 
				pass = :pass" 
				);
			$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
			$consulta->bindValue(':pass',$pass, PDO::PARAM_STR);
			$consulta->execute();
			$resultado = $consulta->fetchAll();

			$ingreso=date("Y-m-d H:i:s");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				INSERT INTO histlogin 
				(usuario, ingreso, pass)
				VALUES (:usuario, :ingreso, :pass) 
				");
			$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
			$consulta->bindValue(':pass',$pass, PDO::PARAM_STR);
			$consulta->bindValue(':ingreso',$ingreso, PDO::PARAM_STR);
			$consulta->execute();




			return $resultado;
	}
/////DE LA VERSION VIEJA GUARDAR LEER DE TXT//////////////////
public static function Guardar($usuario, $mail, $pass)
{
	$file=fopen("usuarios.txt","a");
	fwrite($file,$usuario.",".$mail.",".$pass."\n");
	fclose($file);
}

public static function Buscar($usuario, $pass)
{
	$todos = file("usuarios.txt", FILE_IGNORE_NEW_LINES + FILE_SKIP_EMPTY_LINES);
	//var_dump($todos);

	foreach ($todos as $uno)
	{
		if ($uno==($usuario.",".$pass))
		{
			$fecha=date("Y-m-d H:i:s");
			$file=fopen("log.txt","a");
			fwrite($file,$usuario."   ".$fecha."\n");
			fclose($file);
			return true;
		}
	}
		$fecha=date("Y-m-d H:i:s");
		$file=fopen("logFail.txt","a");
		fwrite($file,$usuario."   ".$pass."   ".$fecha."\n");
		fclose($file);
	return false;

}




}


?>