<?php 
    include_once('../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $sQueryDelete = "DELETE FROM acumciudades";
    
    $iRowsAffected = $oBd->exec($sQueryDelete);

    echo $iRowsAffected;
?>