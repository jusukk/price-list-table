<?php
// Returns cvs-files date as string from first row of the file
function getFileDate() {
    $row = 0;
    $date = "error";
    $filename = "alkon-hinnasto.csv";

    if(($handle = fopen($filename, "r")) !== false) {
        while(($data = fgetcsv($handle, 1000, ";")) !== false) {
            if($row == 0) {
                $key = "Alkon hinnasto ";
                if ($key == substr($data[0], 0, strlen($key))) {
                    $date = substr($data[0], strlen($key));
                }
            }
        }
        fclose($handle);
    }
    return $date;
}



