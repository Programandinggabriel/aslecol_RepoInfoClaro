document.addEventListener('DOMContentLoaded', ()=>{
  f_updt_DOM();

  var btn_add = document.getElementById('add_file');
  var id_row = 1;
  btn_add.addEventListener('click', ()=>{
    id_row++;
    let ids = { id_form: ('file_' + id_row), id_bar: ('barra_estado_' + id_row), id_btn_cancel: ('cancel_' + id_row)};
    let fila = 
    "<tr id='"+ id_row +"'>" +
      "<td class='p-2' style='width: 400px;'>" + 
        "<form method='POST' id='"+ ids.id_form +"'>" +
          "<input class='w-100' type='file' name='archivo' id='archivo' 'required'>" +
        "</form>" +
      "</td>" +

      "<td style='width: 670px;'>" + 
        "<div class='progress' style='height:30px;'>" + 
          "<div class='progress-bar bg-success' id='"+ ids.id_bar +"'>" + 
            "<span style='font-size:20px;'></span>" + 
          "</div>" + 
        "</div>" +
      "</td>" +

      "<td class='w-25 p-2'>" + 
        /*"<button class='btn btn-success' type='button' id ='"+ id_row +"' name='send'> Enviar </button>" +*/
        "<button class='btn btn-danger mx-1' type='button' id='" + ids.id_btn_cancel +"'> Cancelar </button>" +
        /*"<button class='btn btn-primary'>Envía a base</button>" +*/
      "</td>" + 
    "</tr>";
    
    $('#tabla_files tbody').append(fila);
    f_updt_DOM();
  });
  
  $('#send_all').click(function(){    
    let nrows_tb = $('#tabla_files tr').length;
    nrows_tb = nrows_tb - 1; //omitir encabezados
    
    for( var i = 1 ; i <= nrows_tb ; i++){
      f_sube_archivo(i);
    };

    f_restaura();
  });
});


//funcion añade propiedades al DOM
function f_updt_DOM () {
  $('#tabla_files tr:last input[type=file]').attr('accept','.csv');
  
  return 0;
};

//funcion peticion subir archivos a server
var arrxhrs = Array();
function f_sube_archivo(id_row){
  let ids = { id_form: ('file_' + id_row), id_bar: ('barra_estado_' + id_row), id_btn_cancel: ('cancel_' + id_row)};
  let form =  document.getElementById(ids.id_form);
  let barra_progreso = $('#' + ids.id_bar), span = barra_progreso.children();
  let btn_cancel = $('#' + ids.id_btn_cancel);
  let xhr = new XMLHttpRequest();
  
  //progreso
  xhr.upload.addEventListener('progress', (event)=>{  
    let avance = Math.round((event.loaded / event.total) * 100);
    
      barra_progreso.css('width',avance + '%');
      span.html(avance + '%');
  } ,false);
  
  //finalizado
  xhr.addEventListener('load', ()=>{
    barra_progreso.removeClass("bg-success");
    barra_progreso.addClass("bg-primary");
    span.html('¡Archivo cargado!');
  }, false);

  //error
  xhr.addEventListener('error', ()=>{
    barra_progreso.removeClass("bg-success");
    barra_progreso.removeClass("bg-primary");
    barra_progreso.addClass("bg-danger");
    span.html('!Error al cargar¡');
  },false);

  //cancelar
  btn_cancel.click(function(){
    if(xhr.status != 200){
      xhr.abort();
      barra_progreso.removeClass("bg-success");
      barra_progreso.removeClass("bg-primary");
      barra_progreso.addClass("bg-danger");
      span.html('!Cancelada¡');
    };
  });

  //guardar
  arrxhrs.push(xhr);
  //envio
  xhr.open('POST', '../upld_to_server/subir_.php',true);
  xhr.send(new FormData(form));
  
  return 0;
};

/*
//funcion valida peticiones en curso
function f_xhrSuccess(){
  let success = true;

  arrxhrs.forEach((xhr)=>{
    if(xhr.status == 0){
      success = false;
    };
  });

  return success; 
};
*/

//funcion_restaura luego de cargar archivos
function f_restaura (){
  $('#send_all').off('click');
  $('#send_all').click(function(){
    location.reload();
  });
  $('#send_all').html('Recargar pagina');
  $('#send_all').removeClass('btn-success');
  $('#send_all').addClass('btn-info');
  history.pushState(null, document.title, location.href);
};
