<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>$_SERVER</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xs-10 col-centrar caja">
                <h3>Super Global $_SERVER</h3>
                <br>
                
                    <?php
                       foreach($_SERVER as $clave => $valor) {
                           echo "$clave : $valor<br>";
                       }
                    ?>
                
                
            </div>
        </div>
        
    </div>
    
</body>
</html>