<?php
error_reporting(E_ALL | E_STRICT);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';

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

//$collection2 = \BaseCollectionTestImplementation::makeNewCollection(
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

//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => [], 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => [], 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);

//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
//$data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
//$data[] = true;

$collection = new \VersatileCollections\GenericCollection(...$data);
//$sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
//$sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
//$sorted_collection = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
//echo VersatileCollections\var_to_string($sorted_collection->toArray()) . PHP_EOL;
//echo VersatileCollections\var_to_string($collection->column('name2', 'id')->toArray()) . PHP_EOL;
        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNewCollection(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        $collection = new \VersatileCollections\GenericCollection(...$data);


//echo VersatileCollections\var_to_string($collection->column(777, 'title')->toArray()) . PHP_EOL;
        
//$obj = (object)['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
$obj = (new Boo());

$property = 7777;
$obj->{$property} = 'booo';
echo VersatileCollections\var_to_string($obj) . PHP_EOL;
//echo VersatileCollections\var_to_string(property_exists($obj, 777)) . PHP_EOL;
//echo VersatileCollections\var_to_string(get_object_vars($obj)) . PHP_EOL;
//echo VersatileCollections\var_to_string( ((array)$obj)[$property] ) . PHP_EOL;


