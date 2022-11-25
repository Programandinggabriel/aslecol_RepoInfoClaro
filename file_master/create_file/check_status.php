<?php 
    $sRutaTxtStatus = './status_mysqli.txt';
    $iStatus = file_get_contents($sRutaTxtStatus);
    echo $iStatus;
?>