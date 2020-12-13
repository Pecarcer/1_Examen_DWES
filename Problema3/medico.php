<?php
	class Medico{
		private $id;
		private $nombre;
        private $apellidos;
        private $nivel;
        private $salario;
        
 
		function __construct(){}
 
		public function getNombre(){
		return $this->nombre;
		}
 
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
 
		public function getApellidos(){
			return $this->apellidos;
		}
 
		public function setApellidos($apellidos){
			$this->apellidos = $apellidos;
		}
 
		public function getNivel(){
		return $this->nivel;
		}
 
		public function setNivel($nivel){
			$this->nivel = $nivel;
		}
		public function getId(){
			return $this->id;
		}
 
		public function setId($id){
			$this->id = $id;
        }

        public function getSalario(){
			return $this->salario;
		}
 
		public function setSalario($salario){
			$this->salario = $salario;
		}
	}
?>