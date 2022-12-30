<?php 
  include('../bd_conect/bd.php');
  $oBd = obtenerBD()
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv='cache-control' content='no-cache'> 
  <meta http-equiv='expires' content='0'> 
  <meta http-equiv='pragma' content='no-cache'>  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
  </script>

  <title>Aplicar descuentos</title>
</head>
<body>
  <section class='container mt-5'>
    <div class='row-justify-content-center'>
      <h1 class='text-center'>Aplicar descuentos $</h1>
      <div class='col'><!--columna-->
        <form class='mt-5' method='post' action=''>
          <label class='row-1' style='font-size:22px;'>Tipo de cuenta:</label>
          <div class='row-2'> 
            <select class='mx-1' style='height: 40px; width: 150px; font-size:20px;'>
              <?php
                $sQuerySelect = "SELECT distinct(crmorigen) As tipoCliente FROM infofechaxx";
                $sQuerySelect = $oBd->prepare($sQuerySelect);
                $sQuerySelect->execute();

                while($aResult = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
                  echo "<option>".$aResult['tipoCliente']."</option>";
                };
              ?>
            </select>
          </div>

          <label class='row-1 mt-3' style='font-size:22px;'>Campaña:</label>
          <div class='row-2'> 
            <select class='mx-1' style='height: 40px; width: 150px; font-size:20px;'>
              <?php
                $sQuerySelect = "SELECT distinct(debtageinicial) As campanna FROM infofechaxx";
                $sQuerySelect = $oBd->prepare($sQuerySelect);
                $sQuerySelect->execute();

                while($aResult = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
                  echo "<option>".$aResult['campanna']."</option>";
                };
              ?>
            </select>
          </div>

          <label class='row-1 mt-3' style='font-size:22px;'>Cartera:</label>
          <div class='row-2'> 
            <select class='mx-1' style='height: 40px; width: 150px; font-size:20px;'>
              <?php
                $sQuerySelect = "SELECT distinct(cartera) As cartera FROM infofechaxx";
                $sQuerySelect = $oBd->prepare($sQuerySelect);
                $sQuerySelect->execute();

                while($aResult = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
                  echo "<option>".$aResult['cartera']."</option>";
                };
              ?>
            </select>
          </div>

          <label class='row-1 mt-3' style='font-size:22px;'>Verificacion pyme:</label>
          <div class='row-2'> 
            <select class='mx-1' style='height: 40px; width: 150px; font-size:20px;'>
              <option>Vacío</option>
              <?php
                $sQuerySelect = "SELECT distinct(verificacion_pyme) As pyme FROM infofechaxx";
                $sQuerySelect = $oBd->prepare($sQuerySelect);
                $sQuerySelect->execute();

                while($aResult = $sQuerySelect->fetch(PDO::FETCH_BOTH)){
                  echo "<option>".$aResult['pyme']."</option>";
                };
              ?>
            </select>
          </div>
        <form>
      </div>
    </div>
  </section>
</body>

<script src='../js/forms/form_dcto.js'></script>
</html>