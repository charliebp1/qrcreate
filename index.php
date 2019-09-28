<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Poniendo texto a una imagen</title>
       <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12 caja">
                <h3>Poniendo texto a una imagen</h3>
                <br>
                
                <form action="" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Subir archivo</legend>
                    
                    <div class="input-group">
                        <input type="text" name="texto" class="form-control" placeholder="Texto para la imagen">
                    </div>
                    <hr>
                    <div class="input-group">
                      <select name="color" id="input" class="form-control" required='required'>
                          <option value="">Selecciona el color para la fuente</option>
                          <option value="black">Negro</option>
                          <option value="red">Rojo</option>
                          <option value="green">Verde</option>
                          <option value="blue">Azul</option>
                      </select>
                    </div>
                    <hr>
                    <div class="input-group">
                        <select name="tipofuente" id="input" class="form-control" required='required'>
                            <option value="">Selecciona el tipo de fuente</option>
                            <option value="/fonts/AveFedan.ttf">AveFedan</option>
                            <option value="/fonts/contrast.ttf">Contrast</option>
                        </select>
                    </div>
                <hr>
                  <div class="radio">
                       <br>
                       <br>
                       <br>
                        
                       Elije el tipo de medida:
                       <label>
                           <input type="radio" name="tipomedida" value="porcentaje" checked>
                           Porcentaje (%)
                       </label>
                         <label>
                          <input type="radio" name="tipomedida" value="pixeles">
                           Pixeles(px) 
                         </label>
                    </div>
                    <hr>
                    
                    <div class="input-group">
                        <input type="text" name="sizefuente" size="50" class="form-control" placeholder="Tamaño de la fuente">
                    </div>
                        <hr>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="origincentro" value="centrado">
                            ¿Alinear punto de ancla al centro del texto?
                        </label>
                    </div>
                    <hr>
                    <div class="input-group">
                        <input type="text" name="pos_x" size="50" class="form-control" placeholder="Posición del Texto en 'X'">
                    </div>
                    <hr>
                    <div class="input-group">
                        <input type="text" name="pos_y" size="50" class="form-control" placeholder="Posición del Texto en 'Y'">
                    </div>
                    <hr>
                    <div class="input-group">
                        <input type="text" name="angulo" size="50"class="form-control" placeholder="Angulo del texto (0 a 360º)">
                    </div>
                    <hr>
                    <div class="input-group">
                        <input type="file" size="50" name="archivo" class="form-control">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default">Subir</button>
                    
                </form>
                
            </div>
            <div class="col-md-6 col-md-offset-1 caja">
                <?php
                /*
                    * imagecreatefromjpeg()
                    * imagecolorallocate()
                    * imagettftext()
                    * imagettfbbox()
                    * imagepng()
                    * imagedestroy()
                */
                
                /* $img = imagecreatefromjpeg('uploads/IMG.jpg');
                    $negro = imagecolorallocate($img, 0, 0, 0);
                    $font = dirname(__FILE__) . '/fonts/AveFedan.ttf';  
                    imagettftext($img, 200, 0, 1577, 575, $negro, $font, 'Carlos');
                    imagepng($img, 'uploads/nuevaimagen.png');
                    imagedestroy($img);
                
                    $cajatexto = imagettfbbox(100, 0, $font, 'Carlos');
                
                    foreach($cajatexto as $clave => $valor){
                       echo"$clave : $valor<br>";
                }*/
                
            extract($_POST, EXTR_OVERWRITE);
            
            //echo $tipofuente."<br>";
                
            require 'lib/errores.php';
            spl_autoload_register(function($clase) {
                               require "lib/$clase.php";
            });
                
            
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
                            $imgfinal = "$dir_subida/$nombre_archivo";
                            $ext = pathinfo($imgfinal, PATHINFO_EXTENSION);
                            echo "<h3 class='text-center'> Se ha subido la siguiente imagen</h3>
                            <div class='imagen'>
                            <img class='img-responsive' src='$imgfinal'>
                            </div>";
                            
                            $sizeimg = getimagesize("$imgfinal");
                            echo"<h3>Información de la imagen</h3>
                                 <p>
                                 Nombre: $nombre_archivo <br>
                                 Tamaño: {$sizeimg[0]}px de ancho por {$sizeimg[1]}px de alto <br>
                                 Peso: $peso kb
                                 </p>";
                            
                            // empezando estructura para trabajar con la imagen
                            
                            // establecer condicional para recibir el tipo de archivo jpg/png
                            if($ext_archivo == 'jpeg') {
                                 $img = imagecreatefromjpeg($imgfinal);
                            } elseif($ext_archivo == 'png') {
                                 $img = imagecreatefrompng($imgfinal);
                            } elseif($ext_archivo == 'gif') {
                                $img = imagecreatefromgif($imgfinal);
                            }
                           
                            
                            switch ($color){
                                case 'black':
                                    $color = imagecolorallocate($img, 0, 0, 0);
                                    break;
                                case 'red':
                                    $color = imagecolorallocate($img, 255, 0, 0);
                                    break;
                                case 'green':
                                    $color = imagecolorallocate($img, 0, 128, 0);
                                    break;
                                case 'blue':
                                    $color = imagecolorallocate($img, 0, 0, 255);
                                    break;
                                                            
                            }
                            
                            $imagen = new Convertidor($sizeimg[0], $sizeimg[1]);
                            
                            if( $origincentro == 'centrado'){
                                if($tipomedida == 'porcentaje'){
                                    // porcentaje con origen en el centro
                                    $imagen->convertirOrigenCentro($pos_x, $pos_y, $sizefuente, dirname(__FILE__) . $tipofuente, $texto, $angulo);
                                    imagettftext($img, $sizefuente, $angulo, $imagen->getX(), $imagen->getY(), $color, dirname(__FILE__) . $tipofuente, $texto);
                                } else {
                                    // pixeles con origen en el centro
                                    $imagen->convertirOrigenCentro($pos_x, $pos_y, $sizefuente, dirname(__FILE__) . $tipofuente, $texto, $angulo);
                                    imagettftext($img, $sizefuente, $angulo, $pos_x, $pos_y, $color, dirname(__FILE__) . $tipofuente, $texto);
                                }
                            } else {
                                // porcentaje sin origen en el centro
                                if($tipomedida == 'porcentaje') {
                                    $imagen->convertir($pos_x, $pos_y);
                                    imagettftext($img, $sizefuente, $angulo, $imagen->getX(), $imagen->getY(), $color, $tipofuente, $texto);
                                } else {
                                    imagettftext($img, $sizefuente, $angulo, $pos_x, $pos_y, $color, dirname(__FILE__) . $tipofuente, $texto);
                                }
                            }
                           
                            $imgsinjpg = preg_replace('/\.jpg/', '', $imgfinal);
                            imagepng($img, $imgsinjpg."-modificado.png");
                            imagedestroy($img);
                            
                            echo "<br>
                               <h3 class='text-center'> Imagen escrita </h3> 
                               <img class='img-responsive' src='$imgsinjpg-modificado.png'>
                            ";
                            
                            
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