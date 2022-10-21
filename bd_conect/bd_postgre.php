<?php 
//bd postgresql, por objeto PDO
function obtenerBD(){
    
    $contraseña = "postgres";
    $usuario = "postgres";
    $nombreBaseDeDatos = "dataprocclaro";
    # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
    $rutaServidor = "10.10.0.72";
    $puerto = "5432";
    
    try {
        
        $base_de_datos = new PDO("pgsql:host=localhost;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $contraseña);
        $base_de_datos->query("set names utf8;");
        $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        return $base_de_datos;

    } catch (Exception $e) {

        echo "Ocurrió un error con la base de datos: " . $e->getMessage();
    
    };
};

?>