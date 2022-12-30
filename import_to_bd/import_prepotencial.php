<?php 
require_once "../bd_conect/bd.php";

$table = "prepotencial";
$oBd = obtenerBD();

#array con las columnas necesarias
$aColumnasReq = array(1,2,3,5,6,7);
$aFilaCompleta = [];
$sRutaProgFile = "./progress/values_prepotencial.txt";
$oFileProgress = fopen($sRutaProgFile,'w'); //archivo para informar progress
for($iCountFile = 1 ; $iCountFile <= $_GET['num_Files'] ; $iCountFile++){
    # Preparar base de datos para que los inserts sean rápidos
    $oBd->beginTransaction();

    # Preparar sentencia de campos
    $sCampos = "raiz, custcode, segmento, concepto, gestion, nota";

    /*$sCampos = "numerodecliente";*/
    $sentencia = $oBd->prepare("INSERT INTO $table (".$sCampos.") 
    VALUES (?, ?, ?, ?, ?, ?)");

    $sRutaCsv = '../csv/prepotencial'. $iCountFile .'.csv';
    $iTotalLineas = f_cuenta_lineasCsv($sRutaCsv);
    $oFileCsv = fopen($sRutaCsv,'r');
    f_putTxt_progress(0,$iCountFile);
    $iCountRows = 0;
    while($lineCsv = fgetcsv($oFileCsv,0,';')){
        $iCountRows++;
        if($iCountRows > 1){
            foreach($aColumnasReq as $col){
                array_push($aFilaCompleta, $lineCsv[$col - 1]);  
            };
            
            try{
                $sentencia->execute($aFilaCompleta);
            }catch(Exception $e){
                echo "<br> Fila ".$iCountRows;
                echo $e->getMessage();
                //http_response_code(400);
                die();
            };
            $aFilaCompleta = [];
            
            //coloca en archivo para informar progreso al cliente
            $iProgress = intval(($iCountRows * 100) / $iTotalLineas);
            if($iProgress % 10 === 0){
                f_putTxt_progress($iProgress, $iCountFile);
            };
        };
    };
    fclose($oFileCsv);
    $oBd->commit();
};
echo "1";
unlink($sRutaProgFile);
f_SetDateTime();



/** 
 * Funcion cuenta registros del csv
 * @param type $sRutaCsv -- ruta del archivo csv el cual contara las líneas
*/
function f_cuenta_lineasCsv($sRutaCsv){
    $iTotallineas = 0;
    $oFileCsv = fopen($sRutaCsv,'r');

    while($lineCsv = fgetcsv($oFileCsv,0,';')){
        $iTotallineas++;
    };
    fclose($oFileCsv);
    return $iTotallineas;
};



/** 
 * funcion escribe valor de progreso y la hoja en curso, en archivo txt
 * @param type $iProgress -- Valor del progreso en %
 * @param type $iCountFile -- Valor de hoja en curso
*/
function f_putTxt_progress($iProgress, $iCountFile){
    global $sRutaProgFile;

    file_put_contents($sRutaProgFile,($iProgress . ',' . $iCountFile));
};

/**
 * funcion guarda registro de ultimo carge de información en la bd
 */
function f_SetDateTime(){
    global $table;
    global $oBd;
    
    //valido existencia de registro de la bd
    $sQuerySelect = "SELECT COUNT(id_dateupdatetables) As cuenta FROM dateupdatetables 
    WHERE table_name = '" . $table."';";

    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();
    $aCount = $sQuerySelect->fetch(PDO::FETCH_BOTH);
    
    //campos BD
    date_default_timezone_set("America/Bogota");
    $cDate = "'".date('Y-m-d H:i:s')."'";

    $sQuerySelect = "SELECT COUNT(*) As cuenta_rows FROM ". $table;
  
    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();

    $iRowsTable = "'".$sQuerySelect->fetch(PDO::FETCH_BOTH)['cuenta_rows']."'";

    if($aCount['cuenta'] === 0){
        $sQueryInsert = "INSERT INTO dateupdatetables (table_name, date_updt, rows_table) VALUES ('".$table."', ".$cDate.", ".$iRowsTable.")";
        $oBd->query($sQueryInsert);
    }else{
        $sQueryUpdate = "UPDATE dateupdatetables SET date_updt = ".$cDate.", rows_table = ".$iRowsTable 
        ."WHERE table_name = '".$table."'";
        $oBd->query($sQueryUpdate);
    };
};

?>