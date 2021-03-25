<?php
class Tramite{
	private $id;
	private $idUsuario;
	private $idMascota;
	private $estado;
	private $fechaSolicitud;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getIdMascota(){
		return $this->idMascota;
	}

	public function setIdMascota($idMascota){
		$this->idMascota = $idMascota;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getFechaSolicitud(){
		return $this->fechaSolicitud;
	}

	public function setFechaSolicitud($fechaSolicitud){
		$this->fechaSolicitud = $fechaSolicitud;
	}
}
 ?>