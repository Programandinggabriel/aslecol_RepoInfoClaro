  
let form = document.getElementById('form_subir');
  
//controles de carga form
var barra_estado = document.getElementById('barra_estado'),
span = barra_estado.children[0],
boton_cancelar = form.children[0].children[1].children[1].children[1];

document.addEventListener("DOMContentLoaded", ()=>{

  form.addEventListener("submit", function(event){
    
      event.preventDefault();
      
      subir_archivos(this);

});


let inpt_Arch = form.children[0].children[0].children[1];

inpt_Arch.setAttribute('accept', '.csv');

inpt_Arch.addEventListener('change', ()=>{
  
  let nombreArch = inpt_Arch.files[0].name.toLowerCase() ;

  /*if (! (nombreArch == 'consolidado_descargas.xlsx' || nombreArch == 'consolidado_descargas.xls')){
    
    alert("Se esperaba el archivo con el nombre (consolidado_descargas)");
    inpt_Arch.value = '';
  
  };*/
  
});


let boton_cargaBd = form.children[0].children[1].children[1].children[2];
boton_cargaBd.setAttribute('hidden', true);

boton_cargaBd.addEventListener('click', ()=>{
  
  Swal.fire({
    
    title: '¿Desea confirmar?',
    text: 'Se subiran los registros a la base de datos',
    icon: 'question',
    cancelButtonColor: '#d33',
    confirmButtonColor: '#3085d6',
    showCancelButton: true,
    confirmButtonText: '! SI, SUBIR ¡',

    }).then((result)=>{
      
      if(result.isConfirmed){
        
        carga_sql();

      }else{
      
        swal.fire({
          
          title: 'Proceso cancelado',
          icon: 'success',
        
        });
      
      };

    });

  });

});


function subir_archivos(form) {
  
  //peticion
  let peticion = new XMLHttpRequest();

  //progreso
  peticion.upload.addEventListener("progress",(event)=>{
    
    let porcentaje = Math.round((event.loaded / event.total)*100);

    //console.log(porcentaje);
    barra_estado.style.width = porcentaje+'%';
    span.innerHTML = porcentaje+'%';

  });

  //finalizado
  peticion.addEventListener('load', ( )=> {
    
    barra_estado.classList.remove('bg-success');
    barra_estado.classList.add('bg-primary');
    span.innerHTML = "Proceso completado";
  
    let boton_cargaBd = form.children[2].children[2];
    boton_cargaBd.removeAttribute('hidden');

  });

  //enviar datos
  peticion.open('post','../upld_to_server/subir.php');
  peticion.send(new FormData(form));

  //cancelado
  boton_cancelar.addEventListener("click", ()=>{
    
    peticion.abort();
    
    barra_estado.classList.remove('bg-success');
    
    barra_estado.classList.add('bg-danger');
    
    span.innerHTML = "Proceso cancelado";
 
  });

  };

function carga_sql(){
    
  //peticion carga sql
  var peticion_carga_sql = new XMLHttpRequest();

  //progreso
  peticion_carga_sql.addEventListener("progress",(event)=>{
    
    let porcentaje = Math.round((event.loaded / event.total)*100);

    //console.log(porcentaje);
    barra_estado.style.width = porcentaje+'%';
    span.innerHTML = porcentaje+'%';

  });




  //abrimos petición para cargue a sql
  peticion_carga_sql.open("GET", "../import_to_bd/imprt_descargas.php");
  peticion_carga_sql.send();

};