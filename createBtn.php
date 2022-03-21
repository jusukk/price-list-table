<?php
// Filter buttons
//----------------------------------------------------------------------------------------------------
function createTyyppiOption($array) {
    global $varTyyppi;

    echo "Tyyppi: <select name='formTyyppi' id='tyyppi' onchange='submit() '>";
    echo "<option value=''>--</option>";
    
    foreach($array as $value){
        if($value == $varTyyppi){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$value' $isSelected>$value</option>";
    }
    echo "</select>";
}

//----------------------------------------------------------------------------------------------------
function createValmistusmaaOption($array) {
    global $varValmistusmaa;

    echo "Valmistusmaa: <select name='formValmistusmaa' id='valmistusmaa' onchange='submit() '>";
    echo "<option value=''>--</option>";
    
    foreach($array as $value){
        if($value == $varValmistusmaa){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$value' $isSelected><a href='?type=$value'>$value</a></option>";
    }
    echo "</select>";
}

//----------------------------------------------------------------------------------------------------
function createPullokokoOption($array) {
    global $varPullokoko;

    echo "Pullokoko: <select name='formPullokoko' id='pullokoko' onchange='submit() '>";
    echo "<option value=''>--</option>";
    
    foreach($array as $value){
        if($value == $varPullokoko){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$value' $isSelected>$value</option>";
    }
    echo "</select>";
}

//----------------------------------------------------------------------------------------------------
function createHintaMINOption($array) {
    global $varHintaMIN;

    echo "Hinta MIN: <select name='formHintaMIN' id='hintaMIN' onchange='submit() '>";
    echo "<option value='0'>--</option>";
    
    foreach($array as $value){
        if($value == $varHintaMIN){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$value' $isSelected>$value</option>";
    }
    echo "</select>";
}

//----------------------------------------------------------------------------------------------------
function createHintaMAXOption($array) {
    global $varHintaMAX;

    echo "Hinta MAX: <select name='formHintaMAX' id='hintaMAX' onchange='submit() '>";
    echo "<option value='99999'>--</option>";
    
    foreach($array as $value){
        if($value == $varHintaMAX){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$value' $isSelected>$value</option>";
    }
    echo "</select>";
}

//----------------------------------------------------------------------------------------------------
function createPagesOption($pageCount) { 
    global $page;
    echo "Sivu: <select name='formPage' id='page' onchange='submit() '>";    
    for ($i=1; $i<=$pageCount; $i++) { 
        if($i == $page){
            // Keep option value
            $isSelected = ' selected="true"';
        } 
        else {
            $isSelected = ''; 
        }
        echo "<option value='$i' $isSelected>$i</option>";
    }
    echo "</select>";

}