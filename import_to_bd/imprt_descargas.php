<?php 
require_once "../bd_conect/bd.php";
//require_once "../bd_conect/bd_postgre.php";

$bd = obtenerBD();

#array con las columnas necesarias
$columnasReq = array(1, 2, 3, 32, 4, 9, 13, 12, 15, 19, 20, 21, 22, 23, 25, 27, 29, 33, 34, 17, 5, 6, 7, 48, 47, 50, 45, 26);
$filaCompleta = []; 

for($archivo = 1 ; $archivo <= ($_GET['num_Files']) ; $archivo++){
    # Preparar base de datos para que los inserts sean rápidos
    $bd->beginTransaction();

    # Preparar sentencia de campos
    $campos = "numerodecliente, accountcode, crmorigen, numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, 
    fechadeasignacion, email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, direccioncompleta, 
    potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, activeslines, preciosubscripcion, accstsname";

    /*$campos = "numerodecliente";*/
    $sentencia = $bd->prepare("INSERT INTO consoldescar (".$campos.") 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $rutaCsv = '../csv/consolidado_descargas'. $archivo .'.csv';
    $fileCsv = fopen($rutaCsv,'r');
    $countLine = 0;

    while($lineCsv = fgetcsv($fileCsv,0,';')){
        $countLine++;
        if($countLine > 1){
            foreach($columnasReq as $col){
                array_push($filaCompleta, $lineCsv[$col - 1]);  
            };
            
            try{
                $sentencia->execute($filaCompleta);
            }catch(Exception $e){
                echo "<br> Fila ".$countLine;
                echo $e->getMessage();
            };
            
            $filaCompleta = [];
        };

    };
    $bd->commit();
    fclose($fileCsv);
    echo "Subido correctamente";
};
?>