<?php  
    include_once('./bd_conect/bd.php');
    
    $oBd = obtenerBd();
    
    $sQuerySelect = "SELECT * FROM  dateupdatetables";
    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();
    $iQueryRows = $sQuerySelect->rowCount();

    if($iQueryRows > 0){
        $iCountRows = 0;
        $sTableInfo = "";
        //Apertura JSON -- coleccion de objetos tipo tabla
        $sJSON = '{
                    "tables": [';            
        while($vRowQuery = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
            $iCountRows++;
            $sTableName = $vRowQuery['table_name'];
            $iQueryRowsTable = $vRowQuery['rows_table'];
            $dDateUpdtTable = $vRowQuery['date_updt'];

            if($iCountRows === $iQueryRows){
                $sTableInfo .= '{
                                    "name": "'.$sTableName.'",
                                    "rows": '.$iQueryRowsTable.',
                                    "updateDate": "'.$dDateUpdtTable.'"
                                }';
            }else{
                $sTableInfo .= '{
                                    "name": "'.$sTableName.'",
                                    "rows": '.$iQueryRowsTable.',
                                    "updateDate": "'.$dDateUpdtTable.'"
                               },';
            };
        };
        //cierre JSON
        $sJSON = $sJSON.$sTableInfo.']}';
        echo $sJSON;
    };
?>
