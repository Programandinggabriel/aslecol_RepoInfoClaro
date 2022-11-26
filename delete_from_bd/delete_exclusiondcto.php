<?php 
    include_once('../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $sQueryDelete = "DELETE FROM exclusiondcto";
    
    $iRowsAffected = $oBd->exec($sQueryDelete);

    echo $iRowsAffected;
?>