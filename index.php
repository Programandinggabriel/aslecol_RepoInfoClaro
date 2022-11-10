<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
  </script>
  
  <title>Inicio</title>
</head>
<div class='container'>
  <section class='row justify-content-center align-items-center vh-100'>
    <table class='table text-center' style='width: 1000px;' id='bnts_load_files'>
      <th>Archivos</th>
      
      <tr align='center'>
        <td>
          <div class='col-md-2'>
            <button class='btn btn-warning' style='height: 60px; width: 165px;' id='1'>     
              CONSOLIDADO DE DESCARGAS
            </button>
          </div>
        </td>
      </tr>

      <tr align='center'>
        <td>
          <div class='col-md-2'>
            <button class='btn btn-warning' style='height: 60px; width: 165px;' id='2'>
              CIUDADES NORMALIZADO
            </button>
          </div>
        </td>
      </tr>

      <tr align='center'>
        <td>
          <div class='col-md-2'>
            <button class='btn btn-warning' style='height: 60px; width: 165px;' id='3'>
              ASCARD
            </button>
          </div>
        </td>
      </tr>
    </table>
  </section>
</div>

<script src='js/main.js'></script>
</html>