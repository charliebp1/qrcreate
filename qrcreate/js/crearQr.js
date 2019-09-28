document.write('<script type="text/javascript" src="jquery.min.js"><\script>');
document.write('<script type="text/javascript" src="qrcode.min.js"><\script>');

function createQr () {
          var newQR = prompt ("Escribe algo, por faver", "Aquí va el nuevo texto");
           
          // (código simple) var qrcode = new QRCode(document.getElementById("ncqr"), newQR);
          // con opciones
          var qrcode = new QRCode("ncqr", {
              text: newQR,
              width: 128,
              height: 128,
              colorDark : "#000000",
              colorLight : "#ffffff",
              correctLevel : QRCode.CorrectLevel.H
          });
         
          
         
      }

function borrarQr() {
             var capa = document.getElementById('ncqr').innerHTML='';
            /* capa.style.display="none";
             capa.style.visibility="hidden";*/
      }