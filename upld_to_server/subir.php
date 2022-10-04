<?php
    $nombre_temporal = $_FILES['archivo']['tmp_name'];
    $nombre = $_FILES['archivo']['name'];
<<<<<<< HEAD
    move_uploaded_file($nombre_temporal, 'xlsx/'.$nombre);
=======
    move_uploaded_file($nombre_temporal, '../xlsx/'.$nombre);
>>>>>>> pruebas
?>