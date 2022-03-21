<?php

$includeColums = [
    "`Numero`",
    "`Nimi`",
    "`Valmistaja`",
    "`Pullokoko`",
    "`Hinta`",
    "`Litrahinta`",
    //"`Uutuus`",
    //"`Hinnastojärjestyskoodi`",
    "`Tyyppi`",
    //"`Alatyyppi`",
    //"`Erityisryhmä`",
    //"`Oluttyyppi`",
    "`Valmistusmaa`",
    //"`Alue`",
    "`Vuosikerta`",
    //"`Etikettimerkintöjä`",
    //"`Huomautus`",
    //"`Rypäleet`",
    //"`Luonehdinta`",
    //"`Pakkaustyyppi`",
    //"`Suljentatyyppi`",
    "`Alkoholi-%`",
    //"`Hapot g/l`",
    //"`Sokeri g/l`",
    //"`Kantavierrep-%`",
    //"`Väri EBC`",
    //"`Katkerot EBU`",
    "`Energia kcal/100 ml`",
    //"`Valikoima`",
    //"`EAN`"    
];
$sql_includeColums = implode(", ", $includeColums);

// Create filter sql
//----------------------------------------------------------------------------------------------------
$filterArray = array();
// Tyyppi ----------------------------------------------------
if (isset($_POST["formTyyppi"])) {
    $varTyyppi = $_POST['formTyyppi'];
    if (!empty($varTyyppi)) {
        $filterArray[0] = "Tyyppi = '$varTyyppi'";  
    }
}
// Valmistusmaa ----------------------------------------------------
if (isset($_POST["formValmistusmaa"])) {
    $varValmistusmaa = $_POST['formValmistusmaa'];
    if (!empty($varValmistusmaa)) {
        $filterArray[1] = "Valmistusmaa = '$varValmistusmaa'";  
    }
}
// Pullokoko ----------------------------------------------------
if (isset($_POST["formPullokoko"])) {
    $varPullokoko = $_POST['formPullokoko'];
    if (!empty($varPullokoko)) {
        $filterArray[2] = "Pullokoko = '$varPullokoko'";  
    }
}

// Hinta ----------------------------------------------------
if (isset($_POST["formHintaMIN"])) {
    $varHintaMIN = $_POST['formHintaMIN'];
}
else {
    $varHintaMIN = 0;
}
if (isset($_POST["formHintaMAX"])) {
    $varHintaMAX = $_POST['formHintaMAX'];
}
else {
    $varHintaMAX = 99999;
}
$filterArray[3] = "Hinta BETWEEN $varHintaMIN AND $varHintaMAX";

// Järjestä ----------------------------------------------------
if (isset($_POST["formSort"])) {
    $varSort = $_POST['formSort'];
}
else {
    $varSort = '';
}

// Sivut ----------------------------------------------------
if (isset($_POST["formPage"])) {
    $page = $_POST['formPage'];
}
else {
    $page = 1;
}

if (isset($_POST["formLimit"])) {
    $limit = $_POST['formLimit'];
}
else {
    $limit = 25;
}


// Assemble sql ----------------------------------------------------
if ($filterArray) {
    $sql_filters = ' WHERE ' . implode(' AND ', $filterArray);
}
else {
    $sql_filters = '';
}
//print_r($sql_filters);

// luo järjestys sql ----------------------------------------------------
$order_sql = "";
if (isset($_POST["formSort"])) {
    if (!empty($_POST['formSort'])) {
        if ( $_POST['formSort'] == 'hintaMinMax' ) {
        $order_sql = "ORDER BY Hinta ASC";
        }
        else if ( $_POST['formSort'] == 'hintaMaxMin' ) {
            $order_sql = "ORDER BY Hinta DESC";
        }
        else if ( $_POST['formSort'] == 'nimi' ) {
            $order_sql = "ORDER BY Nimi";
        }
    }
}
else {
    $order_sql = "";
}