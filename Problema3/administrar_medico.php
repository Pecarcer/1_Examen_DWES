<?php
//incluye la clase medico y CrudMedico
require_once('crud_medico.php');
require_once('medico.php');
 
$crud= new CrudMedico();
$medico= new Medico();
 
	// si el elemento insertar no viene nulo llama al crud e inserta un medico
	if (isset($_POST['insertar'])) {
		$medico->setNombre($_POST['nombre']);
		$medico->setApellidos($_POST['apellidos']);
        $medico->setNivel($_POST['nivel']);
        $medico->setSalario($_POST['salario']);

		//llama a la función insertar definida en el crud
		$crud->insertar($medico);
        header('Location: index.php');
        
	// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el medico
	}elseif(isset($_POST['actualizar'])){
		$medico->setId($_POST['id']);
		$medico->setNombre($_POST['nombre']);
		$medico->setApellidos($_POST['apellidos']);
        $medico->setNivel($_POST['nivel']);
        $medico->setSalario($_POST['salario']);
		$crud->actualizar($medico);
        header('Location: index.php');
        
	// si la variable accion enviada por GET es == 'e' llama al crud y elimina un medico
	}elseif ($_GET['accion']=='e') {
		$crud->eliminar($_GET['id']);
        header('Location: index.php');
        		
	// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
	}elseif($_GET['accion']=='a'){
		header('Location: actualizar.php');
	}
?>