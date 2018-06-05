<?php

error_reporting(E_ALL | E_STRICT);

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';

$numeric_collection = new \VersatileCollections\NumericsCollection(
    1.0, 2.0, 3, 4, 5, 6
);

$numeric_collection->each(
        
    function($key, $item) {

        static $count;

        if( !$count ) {

            $count = 1;
        }

        echo "$key : $item count: {$this->count()}". PHP_EOL;

        if( ceil($this->count() / 2) == $count++ ) {

            return false;
        }

    }, 
    false, 
    true
);

$int_collection = new \VersatileCollections\IntCollection(
    8, 9, 10, 11
);
// append a sub-class collection
$numeric_collection->merge($int_collection);

//var_dump( $numeric_collection->toArray() );
        

$int_collection = new \VersatileCollections\IntCollection(1, 2, 3, 4, 5);

$multiplied = $int_collection->map(function ($key, $item) {
    return $item * 2;
});

print_r($multiplied->toArray());

//$float_collection = new \VersatileCollections\FloatCollection(
//    8.5, 9.7, 10.8, 11.9
//);
//// append another sub-class collection
//$numeric_collection->merge($float_collection);
//
//var_dump($numeric_collection->toArray());


        
