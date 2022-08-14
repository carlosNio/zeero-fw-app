<?php

/**
 * 
 * HERE YOU CAN WRITE YOUR TWIG FUNCTIONS FOR USE IN TEMPLATES
 * 
 */

use Twig\TwigFunction;

$functions = [];


// you can define your twig functions here
// $functions[] = new TwigFunction('fn_name', function ($arg) {

// });

// 
// STORE FUNCTIONS
foreach ($functions as $fn) {
    app("twig")->addFunction($fn);
}
