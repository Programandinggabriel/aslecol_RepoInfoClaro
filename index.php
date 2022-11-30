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
        <table class='table text-center' style='width: 800px;' id='load_files'>
          <th>Archivo</th>
          <th>Acción</th>
          <th>Info</th>

          <tr align='center' id='1'>
            <td>
              <strong>CONSOLIDADO DE DESCARGAS</strong>
            </td>  
            
            <td>  
              <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='1'>
                Actualizar
              </button>
              <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id = '1'> 
                Eliminar
              </button>
            </td>
            
            <td>
              <button class='btn btn-info'>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </td>
          </tr>

          <tr align='center' id='2'>
            <td>
              <strong>PREPOTENCIAL</strong>
            </td>  
            
            <td>  
              <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='2'>
                Actualizar
              </button>
              <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='2'>
                Eliminar
              </button>
            </td>
          
            <td>
              <button class='btn btn-info'>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </td>
          </tr>

          <tr align='center' id='3'>
            <td>
              <strong>CIUDADES NORMALIZADO</strong>
            </td>  
            
            <td>  
              <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='3'>
                Actualizar
              </button>
              <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='3'>
                Eliminar
              </button>
            </td>

            <td>
              <button class='btn btn-info'>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </td>
          </tr>

          <tr align='center' id='4'>
            <td>
              <strong>ASCARD</strong>
            </td>  
            
            <td>  
              <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='4'>
                Actualizar
              </button>
              <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='4'>
                Eliminar
              </button>
            </td>

            <td>
              <button class='btn btn-info'>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </td>
          </tr>

          <tr align='center' id = '5'>
            <td>
              <strong>EXCLUSIÓN DE DESCUENTO</strong>
            </td>  
            
            <td>  
              <button class='btn btn-success' style='height: 40px; width: 100px;' name='btn_update' id='5'>
                Actualizar
              </button>
              <button class='btn btn-danger mx-2' style='height: 40px; width: 100px;' name='btn_delete' id='1'>
                Eliminar
              </button>
            </td>

            <td>
              <button class='btn btn-info'>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
              </button>
            </td>
          </tr>
        </table>
      </div>
    </div>

    <div class='col-3'>
      <h4 class='text-center' id='status_file'>Crear archivo</h4>  
      <div class='row justify-content-center mt-3'>
        <button class='col-3 btn btn-success' style='width: 220px; height: 50px;' id='start'>
          INICIAR PROCEDIMIENTO
        </button>
        <div class='col-2'>
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="50" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
          </svg>
        </div>
      </div>
    </div>
  </section>
</div>

<script src='js/main.js' type='module'></script>
</html>