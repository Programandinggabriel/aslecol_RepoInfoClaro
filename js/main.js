document.addEventListener("DOMContentLoaded", ()=>{
  let form = document.getElementById('form_subir');

  form.addEventListener("submit", function(event){
    
    event.preventDefault();
    
    subir_archivos(this);
  
  });

  let inpt_Arch = form.children[0].children[1];
  
  inpt_Arch.setAttribute('accept', '.xlsx, .xsl');
  
  inpt_Arch.addEventListener('change', ()=>{
    
    let nombreArch = inpt_Arch.files[0].name.toLowerCase() ;
    alert(nombreArch);
    if (! (nombreArch == 'consolidado_descargas.xlsx' || nombreArch == 'consolidado_descargas.xls')){
      
      alert("Se esperaba el archivo con el nombre (consolidado_descargas)");
      inpt_Arch.value = "";
    
    };
    


  });

});


function subir_archivos(form) {
  
  let barra_estado = form.children[1].children[0],
  span = barra_estado.children[0],
  boton_cancelar = form.children[2].children[1];
  
  barra_estado.classList.remove('barra_verde','barra_roja');
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
    
    barra_estado.classList.add('barra_verde');
    span.innerHTML = "Proceso completado";
  
  });

  //enviar datos
  peticion.open('post','upld_to_server/subir.php');
  peticion.send(new FormData(form));

  //cancelado
  boton_cancelar.addEventListener("click", ()=>{
    
    peticion.abort();
    
    barra_estado.classList.remove('barra_verde');
    
    barra_estado.classList.add('barra_roja');
    
    span.innerHTML = "Proceso cancelado";
 
  });


}