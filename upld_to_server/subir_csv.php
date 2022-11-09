<?php
    //echo $_FILES['archivo']['name'];
    
    
    $ruta_temp = $_FILES['archivo']['tmp_name'];
    $nombre_archivo = $_FILES['archivo']['name'];
    $ruta_destino = '../csv/';

    move_uploaded_file($ruta_temp, $ruta_destino . $nombre_archivo);
    
?>