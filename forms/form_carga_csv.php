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
  crossorigin="anonymous"></script>
  <script src="../js/form_carga_.js"></script>

  <title>Subir Archivos</title>
</head>

<body>
<h1 class="row justify-content-center mt-5">Subir consolidado_descargas</h1>

<div class="container mt-5">  

  <div class='row justify-content-center mt-5'>
    <h5>Carga nuevo:</h5>
    <button class='col-2 offset-1 btn btn-warning' id='add_file'>  Carga nuevo
      <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="mx-2 bi bi-filetype-csv" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z"/>
      </svg>
    </button>
    <button class='col-2 offset-1 btn btn-success' type='button' id ='send_all'> Enviar todo</button>  
    <button class='col-2 offset-1 btn btn-primary' style='width:200px;'>Cargar todo a base de datos</button>
  </div>

  <div class='table-responsive'> 
    <table class='table text-center mt-3' id='tabla_files'>
      <tr>
        <th>Archivos</th> 
        <th>Progreso</th>
        <th>Acciones</th> 
      </tr>

      <tr id='1'>
        <td class='p-2' style='width: 400px;'>
          <form method='POST' id='file_1'>
            <input class="w-100" type="file" name="archivo" id="archivo" required>
          </form>
        </td>

        <td style='width: 670px;'>
          <div class="progress" style="height:30px;">
            <div class="progress-bar bg-success" id="barra_estado_1">
              <span style="font-size:20px;"></span>
            </div>
          </div>
        </td>

        <td class='w-25 p-2'> 
          <button class='btn btn-danger' type='button' id='cancel_1'> Cancelar </button>   
        </td>
      </tr>
    </table>
  </div> 
 </div>
</body>

</html>