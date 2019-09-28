<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>$_SERVER</title>
   <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">-->
   <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-xs-10 col-centrar caja">
                <h3>Super Global $_SERVER</h3>
                <br>
                <?php
                function ip_return(){
                   $header_array =  [
                       'HTTP_CLIENT_IP',
                        'HTTP_PRAGMA',
                        'HTTP_XCONNECTION',
                        'HTTP_CACHE_INFO',
                        'HTTP_XPROXY',
                        'HTTP_PROXY',
                        'HTTP_PROXY_CONNECTION',
                        'HTTP_VIA',
                        'HTTP_X_COMING_FROM',
                        'HTTP_COMING_FROM',
                        'HTTP_X_FORWARDED_FOR',
                        'HTTP_X_FORWARDED',
                        'HTTP_X_CLUSTER_CLIENT_IP',
                        'HTTP_FORWARDED_FOR',
                        'HTTP_FORWARDED',
                        'ZHTTP_CACHE_CONTROL',
                        'REMOTE_ADDR'
                   ];
                    
                   foreach($header_array as $clave) {
                       if(array_key_exists($clave, $_SERVER)){
                           foreach(explode(',', $_SERVER[$clave]) as $ip){
                               $ip = trim($ip);
                               if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false){
                                   return $ip;
                               }    
                           }
                       }
                   }
                }
                echo ip_return();
                ?>
                <table class="table table-bordered">
                    
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Clave</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    
                    <?php
                       $contador = 0;
                       foreach($_SERVER as $clave => $valor) {
                           $contador++;
                           
                           echo "<tr>
                                    <td>$contador</td>
                                    <td>$clave</td>
                                    <td>$valor</td>
                                </tr>";
                       }
                       /* 
                        'HTTP_CLIENT_IP',
                        'HTTP_PRAGMA',
                        'HTTP_XCONNECTION',
                        'HTTP_CACHE_INFO',
                        'HTTP_XPROXY',
                        'HTTP_PROXY',
                        'HTTP_PROXY_CONNECTION',
                        'HTTP_VIA',
                        'HTTP_X_COMING_FROM',
                        'HTTP_COMING_FROM',
                        'HTTP_X_FORWARDED_FOR',
                        'HTTP_X_FORWARDED',
                        'HTTP_X_CLUSTER_CLIENT_IP',
                        'HTTP_FORWARDED_FOR',
                        'HTTP_FORWARDED',
                        'ZHTTP_CACHE_CONTROL',
                        'REMOTE_ADDR'*/ 
                    ?>
                
                    </tbody>
                </table>
                <?php
                
                function ip_real() {
                           if($_SERVER['HTTP_X_FORWARDED_FOR']){
                               return $_SERVER['HTTP_X_FORWARDED_FOR'];
                           } else {
                               return $_SERVER['REMOTE_ADDR'];
                           }
                }
                
                echo ip_real();
                        
                ?>
            </div>
        </div>
        
    </div>
    
</body>
</html>