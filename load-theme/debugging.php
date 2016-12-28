<?php
/**
 * Debugging Functions
 */


function display_value( $value ) {
    echo "<h1> The Value is: " . $value ;
}

function display_elements( $array ) {
    echo "<pre>";
    var_dump( $array );
    echo "</pre>";
}