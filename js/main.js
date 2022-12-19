import {f_getFileSelectById} from './functions.js';

window.addEventListener('load',()=>{
    f_checkInfoTable();

    $('button[name=btn_update]').click(function(){
        let iIdFileSelect = $(this).attr('id');
        
        //alert(idFileSelect);
        window.location.href = 'forms/form_carga_csv.php?numFile=' + iIdFileSelect;
    });

    $('button[name=btn_delete]').click(function(){
        
        Swal.fire({
            title: '!ATENCIÓN¡',
            text: "Al eliminar todos los registros, todo el contenido de este archivo no se tendra en cuenta para el archivo",
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
        //xml.open('POST', './file_master/create_file/info_mysqli.php');
        xml.open('POST', './file_master/create_file/info_postgress.php');

        xml.send();

        let timer = setInterval(f_checkProgress, 2000);
    });   
},false);



/**
 * funcion crea peticion para borrar base datos
 * @param numFile -- integer, archivo seleccionado
 */
function f_delete_Bd(numFile){

    let sNamefile = f_getFileSelectById(numFile);
            
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
                }).then((result)=>{
                    if(result){
                        location.reload();
                    };
                }); 
            }else if(iResponse === 0){
                Swal.fire({
                    icon: 'error',
                    title: 'No hay registros para eliminar',
                    text: 'Se eliminaron ' + iResponse + ' registros de información' 
                }).then((result)=>{
                    if(result){
                        location.reload();
                    };
                }); 
            };
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

    //xml.open('POST','./querys_create_file/check_status.php');
    xml.open('POST','./querys_create_file/check_status_pg.php');
    xml.send();
};

/**
 * funcion realiza petición a SERVIDOR para obtener información sobre las tablas de la BD
 */
function f_checkInfoTable(){
    let url = './check_files_updates.php';//?nameFile=' + sNamefile;
    let oXml = new XMLHttpRequest();
    
    
    oXml.addEventListener('load', ()=>{
        if(oXml.status === 200){
            let oJSON = oXml.response;
            //array con nombres de las tablas en la BD
            let aNamesTbls = ['consoldescar', 'prepotencial', 'acumciudades', 'ascard', 'exclusiondcto'];

            for (let i in oJSON['tables']){
                let snameTable = oJSON['tables'][i]['name'];
                let irowsTable = oJSON['tables'][i]['rows'];
                let dupdateDate = oJSON['tables'][i]['updateDate'];

                let sTableCell = "<td>"+
                                    "Número de filas: "+(irowsTable)+ "<br>"+
                                    "Fecha actualización: "+(dupdateDate)+
                                 "</td>";

                switch(snameTable){
                    case aNamesTbls[0]:
                        $('#load_files tr[id=1]').append(sTableCell);
                        break;
                    case aNamesTbls[1]:
                        $('#load_files tr[id=2]').append(sTableCell);
                        break;
                    case aNamesTbls[2]:
                        $('#load_files tr[id=3]').append(sTableCell);
                        break;   
                    case aNamesTbls[3]:
                        $('#load_files tr[id=4]').append(sTableCell);
                        break;           
                    case aNamesTbls[4]:
                        $('#load_files tr[id=5]').append(sTableCell);
                        break;   
                };
            };
        }else{
            alert('Error al realizar la petición');
        };      
    },false);

    oXml.open('POST', url);
    oXml.responseType = 'json';
    oXml.send();
};