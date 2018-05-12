<?php

class BaseCollectionTest extends \PHPUnit_Framework_TestCase {
    
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    public function testThatMakeNewCollectionWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\BaseCollectionTestImplementation::class, $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\BaseCollectionTestImplementation::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\CallablesCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\CallablesCollection::class, $collection);
        
        $collection = \VersatileCollections\CallablesCollection::makeNewCollection(['strtolower', 'strtoupper', function(){ return 'boo'; }]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\CallablesCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\FloatCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\FloatCollection::class, $collection);
        
        $collection = \VersatileCollections\FloatCollection::makeNewCollection([1.1, 2.2, 3.3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\FloatCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\GenericCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\GenericCollection::class, $collection);
        
        $collection = \VersatileCollections\GenericCollection::makeNewCollection([1.1, 2.2, 3.3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\GenericCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\IntCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\IntCollection::class, $collection);
        
        $collection = \VersatileCollections\IntCollection::makeNewCollection([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\IntCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\NumericsCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\NumericsCollection::class, $collection);
        
        $collection = \VersatileCollections\NumericsCollection::makeNewCollection([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\NumericsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ObjectCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ObjectCollection::class, $collection);
        
        $collection = \VersatileCollections\ObjectCollection::makeNewCollection([new stdClass(), new ArrayObject(), new DateTime('2000-04-04')]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ObjectCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ResourceCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ResourceCollection::class, $collection);
        
        $collection = \VersatileCollections\ResourceCollection::makeNewCollection([tmpfile(), tmpfile(), tmpfile()]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ResourceCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ScalarCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ScalarCollection::class, $collection);
        
        $collection = \VersatileCollections\ScalarCollection::makeNewCollection([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ScalarCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\StringCollection::makeNewCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\StringCollection::class, $collection);
        
        $collection = \VersatileCollections\StringCollection::makeNewCollection(['1', '2', '3']);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\StringCollection::class, $collection);
        
        ////////////////////////////////////////////////////////////////////////
        // Test with array with string keys and preserve keys
        ////////////////////////////////////////////////////////////////////////
        $collection = \BaseCollectionTestImplementation::makeNewCollection(['a'=>'taylor', 'b'=>'abigail', null]);
        
        $this->assertTrue($collection->containsKey('a'));
        $this->assertTrue($collection->containsKey('b'));
        $this->assertTrue($collection->containsKey(0));
        $this->assertTrue($collection->containsItem('taylor'));
        $this->assertTrue($collection->containsItem('abigail'));
        $this->assertTrue($collection->containsItem(null));
        $this->assertTrue($collection['a'] === 'taylor');
        $this->assertTrue($collection['b'] === 'abigail');
        $this->assertTrue($collection[0] === null);
        
        ////////////////////////////////////////////////////////////////////////
        // Test with array with numeric keys, don't preserve keys
        ////////////////////////////////////////////////////////////////////////
        $collection = \BaseCollectionTestImplementation::makeNewCollection([5=>'taylor', 10=>'abigail', 9=>null], false);

        $this->assertTrue($collection->containsKey(0));
        $this->assertTrue($collection->containsKey(1));
        $this->assertTrue($collection->containsKey(2));
        $this->assertTrue(!$collection->containsKey(10));
        $this->assertTrue(!$collection->containsKey(5));
        $this->assertTrue(!$collection->containsKey(9));
        $this->assertTrue($collection->containsItem('taylor'));
        $this->assertTrue($collection->containsItem('abigail'));
        $this->assertTrue($collection->containsItem(null));
        $this->assertTrue($collection[0] === 'taylor');
        $this->assertTrue($collection[1] === 'abigail');
        $this->assertTrue($collection[2] === null);
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
        $this->assertEquals($collection->getKeys(), ['item1', 'item2', 'item3', 0, 1, 2]);
        
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
    
    public function testThatFilterWorksAsExpected() {
        
        $collection_of_ints = 
            new \BaseCollectionTestImplementation(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        // don't preserve keys
        $collection_of_even_ints = $collection_of_ints->filterAll(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            }    
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [2, 4, 6, 8, 10]
        );
        
        // preserve keys 
        $collection_of_even_ints = $collection_of_ints->filterAll(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            true
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [1=>2, 3=>4, 5=>6, 7=>8, 9=>10]
        );
    }
    
    public function testThatFilterFirstN_WorksAsExpected() {
        
        $collection_of_ints = 
            new \BaseCollectionTestImplementation(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        // don't preserve keys
        $collection_of_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            }    
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [2, 4, 6, 8, 10]
        );
        
        // first 3
        $collection_of_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            3
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [2, 4, 6]
        );
        
        // preserve keys 
        $collection_of_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            null,
            true
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [1=>2, 3=>4, 5=>6, 7=>8, 9=>10]
        );
        
        $collection_of_even_ints = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return ($item % 2) === 0;
            },
            3,
            true
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [1=>2, 3=>4, 5=>6]
        );
    }
    
    public function testThatTransformWorksAsExpected() {
        
        $collection_of_ints = 
            new \BaseCollectionTestImplementation(2, 4, 6, 8);
        
        $collection_of_ints->transform(
            
            function($key, $item) {
            
                return $item * $item;
            }    
        );
        
        $this->assertEquals(
            $collection_of_ints->toArray(), [4, 16, 36, 64]
        );
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
    
    public function testThatIsEmptyWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        //var_dump($collection->getKeys());
        $this->assertTrue($collection->isEmpty());
        
        $collection[] = 'some item';
        $this->assertTrue($collection->isEmpty() === false);
    }
    
    public function testThatGetIfExistsWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        
        //var_dump($collection->getKeys());
        $this->assertEquals($collection->getIfExists('item1'), ['name'=>'Joe', 'age'=>'10',]);
        $this->assertEquals($collection->getIfExists('item2'), ['name'=>'Jane', 'age'=>'20',]);
        $this->assertEquals($collection->getIfExists('item3'), null);
        
        $collection = new \BaseCollectionTestImplementation();
        $collection[] = ['name'=>'Joe', 'age'=>'10',];
        $collection[] = ['name'=>'Jane', 'age'=>'20',];
        
        $this->assertEquals($collection->getIfExists(0), ['name'=>'Joe', 'age'=>'10',]);
        $this->assertEquals($collection->getIfExists(1), ['name'=>'Jane', 'age'=>'20',]);
        $this->assertEquals($collection->getIfExists(2), null);
    }
    
    public function testThatContainsItemWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        $item4 = true;
        $item5 = false;
        $item6 = tmpfile();
        $item7 = new \ArrayObject();
        $item8 = function(){ return 'Hello World!'; };
        
        $collection = new \BaseCollectionTestImplementation(
            $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8
        );
        
        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertTrue($collection->containsItem($item5));
        $this->assertTrue($collection->containsItem($item6));
        $this->assertTrue($collection->containsItem($item7));
        $this->assertTrue($collection->containsItem($item8));
        $this->assertFalse($collection->containsItem('not in collection'));
        $this->assertFalse($collection->containsItem(4));
        $this->assertFalse($collection->containsItem('5.0'));
        $this->assertFalse($collection->containsItem('7'));
    }
    
    public function testThatContainsKeyWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        
        $collection = 
            new \BaseCollectionTestImplementation($item1, $item2, $item3);
        
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        
        $this->assertTrue($collection->containsKey(0));
        $this->assertTrue($collection->containsKey('0'));
        $this->assertTrue($collection->containsKey(1));
        $this->assertTrue($collection->containsKey(2));
        $this->assertTrue($collection->containsKey('item1'));
        $this->assertTrue($collection->containsKey('item2'));
        $this->assertFalse($collection->containsKey('not in collection'));
    }
    
    public function testThatAppendCollectionWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        $item4 = true;
        $item5 = false;
        $item6 = tmpfile();
        $item7 = new \ArrayObject();
        $item8 = function(){ return 'Hello World!'; };
        
        $collection = new \BaseCollectionTestImplementation(
            $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8
        );
        
        $other_item1 = "4";
        $other_item2 = 5.0;
        $other_item3 = 7;
        $other_item4 = true;
        $other_item5 = false;
        $other_item6 = tmpfile();
        $other_item7 = new \ArrayObject();
        $other_item8 = function(){ return 'Hello World!'; };
        
        $other_collection = new \BaseCollectionTestImplementation(
            $other_item1, $other_item2, $other_item3, $other_item4, 
            $other_item5, $other_item6, $other_item7, $other_item8
        );
        
        $collection->appendCollection($other_collection);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($other_item5));
        $this->assertTrue($collection->containsItem($other_item6));
        $this->assertTrue($collection->containsItem($other_item7));
        $this->assertTrue($collection->containsItem($other_item8));
        $this->assertFalse($collection->containsItem('not in collection'));
        $this->assertFalse($collection->containsItem(4));
        $this->assertFalse($collection->containsItem('5.0'));
        $this->assertFalse($collection->containsItem('7'));
    }
    
    public function testThatGetCollectionsOfSizeNWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
        );
        
        $collections = iterator_to_array($collection->getCollectionsOfSizeN(3));
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14,14=>15], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14
        );
        
        $collections = iterator_to_array($collection->getCollectionsOfSizeN(3));
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->getCollectionsOfSizeN(50));
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->getCollectionsOfSizeN(-50));
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->getCollectionsOfSizeN(null));
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );
    }

    public function testThatMakeAllKeysNumericWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
        
        $item1 = $collection->item1;
        $item2 = $collection->item2;
        $item3 = $collection->item3;
        
        $this->assertTrue($collection->containsKey('item1'));
        $this->assertTrue($collection->containsKey('item2'));
        $this->assertTrue($collection->containsKey('item3'));
        
        $collection->makeAllKeysNumeric();
        
        $this->assertTrue($collection->containsKey(0));
        $this->assertTrue($collection->containsKey(1));
        $this->assertTrue($collection->containsKey(2));
        
        $this->assertFalse($collection->containsKey('item1'));
        $this->assertFalse($collection->containsKey('item2'));
        $this->assertFalse($collection->containsKey('item3'));
        
        $this->assertEquals($collection[0], $item1);
        $this->assertEquals($collection[1], $item2);
        $this->assertEquals($collection[2], $item3);
    }
}
