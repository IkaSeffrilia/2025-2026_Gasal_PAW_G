<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $matkul_saat_ini) {
    switch ($matkul_saat_ini) {
        case "PTI":
            $output = "Saya suka PTI";
            break;
            
        case "ALPRO":
            $output = "Saya suka ALPRO";
            break;
            
        case "DPW":
            $output = "Saya suka DPW";
            break;
            
        case "STRUKDAT":
            $output = "Saya suka STRUKDAT";
            break;
            
        case "JARKOM":
            $output = "Saya suka JARKOM";
            break;
            
        case "PAW":
            $output = "Saya suka PAW";
            break;
            
        default:
            $output = "Saya tidak mengambil matkul $matkul_saat_ini";
            break;
    }
    echo $output . "<br>";
}

?>