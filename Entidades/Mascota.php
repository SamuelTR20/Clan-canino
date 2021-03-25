<?php
class Mascota{
	private $id;
	private $idRefugio;
	private $nombre;
	private $edad;
	private $sexo;
	private $historia;
	private $foto;
	private $estado;
	private $observaciones;
	private $especie;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdRefugio(){
		return $this->idRefugio;
	}

	public function setIdRefugio($idRefugio){
		$this->idRefugio = $idRefugio;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getEdad(){
		return $this->edad;
	}

	public function setEdad($edad){
		$this->edad = $edad;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

	public function getHistoria(){
		return $this->historia;
	}

	public function setHistoria($historia){
		$this->historia = $historia;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function setFoto($foto){
		$this->foto = $foto;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getObservaciones(){
		return $this->observaciones;
	}

	public function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}

	public function getEspecie(){
		return $this->especie;
	}

	public function setEspecie($especie){
		$this->especie = $especie;
	}
}

 ?>