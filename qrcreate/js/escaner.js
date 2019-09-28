document.write('<script type="text/javascript" src="instascan.min.js"><\script>');
document.write('<script type="text/javascript" src="jquery.min.js"><\script>');


// Se crea un objeto de tipo Instascan y se le asigna el id de la etiqueta video de html5
      let scanner = new Instascan.Scanner({
        video:document.getElementById('preview')
      });
      
      scanner.addListener('scan', function(content){
            console.log(content);
       }); 
      
      // se le asigna un event listener al objeto de html 5 button con la etiqueta escanear
      document.getElementById("escanear").addEventListener('click', scanfunction);
    
      
      
      function scanfunction() {
         
      let result = scanner.scan();
          if(result != null){
              alert(result.content);
          } else 
              alert ("el código escaneado no es válido");
          
          
      }
      
      Instascan.Camera.getCameras().then(function (cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e){
            console.error(e);
        });
         
        