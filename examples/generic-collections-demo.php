<?php
error_reporting(E_ALL | E_STRICT);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';

use function \VersatileCollections\var_to_string;

$array = [];

class Boo {
}
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

//$collection2 = \BaseCollectionTestImplementation::makeNew(
//    [ 
//        'a'=>'blue', 'b'=>'red', 'c'=>'green', 
//        'd'=>'red', 'e'=>1, 'f'=>'blue', 'g'=>'2' 
//    ]
//);


$data = [];
//$data[] = (object)['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
//$data[] = (object)['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
//$data[] = (object)['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
//$data[] = (object)['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
//$data[] = (object)['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
//$data[] = (object)['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];

//$data[] = (object)['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
//$data[] = (object)['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
//$data[] = (object)['id' => [], 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
//$data[] = (object)['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
//$data[] = (object)['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
//$data[] = (object)['id' => [], 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];

//$data[] = (new TestValueObject())->setData(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = (new TestValueObject())->setData(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = (new TestValueObject())->setData(['id' => [], 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = (new TestValueObject())->setData(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = (new TestValueObject())->setData(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = (new TestValueObject())->setData(['id' => [], 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);

//$data[] = (new TestValueObject())->setData(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = (new TestValueObject())->setData(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = (new TestValueObject())->setData(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = (new TestValueObject())->setData(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = (new TestValueObject())->setData(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = (new TestValueObject())->setData(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);

//$data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
//$data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
//$data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
//$data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
//$data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
//$data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];

//$data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
//$data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
//$data[] = ['id' => [], 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
//$data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
//$data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
//$data[] = ['id' => [], 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];

//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => [], 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => [], 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);

//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
//$data[] = true;

//$collection = new \VersatileCollections\GenericCollection(...$data);
//$sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
//$sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
//$sorted_collection = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
//echo VersatileCollections\var_to_string($sorted_collection->toArray()) . PHP_EOL;
//echo VersatileCollections\var_to_string($collection->column('name2', 'id')->toArray()) . PHP_EOL;
//        $data = [];
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]);
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
//        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
//        $collection = new \VersatileCollections\GenericCollection(...$data);
//
//echo 'array_product($array) '.\VersatileCollections\var_to_string(array_product([100, 2.5])). PHP_EOL;
//        
//
//echo \VersatileCollections\var_to_string(
//        \VersatileCollections\GenericCollection::makeNew(
//            [
//                ['brand' => 'Tesla',  'color' => 'red'],
//                ['brand' => 'Pagani', 'color' => 'white'],
//                ['brand' => 'Tesla',  'color' => 'black'],
//                ['brand' => 'Pagani', 'color' => 'orange'],
//            ]
//        )
//        ->toArray()
//    );
//
//echo \VersatileCollections\var_to_string(
//        \VersatileCollections\GenericCollection::makeNew(
//            [
//                ['brand' => 'Tesla',  'color' => 'red'],
//                ['brand' => 'Pagani', 'color' => 'white'],
//                ['brand' => 'Tesla',  'color' => 'black'],
//                ['brand' => 'Pagani', 'color' => 'orange'],
//            ]
//        )
//        ->makeAllKeysNumeric(777)
//        ->toArray()
//    );
//
//$c = \VersatileCollections\GenericCollection::makeNew(['name' => 'Hello']);
//
//echo \VersatileCollections\var_to_string(
//        $c->unionWith(['id' => 1])->toArray()
//    );

$collection = new \VersatileCollections\GenericCollection("red", "green", "blue", "yellow");
// remove the third element in the collection up until the last
$collection->splice(2); // returns a collection containing
                        // [ 0=>'blue', 1=>'yellow' ]
// $collection now contains [ 0=>'red', 1=>'green' ]


$collection = new \VersatileCollections\GenericCollection("red", "green", "blue", "yellow");
// remove the second element in the collection up until the last 
// and replace all of them with an item: "orange"
$collection->splice(1, count($collection), ["orange"]); // returns a collection containing 
                                                        // [ 0=>'green', 1=>'blue', 2=>'yellow' ]
// $collection now contains [ 0=>'red', 1=>'orange' ]
