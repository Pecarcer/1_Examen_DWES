<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Numeros</title>

    <style>
        .elegido,span{
            color: red;
        }
    </style>

    <?php

    if (isset($_POST) && !empty($_POST)) {
        $limInf = $_POST["limInf"];
        $limSup = $_POST["limSup"];
        $numero = $_POST["numero"];
        $reps = $_POST["reps"];

        if ($limInf > $limSup) {
            $errores["limInfErr"] = "El límite inferior no puede ser mayor que el superior<br>";
            $errores["limSupErr"] = "El límite superior no puede ser menor que el inferior<br>";        
        }

        if (!is_numeric($numero)) {
            $errores["numErrNum"] = "Tienes que introducir un número<br>";
        }

        if ($numero < $limInf || $numero > $limSup) {
            $errores["numErrLim"] = "Tienes que introducir un número que esté entre los límites establecidos<br>";
        }

        if(!is_numeric($reps)) {
            $errores["repErrNum"] = "Tienes que introducir un número<br>";
        }
    }

    ?>

</head>

<body>
    <div class="col-xs-12">
        <div class="div center-block">
            <h3>Secuencia de números</h3>
        </div>
    </div>
    <hr />
    <div class="col-xs-12">
        <div class="div center-block">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="col-lg-5">

                <span class="error"> <?php if(isset($errores["limInfErr"])) { echo $errores["limInfErr"]; } ?></span>
                Límite inferior: <input type="text" name="limInf" class="form-control" required /> <br>
                <span class="error"> <?php if(isset($errores["limSupErr"])) { echo $errores["limSupErr"]; }?></span>
                Límite superior: <input type="text" name="limSup" class="form-control" required /> <br>
                <span class="error"> <?php if(isset($errores["numErrNum"])) { echo $errores["numErrNum"]; }?></span>
                <span class="error"> <?php if(isset($errores["numErrLim"])) { echo $errores["numErrLim"]; } ?></span>
                Número: <input type="text" name="numero" class="form-control" required /> <br>                
                <span class="error"> <?php if(isset($errores["repErrNum"])) { echo $errores["repErrNum"]; }?></span>
                Repeticiones: <input type="text" name="reps" class="form-control" required /> <br>

                <input type="submit" value="Generar" class="btn btn-success" />
            </form>
        </div>
        </div>


        <?php 
        
        if (isset($_POST) && !empty($_POST) && empty($errores)) {
            
            echo "<br><br><h3>Resultado:</h3>";
            $informe = "Repeticiones: ".$reps.". Número: ".$numero.". Limites: ".$limInf." - ". $limSup. "<br>";
            echo $informe;
            

            for ($i=0; $i < $reps;) { 
                    $numRand = rand($limInf,$limSup);
                    if($numRand==$numero){
                        echo "<txt class=\"elegido\">" . $numRand . "</txt> " ;
                        $i++;
                    }
                    else {
                        echo $numRand." " ;
                    }
            }

        }        
        ?> 
</body>

</html>