<?php
class Usuario
{
	private $id;
	private $nombre;
	private $correo;
	private $contrasenia;
	private $rol;
	private $info;
	private $activa;
	private $token;


	public function getToken(){
		return $this->token;
	}

	public function setToken($token){
		$this->token = $token;
	}

	public function getactiva(){
		return $this->activa;
	}

	public function setActiva($activa){
		$this->activa = $activa;
	}

	public function getInfo(){
		return $this->info;
	}

	public function setInfo($info){
		$this->info = $info;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function setCorreo($correo){
		$this->correo = $correo;
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}

	public function setContrasenia($contrasenia){
		$this->contrasenia = $contrasenia;
	}

	public function getRol(){
		return $this->rol;
	}

	public function setRol($rol){
		$this->rol = $rol;
	}
}

 ?>
