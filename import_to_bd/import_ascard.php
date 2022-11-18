<?php 
require_once "../bd_conect/bd.php";

$bd = obtenerBD();

#array con las columnas necesarias
$sProgressFile = "./progress/values_ascard.txt";#archivo para informar progress 
$aColumnasReq = array(1,2,3,4,5);
$aFilaCompleta = [];
for($iCountFile = 1 ; $iCountFile <= $_GET['num_Files'] ; $iCountFile++){
    # Preparar base de datos para que los inserts sean rápidos
    $bd->beginTransaction();

    # Preparar sentencia de campos
    $sCampos = "numerocredito, referenciapago, marca, tipo, producto";

    /*$sCampos = "numerodecliente";*/
    $sentencia = $bd->prepare("INSERT INTO ascard (".$sCampos.") 
    VALUES (?, ?, ?, ?, ?)");

    $sRutaCsv = '../csv/ascard'. $iCountFile .'.csv';
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
    $bd->commit();
};
echo "1";
file_put_contents($sProgressFile, "");


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
    global $sProgressFile;

    file_put_contents($sProgressFile,($iProgress . ',' . $iCountFile));
};

?>