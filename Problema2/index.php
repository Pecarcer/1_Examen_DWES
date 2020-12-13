<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inrespuestaActualial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        legend {
            font-size: 10;
            color: blue;
        }

        .correcto {
            color: green;
        }

        .incorrecto {
            color: red;
        }
        .blanco{
            color:gray;
        }
        .btn {
            background-color: blue;
            color: white;
            font-weight: bold;
        }
    </style>
    <script type="text/javascript" src="refrescar.js"></script>
</head>

<body>
    <?php require_once "cuestionario.php"; ?>
    <div class="col-xs-12">
        <div class="div center-block">
            <br>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                <?php
                $fallos = 0;
                $aciertos = 0;

                for ($preguntaActual = 0; $preguntaActual < count($cuestionario); $preguntaActual++) {
                    echo "<fieldset><legend>" . $cuestionario[$preguntaActual]["pregunta"] . ":</legend>";
                    for ($respuestaActual = 0; $respuestaActual < count($cuestionario[$preguntaActual]["opciones"]); $respuestaActual++) {
                        $clase = "";
                        $seleccionado = "";

                        if (isset($_POST) && !empty($_POST)) {

                            if ($respuestaActual == $cuestionario[$preguntaActual]["respuesta"]) {
                                $clase = "class=\"correcto\" ";
                            }

                            if (isset($_POST['pregunta' . $preguntaActual]) && $respuestaActual == $_POST['pregunta' . $preguntaActual]) {
                                $seleccionado = "checked";


                                if ($respuestaActual != $cuestionario[$preguntaActual]["respuesta"]) {
                                    $clase = "class=\"incorrecto\" ";
                                    $fallos++;
                                } else {
                                    $aciertos++;
                                }
                            }
                        }

                        echo "<label " . $clase . "><input type=\"radio\" name=\"pregunta" . $preguntaActual . 
                        "\" value=\"" . $respuestaActual . "\" " . $seleccionado . "> " . $cuestionario[$preguntaActual]["opciones"][$respuestaActual] . 
                        "</label> <br>";
                    }
                    echo "</fieldset>";
                }

                ?>
                <br>
                <input type="submit" value="Comprobar" class="btn" />
                <input type="button" value="Reiniciar" class="btn"   onclick="return Refrescar();"/>

                <?php
                    if (isset($_POST) && !empty($_POST)){
                        
                        $blanco= count($cuestionario) - $aciertos - $fallos;

                        echo "<br><br><h3>Resultado:</h3>";
                        echo "<div class=\"correcto\"> Aciertos: ". $aciertos . "</div> ";
                        echo "<div class=\"incorrecto\"> Fallos: ". $fallos . "</div> ";
                        echo "<div class=\"blanco\"> En blanco: ". $blanco . "</div> ";

                    }

                ?>
            </form>
        </div>
    </div>
</body>

</html>