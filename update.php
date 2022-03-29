<?php
// Get an xlsx-file from their website and convert it to the CVS-file using the PhpSpreadsheet library. 
// If successful, upload into the database

require "getData.php";

// Phpspreadsheet library
require_once("vendor/autoload.php");

// Import classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

// If update button
if (isset($_POST["updatebtn"])) {
    
    $url = "https://www.alko.fi/INTERSHOP/static/WFS/Alko-OnlineShop-Site/-/Alko-OnlineShop/fi_FI/Alkon%20Hinnasto%20Tekstitiedostona/alkon-hinnasto-tekstitiedostona.xlsx";
    $file_name = basename($url);
    
    // If download is succesfull
    if(file_put_contents( $file_name,file_get_contents($url))) { 
        // Read the Excel file
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($file_name);

        // Export to CSV file
        $writer = IOFactory::createWriter($spreadsheet, "Csv");
        $writer->setSheetIndex(0);   // Select which sheet to export.
        $writer->setDelimiter(';');  // Set delimiter.

        $writer->save("alkon-hinnasto.csv");

        // Import to database 
        // Empty old data
        $query = "TRUNCATE TABLE alko";
        $result = $db->query($query);
        // If successful
        if ($result) {
            // Add new data
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