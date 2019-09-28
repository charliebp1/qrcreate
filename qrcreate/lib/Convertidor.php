<?php

class Convertidor {
    protected $x;
    protected $y;
    
    public function __construct($ancho, $alto) {
        $this->x = $ancho/100;
        $this->y = $alto/100;
    }
    
    public function convertir($p_x, $p_y) {
        $this->x = floor ($p_x * $this->x);
        $this->y = floor ($p_y * $this->y);
    }
    
    public function convertirOrigenCentro($p_x, $p_y, $tFuente, $rutaFuente, $texto, $angulo = 0){
        $cajatexto = imagettfbbox($tFuente, $angulo, $rutaFuente, $texto);
        $tX = $cajatexto[2]/100;
        $this->convertir($p_x, $p_y);
        $this->x = floor($this->x - ($p_x * $tX));
        $this->y = floor($this->y + ($tFuente/2));
    }
    
    public function getX(){
        return $this->x;
    }
    
    public function getY(){
        return $this->y;
    }
}
?>