<?php 
    include('../../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $aDataForm = $_POST;

    $sTipoCta = $aDataForm['tipoCta'];
    $sCampanna = $aDataForm['campanna'];
    $sCartera = $aDataForm['cartera'];
    $sVerifPyme = $aDataForm['verifPyme'];
    $sValDcto = "DCTO ".$aDataForm['valDcto']."%";

    $sQueryIns = "DELETE FROM descuentos 
                  WHERE crmorigen = '".$sTipoCta."' 
                    AND debtageinicial = '".$sCampanna."' 
                    AND cartera = '".$sCartera."' 
                    AND verificacion_pyme = '".$sVerifPyme."' 
                    AND txt_dcto = '".$sValDcto."'";
                    
    try{ 
        $oBd->exec($sQueryIns);
        echo "true";
    }catch(Exception $e){
        echo "false";
    };
?>