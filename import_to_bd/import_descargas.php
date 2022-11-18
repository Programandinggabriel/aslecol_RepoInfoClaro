<?php 
require_once "../bd_conect/bd.php";

$bd = obtenerBD();

#array con las columnas necesarias
$aColumnasReq = array(1, 2, 3, 32, 4, 9, 13, 12, 15, 19, 20, 21, 22, 23, 25, 27, 29, 33, 34, 17, 5, 6, 7, 48, 47, 50, 45, 26);
$aFilaCompleta = []; 
$sProgressFile = "./progress/values_descargas.txt";#archivo para informar progress
for($iCountFile = 1 ; $iCountFile <= $_GET['num_Files'] ; $iCountFile++){
    # Preparar base de datos para que los inserts sean rápidos
    $bd->beginTransaction();

    # Preparar oSentencia de campos
    $campos = "numerodecliente, accountcode, crmorigen, numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, 
    fechadeasignacion, email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, direccioncompleta, 
    potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, activeslines, preciosubscripcion, accstsname";

    /*$campos = "numerodecliente";*/
    $oSentencia = $bd->prepare("INSERT INTO consoldescar (".$campos.") 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $sRutaCsv = '../csv/consolidado_descargas'. $iCountFile .'.csv';
    $iTotalLineas = f_cuenta_lineasCsv($sRutaCsv);
    $oFileCsv = fopen($sRutaCsv,'r');
    f_putTxt_progress(0,$iCountFile);
    $iCountRows = 0;
    while($lineCsv = fgetcsv($oFileCsv,0,';')){
        $iCountRows++;
        if($iCountRows > 1){
            foreach($aColumnasReq as $vCol){
                array_push($aFilaCompleta, $lineCsv[$vCol - 1]);  
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
file_put_contents($sProgressFile, "");

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
    global $sProgressFile;

    file_put_contents($sProgressFile,($iProgress . ',' . $iCountFile));
};
?>