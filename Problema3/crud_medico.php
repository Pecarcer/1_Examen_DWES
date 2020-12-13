<?php
// incluye la clase Db
require_once('conexion.php');

class CrudMedico
{
	// constructor de la clase
	public function __construct()
	{
	}

	// método para insertar, recibe como parámetro un objeto de tipo médico
	public function insertar($medico)
	{
		$db = Db::conectar();
		$insert = $db->prepare('INSERT INTO medicos values(NULL,:nombre,:apellidos,:nivel,:salario)');
		$insert->bindValue('nombre', $medico->getNombre());
		$insert->bindValue('apellidos', $medico->getApellidos());
		$insert->bindValue('nivel', $medico->getNivel());
		$insert->bindValue('salario', $medico->getSalario());
		$insert->execute();
	}

	// método para mostrar todos los medicos
	public function mostrar(){
		$db = Db::conectar();
		$listaMedicos = [];
		$select = $db->query('SELECT * FROM medicos');

		foreach ($select->fetchAll() as $medico) {
			$medicoSeleccionado = new Medico();
			$medicoSeleccionado->setId($medico['id']);
			$medicoSeleccionado->setNombre($medico['nombre']);
			$medicoSeleccionado->setApellidos($medico['apellidos']);
			$medicoSeleccionado->setNivel($medico['nivel']);
			$medicoSeleccionado->setSalario($medico['salario']);

			$listaMedicos[] = $medicoSeleccionado;
		}
		return $listaMedicos;
	}

	// método para eliminar un medico, recibe como parámetro el id del medico
	public function eliminar($id){
		$db = Db::conectar();
		$eliminar = $db->prepare('DELETE FROM medicos WHERE ID=:id');
		$eliminar->bindValue('id', $id);
		$eliminar->execute();
	}

	// método para buscar un medico, recibe como parámetro el nombre del medico
	public function obtenerMedico($id){
		$db = Db::conectar();
		$select = $db->prepare('SELECT * FROM medicos WHERE ID=:id');
		$select->bindValue('id', $id);
		$select->execute();
		$medico = $select->fetch();
		$medicoSeleccionado = new Medico();
		$medicoSeleccionado->setId($medico['id']);
		$medicoSeleccionado->setNombre($medico['nombre']);
		$medicoSeleccionado->setApellidos($medico['apellidos']);
		$medicoSeleccionado->setNivel($medico['nivel']);
		$medicoSeleccionado->setSalario($medico['salario']);
		return $medicoSeleccionado;
	}


	// Método para buscar medicos, recibe como parámetro un nivel de medico.
	public function obtenerMedicosNivel($nivel){
		$db = Db::conectar();
		$listaMedicos = [];
		$select = $db->prepare('SELECT * FROM medicos WHERE NIVEL=:nivel');
		$select->bindValue('nivel', $nivel);
		$select->execute();

		foreach ($select->fetchAll() as $medico) {
			$medicoSeleccionado = new Medico();
			$medicoSeleccionado->setId($medico['id']);
			$medicoSeleccionado->setNombre($medico['nombre']);
			$medicoSeleccionado->setApellidos($medico['apellidos']);
			$medicoSeleccionado->setNivel($medico['nivel']);
			$medicoSeleccionado->setSalario($medico['salario']);
			$listaMedicos[] = $medicoSeleccionado;
		}
		return $listaMedicos; 
	}

		// Método para buscar medicos, recibe como parámetro el nombre del medico
		public function obtenerMedicosNombre($nombre){
			$db = Db::conectar();
			$listaMedicos = [];
			$select = $db->prepare('SELECT * FROM medicos WHERE NOMBRE=:nombre');
			$select->bindValue('nombre', $nombre);
			$select->execute();
	
			foreach ($select->fetchAll() as $medico) {
				$medicoSeleccionado = new Medico();
				$medicoSeleccionado->setId($medico['id']);
				$medicoSeleccionado->setNombre($medico['nombre']);
				$medicoSeleccionado->setApellidos($medico['apellidos']);
				$medicoSeleccionado->setNivel($medico['nivel']);
				$medicoSeleccionado->setSalario($medico['salario']);
				$listaMedicos[] = $medicoSeleccionado;
			}
			return $listaMedicos; 
		}

		// Método para buscar médicos, recibe como parámetro el nombre de un médico y un nivel de médico.
		public function obtenerMedicosNombreNivel($nombre,$nivel){
			$db = Db::conectar();
			$listaMedicos = [];
			$select = $db->prepare('SELECT * FROM medicos WHERE nombre=:nombre AND nivel=:nivel');
			$select->bindValue('nombre', $nombre);
			$select->bindValue('nivel', $nivel);
			$select->execute();
	
			foreach ($select->fetchAll() as $medico) {
				$medicoSeleccionado = new Medico();
				$medicoSeleccionado->setId($medico['id']);
				$medicoSeleccionado->setNombre($medico['nombre']);
				$medicoSeleccionado->setApellidos($medico['apellidos']);
				$medicoSeleccionado->setNivel($medico['nivel']);
				$medicoSeleccionado->setSalario($medico['salario']);
				$listaMedicos[] = $medicoSeleccionado;
			}
			return $listaMedicos; 
		}		



	// método para actualizar un medico, recibe como parámetro el medico
	public function actualizar($medico)
	{
		$db = Db::conectar();
		$actualizar = $db->prepare('UPDATE medicos SET nombre=:nombre, apellidos=:apellidos, nivel=:nivel, salario=:salario  WHERE ID=:id');
		$actualizar->bindValue('id', $medico->getId());
		$actualizar->bindValue('nombre', $medico->getNombre());
		$actualizar->bindValue('apellidos', $medico->getApellidos());
		$actualizar->bindValue('nivel', $medico->getNivel());
		$actualizar->bindValue('salario', $medico->getSalario());
		$actualizar->execute();
	}
}
