<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <title>Subir Archivos</title>
</head>


<body class="p-5">

<h1 class="row justify-content-center">Subir Archivos</h1>

  <div class ="">   

    <form action="" id="form_subir">

      <div class="row-12">
        <label class="col-3 col-form-label-lg" for="" >Archivo a Subir: </label>
        <input class="col-9 text-uppercase" type="file" name="archivo" id="archivo" required>
      </div>

      <div class="progress mt-5">
        <div class="progress-bar bg-success" id="barra_estado">
          <span></span>
        </div>
      </div>

      <div class="row-5 mt-5">
  
        <input class='col-2 btn btn-success' type="submit" value="Enviar">
        <input class='col-2 btn btn-danger' type="button" value="Cancelar" id="cancelar" class="cancel">
      
      </div>

    </form>
  
  </div>
  <script src="js/main.js"></script>
</body>

</html>