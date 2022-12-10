<?php 
    include_once('../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $sTable = "consoldescar";
    $sQueryDelete = "DELETE FROM " . $sTable;
    
    $iRowsAffected = $oBd->exec($sQueryDelete);

    f_updateRowsBd($sTable);
    echo $iRowsAffected;



    /**
     * funcion actualiza la cantidad de filas correspondiente, en la tabla dateupdatetables
     */
    function f_updateRowsBd($sTable){
        global $oBd;
        date_default_timezone_set("America/Bogota");
        $cDate = "'".date('Y-m-d H:i:s')."'";

        $sQueryUpdate = "UPDATE dateupdatetables 
                            SET rows_table = '0', date_updt =".$cDate."
                            WHERE table_name LIKE '".$sTable."'";
        $oBd->exec($sQueryUpdate);
    };
?>