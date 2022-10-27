<?php
    $nombre_temporal = $_FILES['archivo']['tmp_name'];
    $nombre = $_FILES['archivo']['name'];
    move_uploaded_file($nombre_temporal, '../csv/'.$nombre);
?>