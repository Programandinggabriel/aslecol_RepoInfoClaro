<?php 
    $sRutaTxtStatus = './status_postgress.txt';
    $iStatus = file_get_contents($sRutaTxtStatus);
    echo $iStatus;
?>