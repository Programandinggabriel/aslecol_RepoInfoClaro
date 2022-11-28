<?php  
    include_once('./bd_conect/bd.php');

    $oBd = obtenerBd();
    $sQuerySelect= "SELECT fecha_carga FROM fechcargarch";

    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();
    $iCountRows = $sQuerySelect->rowCount();
    
    if($iCountRows === 1){
        $aDate = $sQuerySelect->fetch(PDO::FETCH_BOTH);
         foreach($cDateUpdtfile = $aDate['fecha_carga']){
            if();
         };
    };
    die();
 
?>
