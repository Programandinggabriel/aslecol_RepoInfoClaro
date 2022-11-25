document.addEventListener('DOMContentLoaded',()=>{
    $('button[name=btn_update]').click(function(){
        let iIdFileSelect = $(this).attr('id');
        
        //alert(idFileSelect);
        window.location.href = 'forms/form_carga_csv.php?numFile=' + iIdFileSelect;
    });

    $('button[name=btn_delete]').click(function(){
        
        Swal.fire({
            title: '!ATENCIÓN¡',
            text: "Al eliminar todos los registros, todo el contenido de este archivo no se tendra en cuenta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar'
        }).then((result) => {
            if (result.isConfirmed) {
                f_delete_Bd(parseInt($(this).attr('id')));
            }
        });
    });

    $('#start').click(function(){
        let xml = new XMLHttpRequest();

        xml.addEventListener('load', ()=>{
            clearInterval(timer);
            //funcion peticion crear excel
            
        }, false)

        //realizar querys en la base datos
        xml.open('POST', './file_master/create_file/info_mysqli.php');
        xml.send();

        let timer = setInterval(f_checkProgress, 2000);
    });
   
},false);



/** 
 * funcion retorna archivo seleccionado en el index
 *  @param numFile --Entero, numero de archivo seleccionado 
*/
function f_getFileSelected(numFile){
    //numFile = variable traida por GET a form_carga_csv.php
    switch(numFile){
      case 1: //consolidado_descargas
        nombre_file = "descargas";
        break;
      case 2: //prepotencial
        nombre_file = "prepotencial";
        break;
      case 3: //ciudades_normalizado
        nombre_file = "ciudadesnorm";
        break;
      case 4: //ascard
        nombre_file = "ascard";
        break;
      case 5: //ascard
        nombre_file = "exclusiondcto";
        break;
    };
    return nombre_file;
  };

/**
 * funcion crea peticion para borrar base datos
 * @param numFile -- integer, archivo seleccionado
 */
function f_delete_Bd(numFile){

    let sNamefile = f_getFileSelected(numFile);
            
    let url = './delete_from_bd/delete_' + sNamefile + '.php';
    let xml = new XMLHttpRequest();

    xml.addEventListener('load', ()=>{
        if(xml.status === 200){
            let iResponse = parseInt(xml.responseText);

            if(iResponse > 0){
                Swal.fire({
                    icon: 'success',
                    title: 'Se elimino la información',
                    text: 'Se eliminaron ' + iResponse + ' registros de información correctamente' 
                }); 
            }else if(iResponse === 0){
                Swal.fire({
                    icon: 'error',
                    title: 'No hay registros para eliminar',
                    text: 'Se eliminaron ' + iResponse + ' registros de información' 
                }); 
            }
        };
   },false);

   xml.open('POST',url);
   xml.send();
};

/** 
 * funcion realiza petición para validar el estado del informe
 * 
*/
function f_checkProgress(){
    let xml = new XMLHttpRequest();

    xml.addEventListener('load', ()=>{
        let oHeader = $('#status_file');

        if(xml.status === 200){
            switch(parseInt(xml.responseText)){
                case 0:
                    oHeader.html('Iniciando...');
                    break;
                case 1:
                    oHeader.html('Formateando a número campo (MODINITCTA)');
                    break;
                case 2:
                    oHeader.html('Completando campo (ASIGNACIÓN)');
                    break;
                case 3:
                    oHeader.html('Completando campo (VERIFICACIÓN PYME)');
                    break;
                case 4:
                    oHeader.html('Completando campo (CARTERA)');
                    break;
                case 5:
                    oHeader.html('Cruzando con (ACUMULADO DE CIUDADES) para campo (REGIÓN)');
                    break;
                case 6:
                    oHeader.html('Completando rango de carteras, campo (RANGO)');
                    break;
                case 7:
                    oHeader.html('Cruzando con (ASCARD) para campo (ASCARD)');
                    break;
                case 7:
                    oHeader.html('Cruzando con (ASCARD) para campo (ASCARD)');
                    break;
                case 8:
                    oHeader.html('Cruzando con (EXLUSIÓN DCTO) para campo (EXCLUSIÓN)');
                    break;

            };
        };
    }, false);

    xml.open('POST','./querys_create_file/check_status.php');
    xml.send();
};

/**
 * 
 */