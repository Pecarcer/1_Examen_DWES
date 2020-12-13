<?php
// incluye la clase Db
require_once('conexion.php');

class adminProv
{
	// constructor de la clase
	public function __construct(){}



	public function obtenerCodProvincia($provinciaElegida)
	{
		$db = Db::conectar();
		$select = $db->prepare('SELECT id FROM provincias WHERE provincia=:provincia');
		$select->bindValue('provincia', $provinciaElegida);
		$select->execute();
		$cod_provincia = $select->fetch();

		return $cod_provincia;
    }
    

    public function mostrarProvincias()	{
		$db = Db::conectar();
		$listaProvincias = [];
		$select = $db->query('SELECT * FROM provincias');

		foreach ($select->fetchAll() as $provincia) {
			$provinciaSeleccionada = new Provincia();
			$provinciaSeleccionada->setId($provincia['id']);
			$provinciaSeleccionada->setNombre($provincia['provincia']);

			$listaProvincias[] = $provinciaSeleccionada;
		}
		return $listaProvincias;
	}
}
