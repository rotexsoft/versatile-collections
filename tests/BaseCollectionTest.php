<?php

class BaseCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    public function testThatEmptyConstructorWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        $this->assertEquals($collection->count(), 0);
    }
    
    public function testThatNonEmptyConstructorWorksAsExpected() {
        
        // 10 args to constructor
        $collection_of_std_classes = 
            new \BaseCollectionTestImplementation(
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass()
            );
        
        $this->assertEquals($collection_of_std_classes->count(), 10);
        
        // an array of 10 std class objects
        $collection_of_an_array_of_std_classes = 
            new \BaseCollectionTestImplementation(
                [
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass()
                ]
            );
        
        $this->assertEquals($collection_of_an_array_of_std_classes->count(), 1);
        
        // unpacking an array of 10 std class objects as 10 arguments
        $collection_of_std_classes_via_args_unpacking = 
            new \BaseCollectionTestImplementation(
                ...[
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass(),
                new stdClass()
                ]
            );
        
        $this->assertEquals(
            $collection_of_std_classes_via_args_unpacking->count(), 10
        );
    }
    
    public function testThat__SetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new stdClass();
        $collection->item2 = new stdClass();
        $collection->item3 = new stdClass();
        
        //var_dump($collection->getKeys());
        $this->assertEquals($collection->count(), 3);
        $this->assertEquals($collection->getKeys(), ['item1', 'item2', 'item3']);
    }
    
    public function testThatOffsetSetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection["item1"] = new stdClass();
        $collection["item2"] = new stdClass();
        $collection["item3"] = new stdClass();
        
        $this->assertEquals($collection->count(), 3);
        $this->assertEquals($collection->getKeys(), ['item1', 'item2', 'item3']);
        
        // use the keyless syntax after keyed syntax
        $collection[] = new stdClass();
        $collection[] = new stdClass();
        $collection[] = new stdClass();
        
        //var_dump($collection->getKeys());
        $this->assertEquals($collection->count(), 6);
        $this->assertEquals($collection->getKeys(), ['item1', 'item2', 'item3', 3, 4, 5]);
        
        //keyless syntax starting with an empty collection
        $collection2 = new \BaseCollectionTestImplementation();
        $collection2[] = new stdClass();
        $collection2[] = new stdClass();
        $collection2[] = new stdClass();
        
        $this->assertEquals($collection2->count(), 3);
        $this->assertEquals($collection2->getKeys(), [ 0, 1, 2]);
    }
    
    public function testThat__IssetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new stdClass();
        $collection->item2 = new stdClass();
        $collection->item3 = new stdClass();
        
        //var_dump($collection->getKeys());
        $this->assertEquals($collection->__isset('item1'), true);
        $this->assertEquals($collection->__isset('item2'), true);
        $this->assertEquals($collection->__isset('item3'), true);
        
        $this->assertEquals(isset($collection->item1), true);
        $this->assertEquals(isset($collection->item2), true);
        $this->assertEquals(isset($collection->item3), true);
    }
    
    public function testThatOffsetExistsWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new stdClass();
        $collection->item2 = new stdClass();
        $collection->item3 = new stdClass();
        
        //var_dump($collection->getKeys());
        $this->assertEquals($collection->offsetExists('item1'), true);
        $this->assertEquals($collection->offsetExists('item2'), true);
        $this->assertEquals($collection->offsetExists('item3'), true);
        
        $this->assertEquals(isset($collection['item1']), true);
        $this->assertEquals(isset($collection['item2']), true);
        $this->assertEquals(isset($collection['item3']), true);
        
        $this->assertEquals(isset($collection->item1), true);
        $this->assertEquals(isset($collection->item2), true);
        $this->assertEquals(isset($collection->item3), true);
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThat__GetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        //var_dump($collection);
        $this->assertEquals($collection->item1, 'One');
        $this->assertEquals($collection->item2, 'Two');
        $this->assertEquals($collection->item3, 'Three');
        
        $this->assertEquals($collection->__get('item1'), 'One');
        $this->assertEquals($collection->__get('item2'), 'Two');
        $this->assertEquals($collection->__get('item3'), 'Three');
        
        // this should trigger an Exception
        $collection->__get('item5');
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThatOffsetGetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        //var_dump($collection);
        $this->assertEquals($collection->item1, 'One');
        $this->assertEquals($collection->item2, 'Two');
        $this->assertEquals($collection->item3, 'Three');
        
        $this->assertEquals($collection->offsetGet('item1'), 'One');
        $this->assertEquals($collection->offsetGet('item2'), 'Two');
        $this->assertEquals($collection->offsetGet('item3'), 'Three');
        
        // this should trigger an Exception
        $collection->offsetGet('item5');
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThatOffsetUnsetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        $collection->offsetUnset('item1');
        
        // this should trigger an Exception
        $collection->item1;
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThat__UnsetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        $collection->__unset('item1');
        
        // this should trigger an Exception
        $collection->item1;
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThat__UnsetWorksAsExpected2() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        unset($collection['item1']);
        
        // this should trigger an Exception
        $collection->item1;
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\NonExistentItemException
     */
    public function testThat__UnsetWorksAsExpected3() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        unset($collection->item1);
        
        // this should trigger an Exception
        $collection->item1;
    }
    
    public function testThatToArrayWorksAsExpected() {
        
        $collection_of_strings = 
            new \BaseCollectionTestImplementation('One', 'Two', 'Three', 'Four');
        
        $this->assertEquals(
            $collection_of_strings->toArray(), ['One', 'Two', 'Three', 'Four']
        );
    }
    
    public function testThatGetIteratorWorksAsExpected() {
        
        $collection_of_strings = 
            new \BaseCollectionTestImplementation('One', 'Two', 'Three', 'Four');
        
        $this->assertInstanceOf(
            \ArrayIterator::class, $collection_of_strings->getIterator()
        );
        
        $this->assertEquals($collection_of_strings->getIterator()->count(), 4);
    }
    
    public function testThatFirstItemWorksAsExpected() {
        
        $collection_of_strings = 
            new \BaseCollectionTestImplementation('One', 'Two', 'Three', 'Four');
                
        $this->assertEquals($collection_of_strings->firstItem(), 'One');
    }
    
    public function testThatLastItemWorksAsExpected() {
        
        $collection_of_strings = 
            new \BaseCollectionTestImplementation('One', 'Two', 'Three', 'Four');
                
        $this->assertEquals($collection_of_strings->lastItem(), 'Four');
    }

    public function testThatSetValForEachItemWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
        
        $collection->setValForEachItem('age', '50');
        
        //var_dump($collection);
        $this->assertEquals($collection->item1['age'], '50');
        $this->assertEquals($collection->item2['age'], '50');
        $this->assertEquals($collection->item3['age'], '50');
        
        $collection->setValForEachItem('age', 55);
        $this->assertEquals($collection->item1['age'], 55);
        $this->assertEquals($collection->item2['age'], 55);
        $this->assertEquals($collection->item3['age'], 55);
        
        $collection->setValForEachItem('age22', 27, true);
        $this->assertEquals($collection->item1['age22'], 27);
        $this->assertEquals($collection->item2['age22'], 27);
        $this->assertEquals($collection->item3['age22'], 27);
        
        try {
            
            $collection->setValForEachItem('age4', '48');
            
        } catch (\Exception $exc) {
            
            $this->assertInstanceOf(
                \VersatileCollections\Exceptions\InvalidCollectionOperationException::class, 
                $exc
            );
        }

        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = (object)['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = (object)['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = (object)['name'=>'Janice', 'age'=>'30',];
        
        $collection->setValForEachItem('age', 24);
        $this->assertEquals($collection->item1->age, 24);
        $this->assertEquals($collection->item2->age, 24);
        $this->assertEquals($collection->item3->age, 24);
        
        $collection->setValForEachItem('age', '48');
        $this->assertEquals($collection->item1->age, '48');
        $this->assertEquals($collection->item2->age, '48');
        $this->assertEquals($collection->item3->age, '48');
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new TestValueObject('Joe');
        $collection->item2 = new TestValueObject('Jane');
        $collection->item3 = new TestValueObject('Janice');
        
        $collection->setValForEachItem('age', 24);
        $this->assertEquals($collection->item1->age, 24);
        $this->assertEquals($collection->item2->age, 24);
        $this->assertEquals($collection->item3->age, 24);
        
        $collection->setValForEachItem('age', '48');
        $this->assertEquals($collection->item1->age, '48');
        $this->assertEquals($collection->item2->age, '48');
        $this->assertEquals($collection->item3->age, '48');
        
        $collection->setValForEachItem('age3', '59', true);
        $this->assertEquals($collection->item1->age3, '59');
        $this->assertEquals($collection->item2->age3, '59');
        $this->assertEquals($collection->item3->age3, '59');
        
        try {
            
            $collection->setValForEachItem('age4', '48');
            
        } catch (\Exception $exc) {
            
            $this->assertInstanceOf(
                \VersatileCollections\Exceptions\InvalidCollectionOperationException::class, 
                $exc
            );
        }
    }
}
