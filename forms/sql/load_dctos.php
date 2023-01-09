<?php
    include('../../bd_conect/bd.php');

    $oBd = obtenerBD();
    
    $sQuerySelect = "SELECT crmorigen As tipoCuenta, 
                            debtageinicial As campanna,
                            cartera As cartera,
                            verificacion_pyme As verifPyme,
                            txt_dcto As descuento
                     FROM descuentos";

    $sQuerySelect = $oBd->prepare($sQuerySelect);
    $sQuerySelect->execute();

    $aDescuentos = [];
    while($aResultado = $sQuerySelect->fetch(PDO::FETCH_ASSOC)){
        array_push($aDescuentos, $aResultado);
    };

    echo '{"descuentos": '.json_encode($aDescuentos)."}";
?>              