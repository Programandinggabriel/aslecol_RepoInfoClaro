<?php 
    include_once('../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $sQueryDelete = "DELETE FROM consoldescar";
    
    $iRowsAffected = $oBd->exec($sQueryDelete);

    echo $iRowsAffected;
?>