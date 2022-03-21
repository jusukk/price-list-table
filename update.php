<?php
// Taulukon lataus Alkon sivulta ja sen muuntaminne cvs
require "getData.php";


// Phpspreadsheet library
require_once("vendor/autoload.php");

// Import classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Lataa taulukon Alkon sivuilta ja tallentaa sen juureen
if (isset($_POST["updatebtn"])) {
    
    $url = "https://www.alko.fi/INTERSHOP/static/WFS/Alko-OnlineShop-Site/-/Alko-OnlineShop/fi_FI/Alkon%20Hinnasto%20Tekstitiedostona/alkon-hinnasto-tekstitiedostona.xlsx";
    $file_name = basename($url);
    
    // Jos lataus onnistuu
    if(file_put_contents( $file_name,file_get_contents($url))) { 
        // Excel to csv
        // Read the Excel file
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($file_name);

        // Export to CSV file
        $writer = IOFactory::createWriter($spreadsheet, "Csv");
        $writer->setSheetIndex(0);   // Select which sheet to export.
        $writer->setDelimiter(';');  // Set delimiter.

        $writer->save("alkon-hinnasto.csv");

        // Import to database 
        // Tyhjennä vanha table
        $query = "TRUNCATE TABLE alko";
        $result = $db->query($query);
        // Jos tyhjennys onnistuu
        if ($result) {
            // Lisää uudet tiedot
            $sql_update = "
                LOAD DATA INFILE 'alkon-hinnasto.csv' INTO TABLE alko
                FIELDS TERMINATED BY ';' ENCLOSED BY '\"'
                LINES TERMINATED BY '\r\n'
                IGNORE 4 LINES";
            $result = $db->query($sql_update);
            if ($result) {
                echo "<script>alert('Hinnaston päivitys onnistui!');</script>";
            }
            else {
                echo "Hinnaston päivitys epäonnistui!";
            }
        }
     
    } 
 
}