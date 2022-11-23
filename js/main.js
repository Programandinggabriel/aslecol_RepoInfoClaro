document.addEventListener('DOMContentLoaded',()=>{
    $('#bnts_load_files button').click(function(){
        let idbtn = $(this).attr('id');
        
        //alert(idbtn);
        window.location.href = 'forms/form_carga_csv.php?numFile=' + idbtn;
    });

    $('#start').click(function(){
        let xml = new XMLHttpRequest();

        xml.addEventListener('load', ()=>{
            clearInterval(timer);
            //funcion peticion crear excel

        }, false)

        //realizar querys en la base datos
        xml.open('POST', './querys_create_file/info_mysqli.php');
        xml.send();

        let timer = setInterval(f_checkProgress, 2000);
    });
},false);



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