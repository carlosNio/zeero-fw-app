<?php

use Twig\TwigFilter;

/**
 * 
 * HERE YOU CAN WRITE YOUR TWIG FILTERS FOR USE IN TEMPLATES
 * 
 */

$filters = [];



// example
// $filters[] = new TwigFilter('filter_name', function () {
//     // define your custom filter for twig
// }, []);



// STORE FILTERS
foreach ($filters as $filter) {
    app("twig")->addFilter($filter);
}