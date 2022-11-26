<?php 
require_once "../bd_conect/bd.php";

$bd = obtenerBD();

#array con las columnas necesarias
$aColumnasReq = array(1, 2, 3);
$aFilaCompleta = []; 
$sRutaProgFile = "./progress/values_exclusiondcto.txt";
$oFileProgress = fopen($sRutaProgFile,'w'); //archivo para informar progress
for($iCountFile = 1 ; $iCountFile <= $_GET['num_Files'] ; $iCountFile++){
    # Preparar base de datos para que los inserts sean rápidos
    $bd->beginTransaction();

    # Preparar oSentencia de campos
    $campos = "cuenta, segmento, nota";

    /*$campos = "numerodecliente";*/
    $oSentencia = $bd->prepare("INSERT INTO exclusiondcto (".$campos.") 
                                VALUES (?, ?, ?)");
    
    $sRutaCsv = '../csv/exclusiondcto'. $iCountFile .'.csv';
    $iTotalLineas = f_cuenta_lineasCsv($sRutaCsv);
    $oFileCsv = fopen($sRutaCsv,'r');
    f_putTxt_progress(0,$iCountFile);
    $iCountRows = 0;
    while($lineCsv = fgetcsv($oFileCsv,0,';')){
        $iCountRows++;
        if($iCountRows > 1){
            foreach($aColumnasReq as $iCol){
                array_push($aFilaCompleta, $lineCsv[$iCol - 1]);  
            };
            
            try{
                $oSentencia->execute($aFilaCompleta);
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
    $bd->commit();
};
echo "1";
unlink($sRutaProgFile);
f_SetDateTime();

//Funcion cuenta registros del csv
/** 
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
 * funcion guarda registro de ultimo carge de información
 */
function f_SetDateTime(){
    global $oBd;
    $sQuerySelect = "SELECT COUNT(id_fechcargarch) As cuenta FROM fechcargarch 
    WHERE table_name = 'exclusiondcto'";

    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();
    $aCount = $sQuerySelect->fetch(PDO::FETCH_BOTH);
    
    date_default_timezone_set("America/Mexico_City");
    $cDate = "'".date('Y-m-d H:i:s')."'";

    if($aCount['cuenta'] === 0){
        $sQueryInsert = "INSERT INTO fechcargarch (table_name, fecha_carga) VALUES ('exclusiondcto', ".$cDate."')";
        $oBd->query($sQueryInsert);
    }else{
        $sQueryUpdate = "UPDATE fechcargarch SET fecha_carga = " . $cDate;
        $oBd->query($sQueryUpdate);
    };

};

?>