<?php

namespace Numerate\lib;

class StringToQr
{
    
    private $qr;
    
    public function __construct ($string)
    {
        
        \PHPQRCode\QRcode::png($string, "app/data/".$string.".png", QR_ECLEVEL_H, 20, 2);
        
        $this->qr = $string . '.png';

    }
    
    public function getQr() {
        return $this->qr;
    }

}

?>