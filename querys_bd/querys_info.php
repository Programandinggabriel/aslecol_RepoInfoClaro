<?php

require_once '../bd_conect/bd.php';

#query PDO

$bd = obtenerBD();

$query = "UPDATE infofechaxx 
SET verificacion_pyme = 'PYME HFC'
WHERE customertypeid IN ('82','85','88') 
AND  lower(crmorigen) IN ('ascard', 'bscs', 'rr');";


?>