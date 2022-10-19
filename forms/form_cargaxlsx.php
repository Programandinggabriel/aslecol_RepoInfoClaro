<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Subir Archivos</title>
</head>


<body class="p-5">

<h1 class="row justify-content-center">Subir consolidado_descargas</h1>

  <div class ="">   

    <form action="" id="form_subir">

      <div class="row-12">
        <label class="col-3 col-form-label-lg" for="" >Archivo a Subir: </label>
        <input class="col-9 text-uppercase" type="file" name="archivo" id="archivo" required>
      </div>

      <div class="progress mt-5" style="height:30px;">
        <div class="progress-bar bg-success" id="barra_estado">
          <span style="font-size:30px;"></span>
        </div>
      </div>

      <div class="row mt-5 p-2">
        
        <input class='col-sm-2 btn btn-success' type="submit" value="Enviar">
        <input class='col-sm-2 mx-3 btn btn-danger' type="button" value="Cancelar" id="cancelar">
        <input class='col-sm-2 offset-sm-5 btn btn-outline-primary' type="button" value="Cargar a base" dataid="cargaBd">    
        
      </div>


    </form>
  
  </div>
  <script src="../js/form_carga.js"></script>
</body>

</html>