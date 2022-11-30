import {f_getFileSelectById} from './functions.js';

document.addEventListener('DOMContentLoaded', ()=>{
  switch(numFile){
    case 1: //consolidado_descargas
      $('#header').html('Cargar consolidado de descargas');
      break;
    case 2: //prepotencial
      $('#header').html('Cargar prepotencial');
      break;
    case 3: //ciudades_normalizado
      $('#header').html('Cargar ciudades normalizado');
      break;
    case 4: //Ascard
      $('#header').html('Cargar Ascard');
      break;
    case 5: //Exclusion dcto
      $('#header').html('Cargar exclusión de descuento');
      break;
  };

  f_updt_DOM();

  $("#btn_back").click(()=>{window.location.href = '../index.php'});

  let btn_add = document.getElementById('btn_add_file');
  btn_add.addEventListener('click', ()=>{
    f_append_row();
    f_updt_DOM();
  });
  
  $('#btn_send_all').click(function(){    
    if(f_valida_nomFiles() == false){
      //alert('¡Verificar los nombres de los archivos!');
      return 0;
    };
    
    let nrows_tb = $('#tabla_files tr').length;
    nrows_tb = nrows_tb - 1; //omitir encabezados
    
    Swal.fire({
      title: '¿Enviar los archivos seleccionados?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '!Si, enviar¡'
    }).then((result) => {
      if (result.isConfirmed) {
        
        for( var i = 1 ; i <= nrows_tb ; i++){
          f_sube_archivo(i);
        };
    
        f_modifica_Btn_Send();
      };
    })
  });

  $('#btn_send_bd').click(function(){
    f_Carga_Bd();

    //añade barra de carga para visualizar progreso de insert mediante petición
    let html = 
    "<h2 class='row justify-content-center mt-5'>Progreso de carga...</h2>" + 

    "<div class='row justify-content-center'>" + 
    "<div class='progress' style='height:30px; width: 60%;'>" + 
    "<div class='progress-bar bg-info' id='progBar_insert'>" + 
      "<span style='font-size:20px;'></span>" + 
    "</div>" + 
    "</div>" +
    "</div>";

    if($('#progress_insert div').length === 0){  
      $('#progress_insert').append(html);
    };
  });
});

/** 
 * funcion añade propiedades al DOM
*/
function f_updt_DOM () {
  
  $('#tabla_files tr:last input[type=file]').attr('accept','.csv');
  
  return 0;
};

/**
 * Funcion agrega nueva fila a el documento para un nuevo archivo input file
 * Retorno número de filas en la tabla 
 */
function f_append_row(id_row){

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

  return ($('#tabla_files tr').length);
};

/**
 * Funcion verifica que los nombres de archivos de los input
  sean correctos
*/
function f_valida_nomFiles(){
  
  let nombre_file = "";
  let tipo = ".csv";

  nombre_file = f_getFileSelectById(numFile);

  let nrows_tb = $('#tabla_files tr').length;
  nrows_tb = nrows_tb - 1; //omitir encabezados

  for(var i = 1 ; i <= nrows_tb ; i++){
    let inpt_file = $('#tabla_files tr').eq(i).find('#archivo').val();
    let val_inFile = inpt_file.split('\\');
    val_inFile = val_inFile[(val_inFile.length - 1)];

    //console.log('ciclo');
    if(!(val_inFile == (nombre_file + i + tipo))){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: ('Inserte el archivo formato (.csv) con el siguiente nombre: '),
        text:  (nombre_file + i),
        showConfirmButton: false,
        timer: 3000
      });
      return false;
      continue;
    };
    //return true;
  };
};

/** 
 * funcion modifica funcionabilidad del boton enviar todo, luego de cargar archivos
*/
function f_modifica_Btn_Send (){
 
  $('#btn_send_all').off('click');
  $('#btn_send_all').click(function(){
    location.reload();
  });
  $('#btn_send_all').html('Recargar');
  $('#btn_send_all').removeClass('btn-success');
  $('#btn_send_all').addClass('btn-info');
  $('#btn_send_all svg').remove();

  let icon_updt = "<svg xmlns='http://www.w3.org/2000/svg' width='50' height='40' fill='currentColor' class='bi bi-arrow-repeat' viewBox='0 0 16 16'>";
  icon_updt += "<path d='M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z'/>";
  icon_updt += "<path fill-rule='evenodd' d='M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z'/>";
  icon_updt += "</svg>";

  $('#btn_send_all').append(icon_updt);

  history.pushState(null, document.title, location.href);
};


