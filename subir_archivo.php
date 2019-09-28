<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Super global $_FILES</title>
       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 caja">
                <h3>$_FILE</h3>
                <br>
                
                <form action="" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Subir archivo</legend>
                    <div class="input-group">
                        <input type="hidden" name="validando">
                        <input type="file" name="archivo" class="form-control">
                        
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default">Subir</button>
                    
                </form>
                
            </div>
            <div class="col-md-8 col-md-offset-1 caja">
                <?php
                
            require 'lib/errores.php';
                
            if(!file_exists('uploads')){
                mkdir('uploads', 0777);
                //echo "No existe, empezaremos a crear la carpeta ";
            } 
                
            $dir_subida = 'uploads/';
                
            if($_POST){
                    if($_FILES['archivo']){
                    $nombre_archivo = $_FILES['archivo']['name'];
                    $nombre_tmp = $_FILES['archivo']['tmp_name'];
        
                    $archivo_subida = $dir_subida.basename($nombre_archivo);
                    $ext_archivo = preg_replace('/image\//', '', $_FILES['archivo']['type']);
                    $peso = round($_FILES['archivo']['size']/1024);
                    //echo "{$_FILES['archivo']['type']}<br>$ext_archivo";
                    
                   if($ext_archivo != 'gif' && $ext_archivo != 'png' && $ext_archivo != 'jpeg'){
                        trigger_error( 'Solo se permiten archivos con extensión "jpg, png, gif"', E_USER_WARNING);
                        exit;
                   } else {
                        if(move_uploaded_file($nombre_tmp, $archivo_subida)){
                            $ext = pathinfo("$dir_subida/$nombre_archivo", PATHINFO_EXTENSION);
                            echo "<h3 class='text-center'> Se ha subido la siguiente imagen</h3>
                            <div class='imagen'>
                            <img class='img-responsive' src='$dir_subida/$nombre_archivo'>
                            </div>";
                            
                            $sizeimg = getimagesize("$dir_subida/$nombre_archivo");
                            echo"<h3>Información de la imagen</h3>
                                 <p>
                                 Nombre: $nombre_archivo <br>
                                 Tamaño: {$sizeimg[0]}px de ancho por {$sizeimg[1]}px de alto <br>
                                 Peso: $peso kb
                                 </p>";
                        } else {
                            trigger_error('No es posible mover el archivo', E_USER_WARNING);
                        } 
                   } 
                    
                    
                }  else {
                       trigger_error('No se pudo encontrar el indice "archivo" o el formulario no esta bien estructurado', E_USER_WARNING);
                        
               }    
            }
                
                
                /*
                    dirname
                    basename
                    extension
                    filename
                    
                    PATHINFO_EXTENSION
                
                */
                
                ?>
            </div>
        </div>
        
    </div>
    
</body>
</html>