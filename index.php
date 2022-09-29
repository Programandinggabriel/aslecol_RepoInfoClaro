<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>Subir Archivos</title>
</head>

<body>
  <div class="principal">
    <h1>Subir Archivos </h1>

    <form action="" id="form_subir">

      <div class="form-1-2">
        <label for="">Archivo a Subir: </label>
        <input type="file" name="archivo" id="" required>
      </div>

      <div class="barra">
        <div class="barra_azul" id="barra_estado">
          <span></span>
        </div>
      </div>

      <div class="acciones">
        <input type="submit" value="Enviar" class="btn">
        <input type="button" value="Cancelar" id="cancelar" class="cancel">
      </div>

    </form>
  </div>
  <script src="js/main.js"></script>
</body>

</html>