/**
 * funcion peticion subir archivos a server
 * @param id_row -- entero, id de la <tr> html la cual trae respectivo archivo y 
 * elementos para visualizar el progreso
 */
var arrxhrs = Array();
function f_sube_archivo(id_row){
  
  let ids = { id_form: ('file_' + id_row), 
  id_bar: ('barra_estado_' + id_row), 
  id_btn_cancel: ('cancel_' + id_row)};
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
    if(xhr.status === 200){
      barra_progreso.removeClass("bg-success");
      barra_progreso.addClass("bg-primary");
      span.html('¡Archivo cargado!');
    }else{
      barra_progreso.removeClass("bg-success");
      barra_progreso.removeClass("bg-primary");
      barra_progreso.addClass("bg-danger");
      span.html('!Fallo¡');
    };
  }, false);

  //error
  xhr.addEventListener('error', ()=>{
    barra_progreso.removeClass("bg-success");
    barra_progreso.removeClass("bg-primary");
    barra_progreso.addClass("bg-danger");
    span.html('!Error al cargar¡, intente nuevamente');
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
  xhr.open('POST', '../upld_to_server/subir_csv.php',true);
  xhr.send(new FormData(form));
  
  return 0;
};

/**
 * funcion valida peticiones en curso
 **/
/*function f_xhrSuccess(){
  
  let success = true;

  arrxhrs.forEach((xhr)=>{
    if(xhr.status == 0){
      success = false;
    };
  });

  return success; 
};
*/

/** 
 * funcion realiza peticion para cargar la BD
*/
function f_Carga_Bd(){
  
  let num_Files = $("#tabla_files tr").length - 1;
  let xhr = new XMLHttpRequest();
  let url = "";

  $('#btn_send_bd').off('click');

  url = "../import_to_bd/import_" + f_getFileSelectById(numFile) + ".php";
  xhr.addEventListener('load', ()=>{
    clearInterval(timer);
    if(xhr.responseText === '1'){
      let oHeader = $('#progress_insert h2'),
      barra_progreso = $('#progBar_insert'), 
      span = barra_progreso.children();
      
      barra_progreso.css('width', '100%');
      span.html('100%');
      oHeader.html('Cargado con éxito');
      alert('!Cargado con éxito¡');
    }else{
      alert('Error al cargar los datos del archivo...');
      alert(xhr.responseText);
      $('#progress_insert ')
      $('#btn_send_bd').click(function(){
        f_Carga_Bd();
      });
    };
  },false);

  xhr.open('GET', url + '?num_Files=' + num_Files);
  xhr.send();

  //asigna llamada a funcion para reflejar progresso
  let timer = 0;
  timer = setInterval(f_checkProgress,5000);
};

/** 
 * funcion muestra progreso de los INSERT a la BD 
 * Alimentada por archivo php que lee el progreso escrito en un txt por el archivo php
 * que realiza los INSERT 
*/
function f_checkProgress(){
  
  let url = '';
  let xhr = new XMLHttpRequest();

  url = "../import_to_bd/progress/check_" + f_getFileSelectById(numFile) + ".php";

  xhr.addEventListener('load',()=>{
    if(xhr.status === 200){
      if(xhr.responseText.length > 0){
        let oHeader = $('#progress_insert h2'),
        barra_progreso = $('#progBar_insert'), 
        span = barra_progreso.children();
        let sResponse = xhr.responseText.split(',');
        let iProgreso = sResponse[0];

        barra_progreso.css('width', iProgreso + '%');
        span.html(iProgreso + '%');
        oHeader.html('Estado de carga, Archivo ' + sResponse[1])
      };
    };
  },false);

  xhr.open("POST", url);
  xhr.send();
};