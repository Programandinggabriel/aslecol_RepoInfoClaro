<?php

require_once '../bd_conect/bd.php';

#query PDO

$bd = obtenerBD();

$query_insert = "INSERT INTO infofechaxx (id_infofechaxx, numerodecliente, accountcode, crmorigen, 
                numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, fechadeasignacion, 
                email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, 
                direccioncompleta, potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, 
                activeslines, preciosubscripcion, accstsname) 
                SELECT * FROM consoldescar;";

$query_Trunc = "TRUNCATE TABLE consoldescar;";

//arreglar campo modinitcta cambiar decimales a miles 
// y convertir a entero
$query_up  = "UPDATE infofechaxx SET modinitcta = REPLACE(modinitcta, ',', '.')";
$query_up  = "UPDATE infofechaxx SET modinitcta = ROUND(CAST(infofechaxx.modinitcta AS NUMERIC), 0)";

//campo ASIGNACIÓN
$query_up = "UPDATE infofechaxx SET asignacion = 'GEVENUE'";

//campo verificacion_pyme
$query_up = "UPDATE infofechaxx 
            SET verificacion_pyme = 'PYME HFC'
            WHERE customertypeid IN ('82','85','88') 
            AND  lower(crmorigen) IN ('ascard', 'bscs', 'rr');";

$query_up = "UPDATE infofechaxx 
            SET verificacion_pyme = 'PYME FO'
            WHERE customertypeid IN ('82','85','88') 
            AND  lower(crmorigen) = 'sga';";

//campo cartera
$query_up = "UPDATE infofechaxx 
            SET cartera = 'REFINANCIADOS' 
            WHERE lower(refinanciedmark) LIKE 'y';"; 

$query_up = "UPDATE infofechaxx SET 
            cartera =  
            (CASE 
                WHEN lower(crmorigen) = 'ascard' THEN 'PROVISIÓN' 
                WHEN lower(crmorigen) = 'bscs' THEN 'POTENCIAL'
                WHEN lower(crmorigen) = 'RR' THEN 'CHURN'
            END) 
            WHERE lower(potencialmark) LIKE 'y';";

$query_up = "UPDATE infofechaxx SET 
            cartera =  
            (CASE 
                WHEN lower(crmorigen) = 'ascard' THEN 'PROVISIÓN' 
                WHEN lower(crmorigen) = 'bscs' THEN 'POTENCIAL'
                WHEN lower(crmorigen) = 'RR' THEN 'PRECHURN'
            END) 
            WHERE lower(prepotencialmark) LIKE 'y';";

$query_up ="UPDATE infofechaxx 
            SET cartera = 'CASTIGO' 
            WHERE lower(writeoffmark) LIKE 'y';";


$query_up ="UPDATE infofechaxx 
            SET cartera = debtageinicial 
            WHERE  cartera IS NULL;";

//----------------CRUZE CON acumulado de ciudades (ARCHIVO EXCEL)-----------------------------//

//campo region e indicativo
/*-- tabla a modificar
-- tabla de donde se obtienen datos
-- campos que se quieren modificar*/

$query_up ="UPDATE infofechaxx AS info1
            SET region = ciudades.region,
            indicativo = ciudades.indicativos
            FROM acumciudades AS ciudades 
            WHERE ciudades.ciudadLlave = info1.ciudad AND 
            length(info1.ciudad) != 0; ";

$query_up = "UPDATE infofechaxx SET region = 'Sin Region', indicativo = '' 
             WHERE ciudad = '' OR region = 'Sin Region';";

//campo rango
//-------------------rango de las carteras-------------------------------------------//
$query_up = "UPDATE infofechaxx SET rango = 
            (CASE 
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 25000 THEN 'MENOR A 25' 
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 30000 THEN 'ENTRE 25 Y 30'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 35000 THEN 'ENTRE 30 Y 35'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 40000 THEN 'ENTRE 35 Y 40'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 45000 THEN 'ENTRE 40 Y 45'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 50000 THEN 'ENTRE 45 Y 50'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 75000 THEN 'ENTRE 50 Y 75'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 100000 THEN 'ENTRE 75 Y 100'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 150000 THEN 'ENTRE 100 Y 150'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 200000 THEN 'ENTRE 150 Y 200'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 250000 THEN 'ENTRE 200 Y 250'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) < 300000 THEN 'ENTRE 250 Y 300'
                WHEN CAST(infofechaxx.modinitcta AS NUMERIC) >= 300000 THEN 'MAYOR A 300'
            END);";
           
//----------------CRUZE CON ascard (ARCHIVO EXCEL)-----------------------------//
//campo ASCARD 
$query_up = "UPDATE infofechaxx As info
             SET ascard = ascard.producto
             FROM ascard
             WHERE ascard.numerocredito = info.accountcode;";

//campo EXCLUSIÓN
$query_up = "UPDATE infofecha As info 
             SET exclusion = dcto.nota 
             FROM exclusiondcto As dcto 
             WHERE dcto.cuenta = info.accountcode";

?>
