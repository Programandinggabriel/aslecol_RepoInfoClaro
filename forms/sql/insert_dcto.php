<?php 
    include('../../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $aDataForm = $_POST;

    $sTipoCta = $aDataForm['tipoCta'];
    $sCampanna = $aDataForm['campanna'];
    $sCartera = $aDataForm['cartera'];
    $sVerifPyme = $aDataForm['verifPyme'];
    $sValDcto = "DCTO ".$aDataForm['valDcto']."%";

    $sQueryIns = "INSERT INTO descuentos (crmorigen, debtageinicial, cartera, verificacion_pyme, txt_dcto) 
                  VALUES ('".$sTipoCta."', '".$sCampanna."', '".$sCartera."', '".$sVerifPyme."', '".$sValDcto."')";

    try{ 
        $oBd->exec($sQueryIns);
        echo "true";
    }catch(Exception $e){
        echo "false";
    };
?>