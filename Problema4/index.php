<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Encuesta</title>

    <style>
        span{
            color: red;
        }
        .resultado{
            color:green;
        }
    </style>

    <?php

        require_once('administradorProvincias.php');
        require_once('provincia.php');
        $admin = new adminProv();
        $provincia = new Provincia();

        $listaProvincias = $admin->mostrarProvincias();

        $nombre ="";
        $fecha = "";
        $email = "";
        $provinciaElegida = "";
        $intereses = "";
        $acepta = "";

    if (isset($_POST) && !empty($_POST)) {
        $nombre = $_POST["nombre"];
        $fecha = $_POST["fecha"];
        $email = $_POST["email"];
        $provinciaElegida = $_POST["provincia"];

        if(isset($_POST["intereses"]) && !empty($_POST["intereses"])){
            $intereses = $_POST["intereses"];
        } else {
            $intereses = [];
        }

        $acepta = $_POST["acepta"];

        if (strlen($nombre)<2) {
            $errores["nomCortoErr"] = "El nombre debe tener más de dos caracteres<br>";   
        }

        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/",$fecha)===0) {
            $errores["fechaErr"] = "El formato de fecha ha de ser dd/mm/aaaa<br>";
        }

        if (isset($_POST["email"]) && (!empty($_POST["email"])) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["emailErr"] = "Tienes que introducir un formato válido de correo<br>";
        }
        if($acepta=="no"){
            $errores["noAcepta"] = "Tienes que aceptar nuestros términos<br>";
        }

        if(!isset($intereses) || (empty($intereses))){
            $errores["sinIntereses"] = "Tienes que seleccionar mínimo un interés<br>";}
    }
    ?>

</head>

<body>
    <div class="col-xs-12">
        <div class="div center-block">
            <h3>Rellene la encuesta</h3>
        </div>
    </div>
    <hr />
    <div class="col-xs-12">
        <div class="div center-block">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="col-lg-5">

                <span class="error"> <?php if(isset($errores["nomCortoErr"])) { echo $errores["nomCortoErr"]; } ?></span>
                Nombre: <input type="text" name="nombre" class="form-control" required <?php if(!isset($errores["nomCortoErr"])) echo "value=\"" . $nombre ."\""  ?>/> <br>
                <span class="error"> <?php if(isset($errores["fechaErr"])) { echo $errores["fechaErr"]; }?></span>
                Fecha: <input type="text" name="fecha" class="form-control" required <?php if(!isset($errores["fechaErr"]))  echo "value=\"" . $fecha ."\""  ?>/> <br>
                <span class="error"> <?php if(isset($errores["emailErr"])) { echo $errores["emailErr"]; }?></span>                
                Email: <input type="text" name="email" class="form-control" <?php if(!isset($errores["emailErr"]))  echo "value=\"" . $email ."\""  ?>/> <br> <br> 
                Provincia: <select type="select" name="provincia" class="form-control" required placeholder="Escoja provincia"> <br>

                <option disabled selected option>  Escoja una provincia  </option>
                <?php foreach ($listaProvincias as $provincia) { 
                        echo "<option value=\"" . $provincia->getNombre() . "\" >" . $provincia->getNombre() . " </option>";                    
                 } ?>
                </select>
                 <br><br>
                <span class="error"> <?php if(isset($errores["sinIntereses"])) { echo $errores["sinIntereses"]; }?></span>
                Intereses :  <br>  

                Interés 1 <input type="checkbox" name="intereses[]"  value="1"/>   
                Interés 2 <input type="checkbox" name="intereses[]"  value="2"/>  
                Interés 3 <input type="checkbox" name="intereses[]"  value="3"/> <br><br>

                <span class="error"> <?php if(isset($errores["noAcepta"])) { echo $errores["noAcepta"]; }?></span>
                ¿Aceptas los términos?  <input type="radio" name="acepta"  value="si" required/> Sí 
                                        <input type="radio" name="acepta"  value="no" required/> No   <br><br>           

                <input type="submit" value="Generar" class="btn btn-success" /><br><br>
            </form>
        </div>
        </div>


        <?php 
        
        if (isset($_POST) && !empty($_POST) && empty($errores)) {



            $totalInt=" ";
            
            for ($i=0; $i < count($intereses); $i++) { 
                $totalInt .= $intereses[$i];
                if(count($intereses)>1){
                        if($i != (count($intereses)-1))
                        $totalInt .= ",";
                }
            }

            $codProvincia = $admin->obtenerCodProvincia($provinciaElegida);

            
            echo "<br><br><h3>Datos Introducidos:</h3><br><br> <div class=\"resultado\">
            Nombre: " . $nombre ." <br><br>
            Fecha: " . $fecha . "<br><br>
            Correo: " . $email . "<br><br>
            Cod. Ciudad: " .$codProvincia["id"] . "<br><br>
            Intereses: " . $totalInt . "<br><br>
            Acepta términos: Sí </div>";
            
            
           

        }        
        ?> 
</body>

</html>