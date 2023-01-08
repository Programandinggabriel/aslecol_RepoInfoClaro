$('#val_dcto').change(function(){
    let iValorDcto = $('#val_dcto').val();
    let oLabel = $('#lbl_dcto');

    $(oLabel).html(iValorDcto + '%DCTO');
});

$('#btn_save').click(function(){
    //valida errores
    let iCountErr = f_checkForm(); 

    if(iCountErr > 0){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: ('Falta información'),
            text:  ('recuerde rellenar completamente los campos'),
            showConfirmButton: false,
            timer: 2500
        });
    }else{
       let iValDcto = parseInt($('#val_dcto').val());
        
        if(iValDcto === 0){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: ('Valor inválido'),
                text:  ('!El descuento tiene que ser mayor a cero¡'),
                showConfirmButton: false,
                timer: 2500
            });
            return 0;
        };
    };

    if(iCountErr === 0){
        f_insertDcto();
    };      
});

$('#btn_submit').click(function(){
    
});



/**
 * función carga los descuentos existentes en la base de datos
 * a la tabla html dctos 
 */
function f_loadDctos(){
    let oXhr = new XMLHttpRequest();
    let sUrl = "./sql/load_dctos.php";

    oXhr.open('POST', sUrl);
    
    oXhr.addEventListener('load', function(){
        if(oXhr.status === '200'){
            let oJson = oXhr.response;
            console.log(oJson);
        };
    }, false);

    oXhr.send();
    oXhr.responseType = 'json';
};

/** 
 * función retorna cuenta de errores en formulario
*/
function f_checkForm(){
    aElements = $('#frm_dctos input, select');

    var iCountErr = 0;
    aElements.each(function(){
        let oElement = $(this);

        if(oElement.attr('name') === 'listOption'){
            let vValue = oElement.val();
            
            if(vValue === 'Seleccione' || vValue === ''){
                iCountErr++;
            };
        }else if(oElement.attr('name') === 'val_dcto'){
            iValDcto = parseInt($('#val_dcto').val());
        };
    });

    return iCountErr;
};

/**
 * función añade descuento a base de datos y tabla html dctos
 */
function f_insertDcto(){
    let oxhr = new XMLHttpRequest(); //valida inexistencia de descuento en base de datos
    let sUrl = './sql/check_dcto_bd.php';
    let oFormData = new FormData();

    oFormData.append('tipoCta', $('#tipoCta').val());
    oFormData.append('campanna', $('#campanna').val());
    oFormData.append('cartera', $('#cartera').val());
    oFormData.append('verifPyme', $('#verifPyme').val());
    oFormData.append('valDcto', $('#val_dcto').val());

    oxhr.open('POST', sUrl);

    oxhr.addEventListener('load', function(){
        if(oxhr.status = '200'){
            if(oxhr.responseText === 'false'){
                //inserta en base de datos y tabla html
                let oxhr = new XMLHttpRequest();
                let sUrl = './sql/insert_dcto.php';
                let oFormData = new FormData();
            
                oFormData.append('tipoCta', $('#tipoCta').val());
                oFormData.append('campanna', $('#campanna').val());
                oFormData.append('cartera', $('#cartera').val());
                oFormData.append('verifPyme', $('#verifPyme').val());
                oFormData.append('valDcto', $('#val_dcto').val());
            
                oxhr.open('POST', sUrl);
            
                oxhr.addEventListener('load', function(){
                    if(oxhr.status = '200'){
                        if((oxhr.responseText === 'true')){
                            //inserta en tabla html
                            f_insertRow(); 
                            //Limpiar formulario
                            $('#frm_dctos [name=listOption]').val('Seleccione');
                            $('#val_dcto').val('0');
                        };
                    };
                },true);
            
                oxhr.send(oFormData);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Ya existe este dcto',
                    text:  'El descuento no puede estar duplicado',
                    showConfirmButton: false,
                    timer: 3000
                });
            };
        };
    },true);

    oxhr.send(oFormData);
};

/** 
 * función añade fila a tabla html dctos, teniendo en cuenta valores del form
*/
function f_insertRow(){
    let oTable = $('#tb_dctos');
    let iIdRow = parseInt($('#tb_dctos tr').last().attr('id'));
    let sRowTable = "";
    
    //form row
    iIdRow++;
    sRowTable = '<tr id='+(iIdRow)+'>'+
                    '<td id=val_dcto_'+(iIdRow)+'>'+'DCTO '+($('#val_dcto').val())+'%'+'</td>'+
                    '<td id=tipoCta_'+(iIdRow)+'>'+($('#tipoCta').val())+'</td>'+
                    '<td id=campanna_'+(iIdRow)+'>'+($('#campanna').val())+'</td>'+
                    '<td id=cartera_'+(iIdRow)+'>'+($('#cartera').val())+'</td>'+
                    '<td id=verifPyme_'+(iIdRow)+'>'+($('#verifPyme').val())+'</td>'+
                    "<td><button class='btn btn-danger' onclick='f_deleteDcto($(this))'>Remover</button>"+
                '</tr>';
    
    oTable.append(sRowTable);
};

/**
 * función elimina registro de la tabla html dctos
 * @param oBtnClick -- boton clickeado
*/
function f_deleteDcto(oBtnClick){
    let oxhr = new XMLHttpRequest();
    let sUrl = './sql/delete_dcto.php';
    let oFormData = new FormData();
    let iIdRowSelect = oBtnClick.parent().parent().attr('id');

    oFormData.append('tipoCta', $('#tipoCta_'+iIdRowSelect).html());
    oFormData.append('campanna', $('#campanna_'+iIdRowSelect).html());
    oFormData.append('cartera', $('#cartera_'+iIdRowSelect).html());
    oFormData.append('verifPyme', $('#verifPyme_'+iIdRowSelect).html());
    oFormData.append('valDcto', $('#val_dcto_'+iIdRowSelect).html());

    oxhr.open('POST', sUrl);

    oxhr.addEventListener('load', function(){
        if(oxhr.status = '200'){
            if(oxhr.responseText === 'true'){
                //inserta en tabla html
                f_deleteRow(iIdRowSelect); 
            };
        };
    },true);

    oxhr.send(oFormData);

};

/**
 * función remove fila de tabla html dctos
 * @param iIdRow -- id de fila tabla hrml a remover
 */
function f_deleteRow(iIdRow){
    $('#tb_dctos tr').each(function(){
        if(parseInt($(this).attr('id')) === parseInt(iIdRow)){
            $(this).remove();
            return 0;
        };
    });
};

