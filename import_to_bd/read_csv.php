<?php 

$rutaCsv = '../xlsx/consolidado_descargas.csv';
$fileCsv = fopen($rutaCsv,'r');

echo "<table>";
while($lineCsv = fgetcsv($fileCsv,0,';')){
    #cuenta celdas por linea csv
    //echo count ($lineCsv) . '</br>' ;

    echo "<tr>";
    for($col = 0 ; $col <= 1 ; $col++){

        echo "<td>";

            echo $lineCsv[$col];
    
        echo "</td>";
    };

    echo "</tr>";
};
echo "</table>";
fclose($fileCsv);
?>