<?php 
    //valida inexistencia del descuento a insertar
    include('../../bd_conect/bd.php');
    
    $oBd = obtenerBD();
    $aDataForm = $_POST;

    $sTipoCta = $aDataForm['tipoCta'];
    $sCampanna = $aDataForm['campanna'];
    $sCartera = $aDataForm['cartera'];
    $sVerifPyme = $aDataForm['verifPyme'];
    $sValDcto = $aDataForm['valDcto'];

    $sQuerySelect = "SELECT COUNT(id_descuento) as cnt_descuentos FROM descuentos 
                    WHERE crmorigen = '".$sTipoCta."' 
                    AND debtageinicial = '".$sCampanna."' 
                    AND cartera = '".$sCartera."' 
                    AND verificacion_pyme = '".$sVerifPyme."'";
    $sQuerySelect =  $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();

    $iCntDescuentos = $sQuerySelect->fetch(PDO::FETCH_BOTH)['cnt_descuentos'];

    if($iCntDescuentos >= 1){
        echo "true";
    }else{
        echo "false";
    };
?>