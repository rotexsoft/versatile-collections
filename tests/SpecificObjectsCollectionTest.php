<?php
declare(strict_types=1);
/**
 * Description of ScalarsCollectionTest
 *
 * @author Rotimi Ade
 */
class SpecificObjectsCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatMakeNewForSpecifiedClassName_WithoutAnyArgsCanStoreInstancesOfAnyClass() {

        $item1 = new stdClass();
        $item2 = new DateTime('2000-01-01');
        $item3 = new \PDO(
            'sqlite::memory:',
            null,
            null,
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ]
        );
        $item4 = new ArrayObject();

        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName();
        $collection->item1 = $item1;
        $collection->item2 = $item2;
        $collection->item3 = $item3;
        $collection->item4 = $item4;

        $this->assertTrue($collection->containsItemWithKey('item1', $item1));
        $this->assertTrue($collection->containsItemWithKey('item2', $item2));
        $this->assertTrue($collection->containsItemWithKey('item3', $item3));
        $this->assertTrue($collection->containsItemWithKey('item4', $item4));

    }

    public function testThatMakeNewForSpecifiedClassName_WithNullClassNameAndOtherArgsCanStoreInstancesOfAnyClass() {
        
        $item1 = new stdClass();
        $item2 = new DateTime('2000-01-01');
        $item3 = new \PDO(
            'sqlite::memory:',
            null,
            null,
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ]
        );
        $item4 = new ArrayObject();
        
        // keys preserved
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            null,
            [
                'item1' => $item1,
                'item2' => $item2,
                'item3' => $item3,
                'item4' => $item4
            ]
        ); // omit last parameter which has a default value of true
        $this->assertTrue($collection->containsItemWithKey('item1', $item1));
        $this->assertTrue($collection->containsItemWithKey('item2', $item2));
        $this->assertTrue($collection->containsItemWithKey('item3', $item3));
        $this->assertTrue($collection->containsItemWithKey('item4', $item4));

        // keys not preserved
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            null,
            [
                'item1' => $item1,
                'item2' => $item2,
                'item3' => $item3,
                'item4' => $item4
            ],
            false
        );
        $this->assertTrue($collection->containsItemWithKey(0, $item1));
        $this->assertTrue($collection->containsItemWithKey(1, $item2));
        $this->assertTrue($collection->containsItemWithKey(2, $item3));
        $this->assertTrue($collection->containsItemWithKey(3, $item4));
        
        $this->assertFalse($collection->containsItemWithKey('item1', $item1));
        $this->assertFalse($collection->containsItemWithKey('item2', $item2));
        $this->assertFalse($collection->containsItemWithKey('item3', $item3));
        $this->assertFalse($collection->containsItemWithKey('item4', $item4));
    }
    
    public function testThatMakeNewForSpecifiedClassName_WithArgsCanStoreOnlyInstancesOfTheSpecifiedClassAndItsSubclasses() {

        $item1 = new \ArrayIterator(); // parent class instance
        $item2 = new \ArrayIterator(); // parent class instance
        $item3 = new \RecursiveArrayIterator(); // child class instance
        $item4 = new \RecursiveArrayIterator(); // child class instance

        // Create a collection that stores only instances of \ArrayObject
        // Store 2 instances of \ArrayObject and test that they exist in the collection
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            \ArrayIterator::class, ['item1'=>$item1, 'item2'=>$item2, 'item3'=>$item3, 'item4'=>$item4 ], false
        );
        $this->assertTrue($collection->containsItemWithKey(0, $item1));
        $this->assertTrue($collection->containsItemWithKey(1, $item2));
        $this->assertTrue($collection->containsItemWithKey(2, $item3));
        $this->assertTrue($collection->containsItemWithKey(3, $item4));

        $collection_keys_preserved = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            \ArrayIterator::class, ['item1'=>$item1, 'item2'=>$item2, 'item3'=>$item3, 'item4'=>$item4], true
        );
        $this->assertTrue($collection_keys_preserved->containsItemWithKey('item1', $item1));
        $this->assertTrue($collection_keys_preserved->containsItemWithKey('item2', $item2));
        $this->assertTrue($collection_keys_preserved->containsItemWithKey('item3', $item3));
        $this->assertTrue($collection_keys_preserved->containsItemWithKey('item4', $item4));
    }

