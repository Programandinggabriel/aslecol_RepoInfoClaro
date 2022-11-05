<?php

require_once '../bd_conect/bd.php';

#query PDO

$bd = obtenerBD();

$query_insert = "INSERT INTO infofechaxx (id_infofechaxx, numerodecliente, accountcode, crmorigen, 
numeroreferenciadepago, edaddedeuda, modinitcta, debtageinicial, nombrecampaña, fechadeasignacion, 
email, telefono1, telefono2, telefono3, telefono4, documento, ciudad, nombredelcliente, min, plan, 
direccioncompleta, potencialmark, prepotencialmark, writeoffmark, refinanciedmark, customertypeid, 
activeslines, preciosubscripcion, accstsname) 
SELECT * FROM consoldescar;

TRUNCATE TABLE consoldescar;";

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
WHERE lower(writeoffmark) LIKE 'Y';";

$query_up ="UPDATE infofechaxx 
SET cartera = debtageinicial 
WHERE  cartera IS NULL;";


//--------INICIO CRUZE CON ARCHIVOS EXTERNOS--------//


?>