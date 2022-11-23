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

<div class='container p-3'>
  <section class='row justify-content-center align-items-center vh-100'>
    <div class='col'>
      <div style='height:500px; width: 800px; overflow-y: auto; overflow-x: hidden;'>
        <table class='table text-center' style='width: 800px;' id='bnts_load_files'>
          <th>Archivos</th>
          <th>Fecha última carga</th>

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
                  PREPOTENCIAL
                </button>
              </div>
            </td>
          </tr>

          <tr align='center'>
            <td>
              <div class='col-md-2'>
                <button class='btn btn-warning' style='height: 60px; width: 165px;' id='3'>
                  CIUDADES NORMALIZADO
                </button>
              </div>
            </td>
          </tr>

          <tr align='center'>
            <td>
              <div class='col-md-2'>
                <button class='btn btn-warning' style='height: 60px; width: 165px;' id='4'>
                  ASCARD
                </button>
              </div>
            </td>
          </tr>

          <tr align='center'>
            <td>
              <div class='col-md-2'>
                <button class='btn btn-warning' style='height: 60px; width: 165px;' id='5'>
                  EXCLUSIÓN DE DESCUENTO
                </button>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <div class='col'>
      <div class='row justify-content-center'>
      <h4 class='text-center' id='status_file'>Crear archivo</h4>  
      <button class='btn btn-success' style='width: 400px; height: 50px;' id='start'>
          INICIAR PROCEDIMIENTO
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="40" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
            <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
          </svg>
        </button>
      </div>
    </div>
  </section>
</div>

<script src='js/main.js'></script>
</html>