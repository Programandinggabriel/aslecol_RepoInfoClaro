<?php  
    include_once('./bd_conect/bd.php');

    $oBd = obtenerBd();
    $sQuerySelect= "SELECT table_name, date_updt As fechaAct, rows_table As Filas_tablax FROM fechcargarch";

    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();
    $iCountRows = $sQuerySelect->rowCount();
    
    if($iCountRows > 0){
        while($aDate = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
            echo ("
                paso
            
            
            ");
        };
        
    };
?>
