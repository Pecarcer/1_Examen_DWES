<html>
<head>
	<title> Ingresar Medico</title>
<?php
	if (isset($_POST) && !empty($_POST)) {
        $nivel = $_POST["nivel"];
        $salario = $_POST["salario"];


        if ($nivel <= 0) {
            $errores["errNivelNeg"] = "El nivel ha de ser mayor de cero <br>";      
        }

        if (!is_numeric($nivel)) {
            $errores["errNivelNum"] = "El nivel ha de ser numérico <br>";
        }

        if (!is_numeric($salario)) {
            $errores["errSalNum"] = "El salario ha de ser numérico <br>";
        }

        if($salario < 0) {
            $errores["ErrSalNeg"] = "Tienes que introducir un número <br>";
        }
	}
	?>
</head>
<header>
Ingresa los datos del Médico
</header>
<form action='administrar_medico.php' method='post'>
	<table>
		<tr>
			<td>Nombre:</td>
			<td><input type='text' name='nombre' required ></td>
        </tr>
        <tr>
			<td>Apellidos:</td>
			<td><input type='text' name='apellidos' required ></td>
        </tr>
        <tr>
		<span class="error"> <?php if(isset($errores["errNivelNum"])) { echo $errores["errNivelNum"]; } ?></span>
		<span class="error"> <?php if(isset($errores["errNivelNeg"])) { echo $errores["errNivelNeg"]; } ?></span>
			<td>Nivel:</td>
			<td><input type='text' name='nivel' required ></td>
		</tr>
		<tr>
		<span class="error"> <?php if(isset($errores["errSalNum"])) { echo $errores["errSalNum"]; } ?></span>
		<span class="error"> <?php if(isset($errores["errSalNeg"])) { echo $errores["errSalNeg"]; } ?></span>
			<td>Salario:</td>
			<td><input type='text' name='salario' required ></td>
		</tr>
		<input type='hidden' name='insertar' value='insertar'>
	</table>
	<input type='submit' value='Guardar'>
	<a href="index.php">Volver</a>
</form>
 
</html>