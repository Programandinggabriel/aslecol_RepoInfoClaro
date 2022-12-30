//funciones globales, uso en varios archivos

/** 
 * Obtener archivo seleccionado en el index
 * @param numFile -- id archivo
*/
export function f_getFileSelectById(numFile){
  let nombre_file = '';  

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

