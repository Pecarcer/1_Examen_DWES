<?php
//incluye la clase Libro y CrudLibro
	require_once('crud_medico.php');
	require_once('medico.php');
	$crud= new CrudMedico();
    $libro=new Medico();
    
	//busca el medico utilizando el id, que es enviado por GET desde la vista mostrar.php
	$libro=$crud->obtenerMedico($_GET['id']);
?>
<html>
<head>
	<title>Actualizar Medico</title>
</head>
<body>
	<form action='administrar_medico.php' method='post'>
	<table>
		<tr>
			<input type='hidden' name='id' value='<?php echo $libro->getId()?>'>
			<td>Nombre médico:</td>
			<td> <input type='text' name='nombre' value='<?php echo $libro->getNombre()?>' required ></td>
		</tr>
		<tr>
			<td>Apellidos:</td>
			<td><input type='text' name='apellidos' value='<?php echo $libro->getApellidos()?>' required></td>
		</tr>
		<tr>
			<td>Nivel:</td>
			<td><input type='text' name='nivel' value='<?php echo $libro->getNivel() ?>'required></td>
        </tr>
        
        <tr>
			<td>Salario:</td>
			<td><input type='text' name='salario' value='<?php echo $libro->getSalario() ?>'></td>
        </tr>
        
		<input type='hidden' name='actualizar' value='actualizar'>
	</table>
	<input type='submit' value='Guardar'>
	<a href="index.php">Volver</a>
</form>
</body>
</html>