<?php 
require_once "../bd_conect/bd.php";
//require_once "../bd_conect/bd_postgre.php";

$bd = obtenerBD();

#array con las columnas necesarias
$columnasReq = array(1,2,3,4,5);
$filaCompleta = []; 

for($archivo = 1 ; $archivo <= ($_GET['num_Files']) ; $archivo++){
    $rutaCsv = '../csv/ascard'. $archivo .'.csv';
    $fileCsv = fopen($rutaCsv,'r');
    $countRows = 0;

    # Preparar base de datos para que los inserts sean rápidos
    $bd->beginTransaction();

    # Preparar sentencia de campos
    $campos = "numerocredito, referenciapago, marca, tipo, producto";

    /*$campos = "numerodecliente";*/
    $sentencia = $bd->prepare("INSERT INTO ascard (".$campos.") 
    VALUES (?, ?, ?, ?, ?)");

    while($lineCsv = fgetcsv($fileCsv,0,';')){
        $countRows++;
        if($countRows > 1){
            foreach($columnasReq as $col){
                array_push($filaCompleta, $lineCsv[$col - 1]);  
            };
            
            try{
                $sentencia->execute($filaCompleta);
            }catch(Exception $e){
                echo "<br> Fila ".$countRows;
                echo $e->getMessage();
            };
            $filaCompleta = [];
        };
    };
    fclose($fileCsv);
    $bd->commit();
    echo "Subido correctamente";
};
?>