<?php 
    include_once('../bd_conect/bd.php');
    
    $bd = obtenerBD();
    $sQueryDelete = "DELETE FROM consoldescar";
    
    $iRowsAffected = $bd->exec($sQueryDelete);

    echo $iRowsAffected;
?>