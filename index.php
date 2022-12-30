<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <!--sweet alert-->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous">
  </script>
  
  <title>Inicio</title>
</head>

<div class='container p-3'>
  <section class='row justify-content-center align-items-center vh-100'>
    <div style='height: 600px; width: 1000px; overflow-y: auto; overflow-x: hidden;'>
      <table class='table text-center' style='width: 1000px; font-size: 20px;' id='load_files'>
        <th>Archivo</th>
        <th>Acción</th>
        <th>Información</th>

        <tr align='center' id='1'>
          <td>
            <strong>CONSOLIDADO DE DESCARGAS</strong>
          </td>  
          
          <td>  
            <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='1'>
              Editar
            </button>
            <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id = '1'> 
              Eliminar
            </button>
          </td>
        </tr>

        <tr align='center' id='2'>
          <td>
            <strong>PREPOTENCIAL</strong>
          </td>  
          
          <td>  
            <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='2'>
              Editar
            </button>
            <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='2'>
              Eliminar
            </button>
          </td>
        </tr>

        <tr align='center' id='3'>
          <td>
            <strong>CIUDADES NORMALIZADO</strong>
          </td>  
          
          <td>  
            <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='3'>
              Editar
            </button>
            <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='3'>
              Eliminar
            </button>
          </td>
        </tr>

        <tr align='center' id='4'>
          <td>
            <strong>ASCARD</strong>
          </td>  
          
          <td>  
            <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='4'>
              Editar
            </button>
            <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='4'>
              Eliminar
            </button>
          </td>
        </tr>

        <tr align='center' id='5'>
          <td>
            <strong>EXCLUSIÓN DE DESCUENTO</strong>
          </td>  
          
          <td>  
            <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='5'>
              Editar
            </button>
            <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='5'>
              Eliminar
            </button>
          </td>
        </tr>
      </table>
      
      <div class='row justify-content-end'>
        <div class='col-3'>
          <h4 class='text-center' style='width:200px; height:20px;' id='status_file'></h4>  
          <button class='col-3 btn btn-outline-success' style='width:200px; height:50px; font-size:20px;' id='start'>
            Crear archivo 
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM7.86 14.841a1.13 1.13 0 0 0 .401.823c.13.108.29.192.479.252.19.061.411.091.665.091.338 0 .624-.053.858-.158.237-.105.416-.252.54-.44a1.17 1.17 0 0 0 .187-.656c0-.224-.045-.41-.135-.56a1.002 1.002 0 0 0-.375-.357 2.028 2.028 0 0 0-.565-.21l-.621-.144a.97.97 0 0 1-.405-.176.37.37 0 0 1-.143-.299c0-.156.061-.284.184-.384.125-.101.296-.152.513-.152.143 0 .266.023.37.068a.624.624 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.093 1.093 0 0 0-.199-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.552.05-.777.15-.224.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.123.524.082.149.199.27.351.367.153.095.332.167.54.213l.618.144c.207.049.36.113.462.193a.387.387 0 0 1 .153.326.512.512 0 0 1-.085.29.558.558 0 0 1-.255.193c-.111.047-.25.07-.413.07-.117 0-.224-.013-.32-.04a.837.837 0 0 1-.249-.115.578.578 0 0 1-.255-.384h-.764Zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Zm1.923 3.325h1.697v.674H5.266v-3.999h.791v3.325Zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036l.823-1.438Z"/>
            </svg>
          </button>
        </div>
      </div>
  </section>
</div>

<script src='js/main.js' type='module'></script>
</html>