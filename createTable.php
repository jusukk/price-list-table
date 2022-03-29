<?php

function createTable($array) {
    // If data found
    if (!empty($array)) {
        $html = '<table>';
        // Header row
        $html .= '<tr>';
        foreach($array[0] as $key=>$value) {
                $html .= '<th>' . htmlspecialchars($key) . '</th>';
            }
        $html .= '</tr>';

        // Data rows
        foreach( $array as $key=>$value) {
            $html .= '<tr>';
            foreach($value as $key2=>$value2) {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        echo $html;
    }
    else {
        echo "<br><h2>Ei tuloksia</h2>";
    }
}

