<?php

require_once '../bd_conect/bd.php';
$oBD = obtenerBD();

//hoja donde pondra estado de las consultas
$sRutaTxtEstado = './status_mysqli.txt';
fopen($sRutaTxtEstado, 'w');

$query_insert = "INSERT INTO infofechaxx (id_infofechaxx, numerodecliente, accountcode, crmorigen, 
                numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, fechadeasignacion, 
                email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, 
                direccioncompleta, potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, 
                activeslines, preciosubscripcion, accstsname) 
                SELECT * FROM consoldescar;";
f_RunQuery_PutState($query_insert, 0);

$query_Trunc = "TRUNCATE TABLE consoldescar;";
//f_RunQuery_PutState($query_Trunc, 0);

//arreglar campo modinitcta cambiar decimales a miles 
// y convertir a entero
$query_up  = "UPDATE infofechaxx SET modinitcta = REPLACE(modinitcta, ',', '.')";
f_RunQuery_PutState($query_up, 1);

$query_up  = "UPDATE infofechaxx SET modinitcta = ROUND(modinitcta, 0);";
f_RunQuery_PutState($query_up, 1);

//campo ASIGNACIÓN
$query_up = "UPDATE infofechaxx SET asignacion = 'GEVENUE'";
f_RunQuery_PutState($query_up, 2);

//campo verificacion_pyme
$query_up = "UPDATE infofechaxx 
            SET verificacion_pyme = 'PYME HFC'
            WHERE customertypeid IN ('82','85','88') 
            AND  lower(crmorigen) IN ('ascard', 'bscs', 'rr');";
f_RunQuery_PutState($query_up, 3);

$query_up = "UPDATE infofechaxx 
            SET verificacion_pyme = 'PYME FO'
            WHERE customertypeid IN ('82','85','88') 
            AND  lower(crmorigen) = 'sga';";
f_RunQuery_PutState($query_up, 3);

//campo cartera
$query_up = "UPDATE infofechaxx 
            SET cartera = 'REFINANCIADOS' 
            WHERE lower(refinanciedmark) LIKE 'y';"; 
f_RunQuery_PutState($query_up, 4);

$query_up = "UPDATE infofechaxx SET 
            cartera =  
            (CASE 
                WHEN lower(crmorigen) = 'ascard' THEN 'PROVISIÓN' 
                WHEN lower(crmorigen) = 'bscs' THEN 'POTENCIAL'
                WHEN lower(crmorigen) = 'RR' THEN 'CHURN'
            END) 
            WHERE lower(potencialmark) LIKE 'y';";
f_RunQuery_PutState($query_up, 4);

$query_up = "UPDATE infofechaxx SET 
            cartera =  
            (CASE 
                WHEN lower(crmorigen) = 'ascard' THEN 'PROVISIÓN' 
                WHEN lower(crmorigen) = 'bscs' THEN 'POTENCIAL'
                WHEN lower(crmorigen) = 'RR' THEN 'PRECHURN'
            END) 
            WHERE lower(prepotencialmark) LIKE 'y';";
f_RunQuery_PutState($query_up, 4);

$query_up ="UPDATE infofechaxx 
            SET cartera = 'CASTIGO' 
            WHERE lower(writeoffmark) LIKE 'y';";
f_RunQuery_PutState($query_up, 4);

$query_up ="UPDATE infofechaxx 
            SET cartera = debtageinicial 
            WHERE  cartera IS NULL;";
f_RunQuery_PutState($query_up, 4);

//----------------INICIO CRUCES------------------------------------//
//----------------CRUZE CON acumulado de ciudades (ARCHIVO EXCEL)-----------------------------//

//campo region e indicativo
/*-- tabla a modificar
-- tabla de donde se obtienen datos
-- campos que se quieren modificar*/

$query_up ="UPDATE infofechaxx AS info
            LEFT JOIN acumciudades AS ciudades 
            ON ciudades.ciudadLlave = info.ciudad
            SET info.region = ciudades.region, 
            info.indicativo = ciudades.indicativos
            WHERE length(info.ciudad) != 0;";
f_RunQuery_PutState($query_up, 5);

$query_up = "UPDATE infofechaxx SET region = 'Sin Region', indicativo = '' 
             WHERE ciudad = '' OR region = 'Sin Region';";
f_RunQuery_PutState($query_up, 5);

//campo rango
//-------------------rango de las carteras-------------------------------------------//
$query_up = "UPDATE infofechaxx SET rango = (CASE 
                WHEN modinitcta < 25000 THEN 'MENOR A 25' 
                WHEN modinitcta < 30000 THEN 'ENTRE 25 Y 30'
                WHEN modinitcta < 35000 THEN 'ENTRE 30 Y 35'
                WHEN modinitcta < 40000 THEN 'ENTRE 35 Y 40'
                WHEN modinitcta < 45000 THEN 'ENTRE 40 Y 45'
                WHEN modinitcta < 50000 THEN 'ENTRE 45 Y 50'
                WHEN modinitcta < 75000 THEN 'ENTRE 50 Y 75'
                WHEN modinitcta < 100000 THEN 'ENTRE 75 Y 100'
                WHEN modinitcta < 150000 THEN 'ENTRE 100 Y 150'
                WHEN modinitcta < 200000 THEN 'ENTRE 150 Y 200'
                WHEN modinitcta < 250000 THEN 'ENTRE 200 Y 250'
                WHEN modinitcta < 300000 THEN 'ENTRE 250 Y 300'
                WHEN modinitcta >= 300000 THEN 'MAYOR A 300'
            END);";
f_RunQuery_PutState($query_up, 6);

//----------------CRUZE CON ascard (ARCHIVO EXCEL)-----------------------------//
//campo ASCARD 
$query_up = "UPDATE infofechaxx 
             LEFT JOIN ascard ON 
             ascard.numerocredito = infofechaxx.accountcode 
             SET infofechaxx.ascard = ascard.producto";
f_RunQuery_PutState($query_up, 7);

//----------------CRUZE CON exclusión dcto (ARCHIVO EXCEL)-----------------------------//
//campo EXCLUSIÓN
$query_up  = "UPDATE infofechaxx as info
              LEFT JOIN exclusiondcto as dcto ON 
              dcto.cuenta = info.accountcode 
              SET info.exclusion = dcto.nota";
f_RunQuery_PutState($query_up, 8);

unlink($sRutaTxtEstado);


/**
 * Ejecuta una query con el pdo, envía a el archivo de salida el estado el cual
 * sera leido por el cliente
 * 
 * @param type $sQuery --Query a ejecutar
 * @param type $id_Estado --Id del estado actual de la ejecución
 */
function f_RunQuery_PutState( $sQuery, $iEstado){
    global $sRutaTxtEstado;
    global $oBD;
   
    file_put_contents($sRutaTxtEstado, $iEstado);
    $iRowsAffected = $oBD->exec($sQuery);
};

?>
