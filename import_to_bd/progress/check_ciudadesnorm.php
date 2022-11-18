<?php 
    //archivo con valor del progreso
    $sFileVal = "./values_ciudnorm.txt";
    $iProgress = file_get_contents($sFileVal);
    echo($iProgress);
?>