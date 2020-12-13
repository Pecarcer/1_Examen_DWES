<?php

require_once('crud_medico.php');
require_once('medico.php');
$crud = new CrudMedico();
$medico = new Medico();

//obtiene todos los medicos con el método mostrar de la clase crud

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Médicos</title>
    <style>
        th {
            background-color: blue;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>

    <div>
        <h2> Listado médicos </h2>
        <span class="glyphicon glyphicon-plus"><a href="ingresar.php">Meter nuevos médicos</a>
    </div>


    <h4> Búsqueda de médicos:</h4>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="col-lg-5">

        <input type="text" name="nombreBuscar" class="form-control" placeholder="Nombre" /> <br>

        <input type="text" name="nivelBuscar" class="form-control" placeholder="Nivel" /> <br>
        <input type="submit" value="Buscar" class="btn btn-success" /> <br><br>

    </form>


    <div center-block>

        <table class="table table-stripped ">
            <thead class="thead-dark">
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nivel</th>
                <th>Salario</th>
                <th colspan="2">Acciones</th>
            </thead>

            <?php



            if (isset($_POST['nombreBuscar']) && !empty($_POST['nombreBuscar']) && empty($_POST['nivelBuscar'])) {

                $listaMedicos = $crud->obtenerMedicosNombre($_POST['nombreBuscar']);
                
                echo "nombre metido y nivel no";
            } else if (isset($_POST['nivelBuscar']) && !empty($_POST['nivelBuscar']) && empty($_POST['nombreBuscar'])) {

                $listaMedicos = $crud->obtenerMedicosNivel($_POST['nivelBuscar']);
                
                echo "nivel metido y nombre no";
            }else if (isset($_POST['nivelBuscar']) && !empty($_POST['nivelBuscar']) && isset($_POST['nombreBuscar']) && !empty($_POST['nombreBuscar'])) {

                $listaMedicos = $crud->obtenerMedicosNombreNivel($_POST['nombreBuscar'], $_POST['nivelBuscar']);
                
                echo "nombre y nivel metido";
            }

            else {
                $listaMedicos = $crud->mostrar();
                echo "ningún parametro metido";
            }

                foreach ($listaMedicos as $medico) { ?>
                    <tr>
                        <td><?php echo $medico->getId() ?></td>
                        <td><?php echo $medico->getNombre() ?></td>
                        <td><?php echo $medico->getApellidos() ?></td>
                        <td><?php echo $medico->getNivel() ?> </td>
                        <td><?php echo $medico->getSalario() ?> </td>
                        <td><a href="actualizar.php?id=<?php echo $medico->getId() ?>&accion=a">Actualizar</a> </td>
                        <td><a href="administrar_medico.php?id=<?php echo $medico->getId() ?>&accion=e">Eliminar</a> </td>
                    </tr>
            <?php 
            } ?>
        </table>
    </div>





</body>

</html>