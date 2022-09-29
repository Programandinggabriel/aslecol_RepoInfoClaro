<?php
/**
 * Ejemplo de cómo usar PDO y PHPSpreadSheet para
 * importar datos de Excel a MySQL de manera
 * fácil, rápida y segura
 *
 * @author parzibyte
 * @see https://parzibyte.me/blog/2019/02/14/leer-archivo-excel-php-phpspreadsheet/
 * @see https://parzibyte.me/blog/2018/02/12/mysql-php-pdo-crud/
 * @see https://parzibyte.me/blog/2019/02/16/php-pdo-parte-2-iterar-cursor-comprobar-si-elemento-existe/
 * @see https://parzibyte.me/blog/2018/11/08/crear-archivo-excel-php-phpspreadsheet/
 * @see https://parzibyte.me/blog/2018/10/11/sintaxis-corta-array-php/
 *
 */

# Cargar clases instaladas por Composer
require_once "../vendor/autoload.php";

# Nuestra base de datos
require_once "../msql_conect/bd.php";

# Indicar que usaremos el IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory;

# Obtener conexión o salir en caso de error, mira bd.php
$bd = obtenerBD();

# El archivo a importar
# Recomiendo poner la ruta absoluta si no está junto al script
$rutaArchivo = "../xlsx/consoldescarg05sept2021.xlsx";
$docInfo = IOFactory::load($rutaArchivo);

# Preparar base de datos para que los inserts sean rápidos
$bd->beginTransaction();

# Preparar sentencia de productos
$campos = "numerodecliente, accountcode, crmorigen, numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, 
fechadeasignacion, email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, direccioncompleta, 
potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, activeslines, preciosubscripcion, accstsname";

/*$campos = "numerodecliente";*/
$sentencia = $bd->prepare("INSERT INTO consoldescar (".$campos.") 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

#Rvecorremos hojas
$totalHojas = $docInfo->getSheetCount();
for($indiceHoja = 0 ; $indiceHoja < ($totalHojas) ; $indiceHoja++){

    $hojaAct = $docInfo->getSheet($indiceHoja);
    # Calcular el máximo valor de la fila como entero, es decir, el
    # límite de nuestro ciclo
    $numeroMayorDeFila = $hojaAct->getHighestRow(); // Numérico
    $letraMayorDeColumna = $hojaAct->getHighestColumn(); // Letra
    $numeroMayorDeColumna = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($letraMayorDeColumna); # Convertir la letra al número de columna correspondiente
    
    #array con las columnas necesarias
    $columnasReq = array(1, 2, 3, 32, 4, 9, 13, 12, 15, 19, 20, 21, 22, 23, 25, 27, 29, 33, 34, 17, 5, 6, 7, 48, 47, 50, 45, 26);
    $filaCompleta = []; 

    $terminado = false;
    $indiceFila = 2; //recorre las filas
    $limitFilas = 100;
    while ($terminado == false){

        $rangoFilas = ($indiceFila + $limitFilas); //indice donde termina el rango
        
        #evalua existencia de rango de 100 filas
        if($rangoFilas <= $numeroMayorDeFila){
            
            #evalua que ya se hayan tomado 100 filas y actualiza el indice
            if($rangoFilas >= 100){
                
                $indiceFila = $rangoFilas;
                

            };

        }else{

            $rangoFilas = $numeroMayorDeFila;
        
        };
        
        #Recorrer filas
        for ($filaActual = $indiceFila; $filaActual <= $rangoFilas; $filaActual++) {

            #Recorrer columnas
            for($indiceCol = 0; $indiceCol <= (count($columnasReq)-1); $indiceCol++){
                
                $dataCelda = $hojaAct->getCellByColumnAndRow($columnasReq[($indiceCol)], $filaActual);
                array_push($filaCompleta, $dataCelda);

            };

            try{
                
                $sentencia->execute($filaCompleta);
            
            }catch(Exception $e){
                
                echo "<br>".$filaActual;
            
            };

            $filaCompleta = []; //reset a fila 
        
        };
        
        $bd->commit();
        
        echo "<strong> Se han subido ". $rangoFilas ."</strong>";
        //sleep(1);

        if($rangoFilas == $numeroMayorDeFila){

            $terminado = true;

        };
    
    };
    
    
};