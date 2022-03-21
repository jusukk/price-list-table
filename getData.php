<?php
require_once "filters.php";

$talbeDataArray = [];
$filterDataArray = [];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "harj";
$table = "alko";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

if (!$db){
    echo "Connection failed:" . mysqli_connect_error();
}

// Jos taulukko on tyjhä, käytetään backup ----------------------------------------------------
$sql_allData = "SELECT * FROM $table";
$result = $db->query($sql_allData);
$result = mysqli_fetch_array($result, MYSQLI_ASSOC);

if(empty($result)) {
    $table = "alko2";
	echo "  Päätaulukko on tyhjä. Käytetään varataulukkoa.  ";
}
else {
	$table = "alko";
}


// Counting total rows ----------------------------------------------------
$sql_allData = "SELECT * FROM $table";
$rowCountData = $db->query($sql_allData);
$rowCount = mysqli_num_rows($rowCountData); 


// Get filterBtn data, no limit  ----------------------------------------------------
$sql_filterData = "SELECT $sql_includeColums FROM $table $sql_filters $order_sql";
$filterData = $db->query($sql_filterData);
$filteredRowCount = mysqli_num_rows($filterData);
$filterDataArray = $filterData -> fetch_all(MYSQLI_ASSOC);


//Sivumäärä
$pageCount = ceil($filteredRowCount/$limit);
// Reset page
if ($pageCount < $page) {
    $page = 1;
}

//first item to display on this page
if($page) {
    $start = ($page - 1) * $limit;
}               
else {
    $start = 0;
}
        

// Get tablet data ----------------------------------------------------
$sql_tabletData = "$sql_filterData LIMIT $start, $limit";
$talbeData = $db->query($sql_tabletData);
$talbeDataArray = $talbeData -> fetch_all(MYSQLI_ASSOC);
//var_dump($talbeDataArray);

//echo "<br>AllRows: $rowCount, FilterRows: $filteredRowCount, PageCount: $pageCount, Limit: $limit, CurrentPage: $page";


// Hakee unique arvot ja poistaa tyhjät 
//----------------------------------------------------------------------------------------------
$tyyppiDataArray = array_unique(array_filter(array_column($filterDataArray, 'Tyyppi')));
sort($tyyppiDataArray);
//print_r($tyyppiDataArray);
$valmistusmaaDataArray = array_unique(array_filter(array_column($filterDataArray, 'Valmistusmaa')));
sort($valmistusmaaDataArray);
//print_r($valmistusmaaDataArray);
$pullokokoDataArray = array_unique(array_filter(array_column($filterDataArray, 'Pullokoko')));
sort($pullokokoDataArray);
//print_r($pullokokoDataArray);
$HintaMINDataArray = array_unique(array_filter(array_column($filterDataArray, 'Hinta')));
sort($HintaMINDataArray);
//print_r($HintaMINDataArray);
$HintaMAXDataArray = array_unique(array_filter(array_column($filterDataArray, 'Hinta')));
sort($HintaMAXDataArray);
//print_r($HintaMINDataArray);
