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
  <section class='container-fluid' style='padding: 100px;'>
    <div class='row'>
      <h1 class='text-center'>Aplicar descuentos $</h1>
      <form class='mt-5 col-5' style='font-size: 25px;' id='frm_dctos'>
        <div class='form-row'>
          <div class='form-group col-md-6'>
            <label for='lstTipoDeCta'>Tipo de cuenta (crmorigen) </label>
            <select class='form-control' name='listOption' id='tipoCta'>
            <option>Seleccione</option>
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
        
        <div class="form-group col-md-6 mt-2">
         <label for="">Campaña (debtageinicial)</label>
         <select class='form-control mx-1' name='listOption' id='campanna'>
          <option>Seleccione</option>
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

        <div class="form-group col-md-6 mt-2">
         <label for="">Cartera (cartera)</label>
         <select class='form-control mx-1' name='listOption'  id='cartera'>
         <option>Seleccione</option>
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

        <div class="form-group col-md-6 mt-2">
         <label for="">Verificación pyme(verificacion pyme)</label>
         <select class='form-control mx-1' name='listOption' id='verifPyme'>
         <option>Seleccione</option>
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

        <div class="form-group row-md-3 mt-3">
          <label class='col' for="">Valor descuento</label><br>
          <input class='col-5' type='range' min='0' max='100' step='10' value='0' name='val_dcto' id='val_dcto'></input>
          <label class='col-form-label' id='lbl_dcto'>%DCTO</label>
        </div>

        <div class='form-group col-2'>
          <button class='form-control btn btn-primary mt-3' style='width: 150px; height: 50px;' type='button' id='btn_save'>Agregar</button>
        </div>
      </form>
    </div>
    
    <div class='col-7 mt-5'>
      <?php 
        $sQuerySelect = "SELECT COUNT(id_descuento) as cuenta FROM descuentos"; 
        
        $sQuerySelect = $oBd->prepare($sQuerySelect);
        $sQuerySelect->execute();
        $iCount = $sQuerySelect->fetch(PDO::FETCH_BOTH)['cuenta'];

        if($iCount >= 1){
          echo "<div class='row justify-content-start'>
                  <button class='col-2 btn btn-info' onclick='f_loadDctos()'>
                    <b>Descuentos guardados</b>
                  </button>
                </div> ";
        };
      ?>
      <div style='overflow-x: hidden; height: 400px;'>
        <div class='table-responsive'>
          <table class='table text-center' style='font-size: 20px;' id='tb_dctos'>
            <tbody>
              <tr id='0'>
                <th>Descuento</th>
                <th>Tipo de cuenta</th>
                <th>Campaña</th>
                <th>Cartera</th>
                <th>Verificación pyme</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class='row justify-content-end'>
        <button class='btn btn-success' style='width: 150px; height: 50px;' type='button' id='btn_submit'>Continuar</button> 
      </div>
    </div>
  </section>
</body>

<script src='../js/forms/form_dcto.js'></script>
</html>