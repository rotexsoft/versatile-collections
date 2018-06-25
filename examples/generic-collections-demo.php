<?php
error_reporting(E_ALL | E_STRICT);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';

$array = [];

//$obj1 = new stdClass();
//$obj1->name = 'Zoe';
//$array[] = $obj1;
//
//$obj1 = new stdClass();
//$obj1->name = 'Yoe';
//$array[] = $obj1;
//
//$obj1 = new stdClass();
//$obj1->name = 'Roe';
//$array[] = $obj1;
//
//$obj1 = new stdClass();
//$obj1->name = 'Joe';
//$array[] = $obj1;

//$array[] = new TestValueObject('Johnny Cash', 50);
//$array[] = new TestValueObject('Suzzy Something', 23);
//$array[] = new TestValueObject('Jack Bauer', 43);
//$array[] = new TestValueObject('Jane Fonda', 55);
//        
//echo \VersatileCollections\var_to_string($array) . PHP_EOL;
//
//asort($array);
//
//echo \VersatileCollections\var_to_string($array) . PHP_EOL;

//$collection2 = \BaseCollectionTestImplementation::makeNewCollection(
//    [ 
//        'a'=>'blue', 'b'=>'red', 'c'=>'green', 
//        'd'=>'red', 'e'=>1, 'f'=>'blue', 'g'=>'2' 
//    ]
//);


$data = [];
$data[0] = [ 'volume' => 67, 'edition' => 2 ];
$data[1] = [ 'volume' => 86, 'edition' => 2 ];
$data[2] = [ 'volume' => 85, 'edition' => 6 ];
$data[3] = [ 'volume' => 86, 'edition' => 1 ];

$collection = new \VersatileCollections\GenericCollection(...$data);
$sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
$sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
$sorted_collection = $collection->sortMeByMultipleFields($sort_param, $sort_param2);

//echo VersatileCollections\var_to_string($sorted_collection->toArray()) . PHP_EOL;
echo VersatileCollections\var_to_string($collection->toArray()) . PHP_EOL;