//    public function testThatMakeNewForSpecifiedClassName_ThrowsAnExceptionWhenTheSpecifiedClassDoesNotExist() {
//
//        // Make sure that when the specified class does not exist, the
//        // \VersatileCollections\Exceptions\SpecifiedClassNotFoundException is thrown
//        $non_existent_class_name = 'NonExistentClass';
//        $msg = "Trying to create a new collection that stores only objects of the specified type `{$non_existent_class_name}` but the specified class not found by `class_exists('{$non_existent_class_name}')`.";
//        $this->expectExceptionMessage($msg);
//        $this->expectException(\VersatileCollections\Exceptions\SpecifiedClassNotFoundException::class);
//        \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
//            $non_existent_class_name
//        ); // will throw \VersatileCollections\Exceptions\SpecifiedClassNotFoundException
//    }

    public function testThatInvalidItemExceptionIsThrownWhenItemOfNonObjectTypeIsSuppliedToMakeNewForSpecifiedClassNameWith_A_NullClassName() {

        $item1 = new ArrayObject();
        $item2 = new ArrayObject();
        $item3 = new DateTime('2000-01-01');
        $item4 = "boo";

        // When creating a collection for instances of ArrayObject and instances of
        // other classes are added, make sure that the
        // \VersatileCollections\Exceptions\InvalidItemException is thrown
        $right_type_name = 'object';
        $wrong_type_name = 'string';
        $msg = " Trying to add an item of type `{$wrong_type_name}` to a strictly typed collection for items of type(s) `{$right_type_name}`";
        $this->expectExceptionMessage($msg);
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            null, [$item1, $item2, $item3, $item4 ]
        );
    }

    public function testThatInvalidItemExceptionIsThrownWhenItemOfDifferentTypeIsSuppliedToMakeNewForSpecifiedClassName_1() {

        $item1 = new ArrayObject();
        $item2 = new ArrayObject();
        $item3 = new DateTime('2000-01-01');

        // When creating a collection for instances of ArrayObject and instances of
        // other classes are added, make sure that the
        // \VersatileCollections\Exceptions\InvalidItemException is thrown
        $right_type_name = \ArrayObject::class;
        $wrong_type_name = \DateTime::class;
        $msg = " Trying to add an item of type `{$wrong_type_name}` to a strictly typed collection for items of type(s) `{$right_type_name}`";
        $this->expectExceptionMessage($msg);
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            $right_type_name, [$item1, $item2, $item3 ]
        );
    }

    public function testThatInvalidItemExceptionIsThrownWhenItemOfDifferentTypeIsSuppliedToMakeNewForSpecifiedClassName_2() {

        $item1 = new ArrayObject();
        $item2 = new ArrayObject();
        $item3 = new \PDO(
            'sqlite::memory:',
            null,
            null,
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ]
        );

        // When creating a collection for instances of ArrayObject and instances of
        // other classes are added, make sure that the
        // \VersatileCollections\Exceptions\InvalidItemException is thrown
        $right_type_name = \ArrayObject::class;
        $wrong_type_name = \PDO::class;
        $msg = " Trying to add an item of type `{$wrong_type_name}` to a strictly typed collection for items of type(s) `{$right_type_name}`";
        $this->expectExceptionMessage($msg);
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            $right_type_name, [$item1, $item2, $item3 ]
        );
    }

    public function testThatInvalidItemExceptionIsThrownWhenItemOfDifferentTypeIsSuppliedToMakeNewForSpecifiedClassName_3() {

        $item1 = new ArrayObject();
        $item2 = new ArrayObject();
        $item3 = new stdClass();

        // When creating a collection for instances of ArrayObject and instances of
        // other classes are added, make sure that the
        // \VersatileCollections\Exceptions\InvalidItemException is thrown
        $right_type_name = \ArrayObject::class;
        $wrong_type_name = \stdClass::class;
        $msg = " Trying to add an item of type `{$wrong_type_name}` to a strictly typed collection for items of type(s) `{$right_type_name}`";
        $this->expectExceptionMessage($msg);
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            $right_type_name, [$item1, $item2, $item3 ]
        );
    }

    public function testThatProtectedConstructorCannotBeInvokedFromOutsideTheSpecificObjectsCollectionClass() {

        try {
            $class_name = \VersatileCollections\SpecificObjectsCollection::class;
            $collection = new $class_name();
            $this->assertTrue(false); // force test to fail if line above did not throw Error

        } catch (\Throwable $e) {

            $this->assertStringContainsString(
                'Call to protected ' .\VersatileCollections\SpecificObjectsCollection::class. '::__construct()',
                $e->getMessage()
            );
        }
    }

    public function testThatCheckTypeWorksAsExpected() {

        $item1 = new ArrayObject();
        $item2 = new ArrayObject();
        $item3 = new ArrayObject();
        $item4 = new stdClass();
        $item5 = new \PDO(
            'sqlite::memory:',
            null,
            null,
            [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ]
        );
        $item6 = new DateTime('2000-01-01');

        // Create a collection that stores only instances of \ArrayObject
        // Store 2 instances of \ArrayObject and test that they exist in the collection
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            \ArrayObject::class, ['item1'=>$item1, 'item2'=>$item2]
        );
        $this->assertTrue($collection->checkType($item1));
        $this->assertTrue($collection->checkType($item2));
        $this->assertTrue($collection->checkType($item3));
        $this->assertFalse($collection->checkType($item4));
        $this->assertFalse($collection->checkType($item5));
        $this->assertFalse($collection->checkType($item6));

        // Create a collection that stores instances of any class
        // Store 2 instances of \ArrayObject and test that they exist in the collection
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName();
        $this->assertTrue($collection->checkType($item1));
        $this->assertTrue($collection->checkType($item2));
        $this->assertTrue($collection->checkType($item3));
        $this->assertTrue($collection->checkType($item4));
        $this->assertTrue($collection->checkType($item5));
        $this->assertTrue($collection->checkType($item6));
    }

    public function testThatGetTypeWorksAsExpected() {

        // Create a collection that stores only instances of \ArrayObject
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName(
            \ArrayObject::class
        );
        $this->assertStringContainsString($collection->getTypes()->firstItem(), \ArrayObject::class);

        // Create a collection that stores instances of any class
        $object_collection = \VersatileCollections\ObjectsCollection::makeNew();
        $collection = \VersatileCollections\SpecificObjectsCollection::makeNewForSpecifiedClassName();

        // because no class was specified, the parent class' (i.e. ObjectsCollection) getType() always gets called
        $this->assertStringContainsString($collection->getTypes()->firstItem(), $object_collection->getTypes()->firstItem());
    }
}
