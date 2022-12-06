<?php  
    include_once('./bd_conect/bd.php');

    $oBd = obtenerBd();

    //variable nameFile nombre del archivo para conulta de información
    if(isset($_GET['nameFile'])){
        $tableName = "'".f_getTableName($_GET['nameFile'])."'";
        $sQuerySelect = "SELECT rows_table, date_updt
                          FROM dateupdatetables 
                          WHERE table_name = " . $tableName ;
        
        $sQuerySelect =  $oBd->prepare($sQuerySelect);
        $sQuerySelect->execute();
        $iRowCount = $sQuerySelect->rowCount();

        if($iRowCount === 1){
            $aInfo = $sQuerySelect->fetch(PDO::FETCH_BOTH);
            echo $aInfo['rows_table'].', '.$aInfo['date_updt'];
        }else{
            echo 'no info';
        };

    };



    function f_getTableName($nameFile){
        switch($_GET['nameFile']){
            case 'descargas':
              $tableName = "consoldescar";  
                break;
            case 'prepotencial':
                $tableName = "";
                break;
            case 'ciudadesnorm':
                $tableName = "acumciudades";
                break;
            case 'ascard':
                $tableName = "ascard";
                break;
            case 'exclusiondcto';
                $tableName = "exclusiondcto";
                break;
        };
        return $tableName;
    };    
?>
