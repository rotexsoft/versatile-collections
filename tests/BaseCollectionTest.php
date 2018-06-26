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
    
    public function testThatFilterAllWorksAsExpected() {
        
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

        // test $this inside callback
        $collection_of_ints_except_first_and_last_items = $collection_of_ints->filterFirstN(
            
            function($key, $item) {
            
                return $item !== $this->lastItem()
                     && $item !== $this->firstItem();
            },
            null,
            false
        );
        
        $this->assertEquals(
            $collection_of_ints_except_first_and_last_items->toArray(), [2, 3, 4, 5, 6, 7, 8, 9]
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
        
        // reference $this in callback
        $collection_of_ints = 
            new \BaseCollectionTestImplementation(2, 4, 6, 8);
        
        $collection_of_ints->transform(
            
            function($key, $item) {
            
                return $item * $this->count();
            }    
        );
        
        $this->assertEquals(
            $collection_of_ints->toArray(), [8, 16, 24, 32]
        );
    }
    
    public function testThatEachWorksAsExpected() {
        
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1, 2, 3, 4, 5, 6
        );
        
        $accumulator = 0;
        $counter = 1;
        
        $first_half_summator = function($key, $item) use (&$accumulator, &$counter) {
            
            $accumulator = $accumulator + $item;

            if( ((int)ceil($this->count() / 2)) === $counter++ ) {

                return false;
            }

        };
        
        $all_items_summator = function($key, $item) use (&$accumulator) {
            
            $accumulator += $item;
        };

        // sum of first half of [1, 2, 3, 4, 5, 6]
        // i.e. 1 + 2 + 3 = 6
        $numeric_collection->each(
            $first_half_summator, 
            false, 
            true
        );
        $this->assertEquals($accumulator, 6);
        
        //reset accumulator
        $accumulator = 0;
        
        // sum of all of [1, 2, 3, 4, 5, 6]
        // i.e. 1 + 2 + 3 + 4 + 5 + 6 = 21
        $return_val_from_each = $numeric_collection->each(
            $all_items_summator, 
            false, 
            false
        );
        $this->assertEquals($accumulator, 21);
        
        $this->assertSame($return_val_from_each, $numeric_collection);
    }
    
    public function testThatMapWorksAsExpected() {
        
        $int_collection = new \VersatileCollections\IntCollection(1, 2, 3, 4, 5);

        $multiplied = $int_collection->map(
            function ($key, $item) {
                return $item * 2;
            },
            false,
            false
        );
        $this->assertEquals($multiplied->toArray(), [2, 4, 6, 8, 10]);

        $multiplied = $int_collection->map(
            function ($key, $item) {
                return $item * $this->count();
            },
            false,
            true
        );
        $this->assertEquals($multiplied->toArray(), [5, 10, 15, 20, 25]);
        
        // test preserve keys
        $int_collection = new \VersatileCollections\IntCollection();
        $int_collection[5] = 1;
        $int_collection[6] = 2;
        $int_collection[7] = 3;
        $int_collection[8] = 4;
        $int_collection[9] = 5;
        
        $multiplied = $int_collection->map(
            function ($key, $item) {
                return $item * $this->count();
            },
            true,
            true
        );
        $this->assertEquals($multiplied->toArray(), [5=>5, 6=>10, 7=>15, 8=>20, 9=>25]);
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

        $collection_of_collections = new \BaseCollectionTestImplementation( );
        $collection_of_collections->item1 = \BaseCollectionTestImplementation::makeNewCollection( ['name'=>'Joe', 'age'=>'10'] );
        $collection_of_collections->item2 = \BaseCollectionTestImplementation::makeNewCollection( ['name'=>'Jane', 'age'=>'20'] );
        $collection_of_collections->item3 = \BaseCollectionTestImplementation::makeNewCollection( ['name'=>'Janice', 'age'=>'30'] );
        
        $collection_of_collections->setValForEachItem('age', '50');
        
        $this->assertEquals($collection_of_collections->item1['age'], '50');
        $this->assertEquals($collection_of_collections->item2['age'], '50');
        $this->assertEquals($collection_of_collections->item3['age'], '50');
        
        $collection_of_collections->setValForEachItem('age', 55);
        $this->assertEquals($collection_of_collections->item1['age'], 55);
        $this->assertEquals($collection_of_collections->item2['age'], 55);
        $this->assertEquals($collection_of_collections->item3['age'], 55);
        
        ////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////
        
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
    
    public function testThatContainsKeysWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        
        $collection = 
            new \BaseCollectionTestImplementation($item1, $item2, $item3);
        
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        
        $this->assertTrue($collection->containsKeys([0]));
        $this->assertTrue($collection->containsKeys([0, 1]));
        $this->assertTrue($collection->containsKeys([0, 1, 2]));
        $this->assertTrue($collection->containsKeys([0, 1, 2, 'item1']));
        $this->assertTrue($collection->containsKeys([0, 1, 2, 'item1', 'item2']));
        $this->assertFalse($collection->containsKeys(['not in collection']));
        $this->assertFalse($collection->containsKeys([0, 1, 2, 'item1', 'item2', 'not in collection']));
        
        $collection[] = 55;
        $this->assertTrue($collection->containsKeys([0, 1, 2, 'item1', 'item2', 3]));
        $this->assertFalse($collection->containsKeys([0, 1, 2, 'item1', 'item2', 'not in collection', 3]));
    }
    
    public function testThatContainsItemsWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        $item4 = ['name'=>'Joe', 'age'=>'10',];
        $item5 = ['name'=>'Jane', 'age'=>'20',];
        
        $collection = 
            new \BaseCollectionTestImplementation($item1, $item2, $item3);
        
        $collection->item1 = $item4;
        $collection->item2 = $item5;
        
        $this->assertTrue($collection->containsItems([$item1]));
        $this->assertTrue($collection->containsItems([$item1, $item2]));
        $this->assertTrue($collection->containsItems([$item1, $item2, $item3]));
        $this->assertTrue($collection->containsItems([$item1, $item2, $item3, $item4]));
        $this->assertTrue($collection->containsItems([$item1, $item2, $item3, $item4, $item5]));
        $this->assertFalse($collection->containsItems(['not in collection']));
        $this->assertFalse($collection->containsItems([$item1, $item2, $item3, $item4, $item5, 'not in collection']));
        
        $collection[] = 55;
        $this->assertTrue($collection->containsItems([$item1, $item2, $item3, $item4, $item5, 55]));
        $this->assertFalse($collection->containsItems([$item1, $item2, $item3, $item4, $item5, 'not in collection', 55]));
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
    
    public function testThatValidateMethodNameWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        $this->assertTrue(
            $collection->validateMethodNamePublic('newMethod', __FUNCTION__)
        );
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatValidateMethodNameWorksAsExpected2() {
        
        $collection = new \BaseCollectionTestImplementation();
                
        // This should trigger an Exception because we are
        // passing a non-string (in this case an array)
        // as the method name
        $collection->validateMethodNamePublic([], __FUNCTION__);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatValidateMethodNameWorksAsExpected3() {
        
        $collection = new \BaseCollectionTestImplementation();
                
        // This should trigger an Exception because we are
        // passing a string that is not valid for a method
        // name according to php syntax rules as the method
        // name.
        $collection->validateMethodNamePublic('!badMethodName', __FUNCTION__);
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\AddConflictingMethodException
     */
    public function testThatValidateMethodNameWorksAsExpected4() {
        
        $collection = new \BaseCollectionTestImplementation();
                
        // This should trigger an Exception because we are
        // trying to validate the name of an instance method 
        // that exists in the collection class.
        $collection->validateMethodNamePublic('each', __FUNCTION__);
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\AddConflictingMethodException
     */
    public function testThatValidateMethodNameWorksAsExpected5() {
        
        $collection = new \BaseCollectionTestImplementation();
                
        // This should trigger an Exception because we are
        // trying to validate the name of a static method 
        // that exists in the collection class.
        $collection->validateMethodNamePublic('makeNewCollection', __FUNCTION__);
    }
    
    public function testThatAddStaticMethodWorksAsExpected() {
        
        //$collection = new \BaseCollectionTestImplementation();
                
        $method_name = 'newMethod';
        $method = function(){ return 'blah'; };
        $has_return_val = true;
        
        \BaseCollectionTestImplementation::addStaticMethod(
            $method_name, $method, $has_return_val
        );
        
        $array_of_static_methods = 
            \BaseCollectionTestImplementation::getArrayOfStaticMethods();
        
        $expected_key_for_new_method = 
            \BaseCollectionTestImplementation::class . '::' . $method_name;
        
        $this->assertArrayHasKey(
            $expected_key_for_new_method, 
            $array_of_static_methods
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['method'], 
            $method
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['has_return_val'], 
            $has_return_val
        );
    }
    
    public function testThatAddMethodForAllInstancesWorksAsExpected() {
        
        //$collection = new \BaseCollectionTestImplementation();
                
        $method_name = 'newMethod';
        $method = function(){ return 'blah'; };
        $has_return_val = true;
        $bind_to_this_on_invocation=true;
        
        \BaseCollectionTestImplementation::addMethodForAllInstances(
            $method_name, $method, $has_return_val, $bind_to_this_on_invocation
        );
        
        $array_of_static_methods = 
            \BaseCollectionTestImplementation::getArrayOfMethodsForAllInstances();
        
        $expected_key_for_new_method = 
            \BaseCollectionTestImplementation::class . '::' . $method_name;
        
        $this->assertArrayHasKey(
            $expected_key_for_new_method, 
            $array_of_static_methods
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['method'], 
            $method
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['has_return_val'], 
            $has_return_val
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['bind_to_this_on_invocation'], 
            $bind_to_this_on_invocation
        );
    }
    
    public function testThatAddMethodWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
                
        $method_name = 'numElements';
        $method = function(){ return $this->count(); };
        $has_return_val = true;
        $bind_to_this=true;
        
        $collection->addMethod(
            $method_name, $method, $has_return_val, $bind_to_this
        );
        
        $array_of_static_methods = 
            $collection->getArrayOfMethodsForThisInstance();
        
        $expected_key_for_new_method = 
            \BaseCollectionTestImplementation::class . '::' . $method_name;
        
        $this->assertArrayHasKey(
            $expected_key_for_new_method, 
            $array_of_static_methods
        );
        
        $this->assertEquals(
            $array_of_static_methods[$expected_key_for_new_method]['method'], 
            \Closure::bind($method, $collection)
        );
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['has_return_val'], 
            $has_return_val
        );
        
        // add two elemets
        $collection[] = 'one';
        $collection[] = 'two';
        
        // test that the 
        $this->assertEquals(
            $collection->$method_name(), 
            2
        );
        
        // without binding to this
        $collection->addMethod(
            $method_name, $method, $has_return_val, false
        );
        
        $array_of_static_methods = 
            $collection->getArrayOfMethodsForThisInstance();
        
        $this->assertSame(
            $array_of_static_methods[$expected_key_for_new_method]['method'], 
            $method
        );
    }
    
    public function testThatNthWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
        );
                
        $every_4th_starting_at_0 = $collection->nth(4);
        $this->assertEquals(
            $every_4th_starting_at_0->toArray(), ['a',  'e']
        );
        
        $every_4th_starting_at_3 = $collection->nth(4, 3);
        $this->assertEquals(
            $every_4th_starting_at_3->toArray(), ['d',  'h']
        );
        
        $empty_collection = new \BaseCollectionTestImplementation();
        $this->assertSame($empty_collection->nth(4)->count(), 0);
    }
    
    public function testThatPipeAndReturnCallbackResultWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
        );
        
        $counter = function($collection) { return $collection->count(); };
        $to_array = function($collection) { return $collection->toArray(); };
        
        $this->assertSame($collection->pipeAndReturnCallbackResult($counter), 8);
        $this->assertSame(
            $collection->pipeAndReturnCallbackResult($to_array), 
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']
        );
    }
    
    public function testThatPipeAndReturnSelfWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
        );
        
        $add_items = function($collection) { 
            $collection['y'] = 'i'; $collection['z'] = 'j'; 
        };
        
        // test that $this is returned
        $this->assertSame($collection->pipeAndReturnSelf($add_items), $collection);
        
        // test that callback was invoked on collection
        $this->assertTrue($collection->containsKeys(['y', 'z']));
        $this->assertTrue($collection->containsItems(['i', 'j']));
    }
    
    public function testThatGetAndRemoveLastItemWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd'
        );
        
        $this->assertSame( $collection->getAndRemoveLastItem(), 'd');
        $this->assertSame( $collection->getAndRemoveLastItem(), 'c');
        $this->assertSame( $collection->getAndRemoveLastItem(), 'b');
        $this->assertSame( $collection->getAndRemoveLastItem(), 'a');
        $this->assertSame( $collection->getAndRemoveLastItem(), NULL);
    }
    
    public function testThatGetAndRemoveFirstItemWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd'
        );
        
        $this->assertSame( $collection->getAndRemoveFirstItem(), 'a');
        $this->assertSame( $collection->getAndRemoveFirstItem(), 'b');
        $this->assertSame( $collection->getAndRemoveFirstItem(), 'c');
        $this->assertSame( $collection->getAndRemoveFirstItem(), 'd');
        $this->assertSame( $collection->getAndRemoveFirstItem(), NULL);
    }
    
    public function testThatPullWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection['item1'] = 22;
        $collection['item2'] = 23;
        $collection['item3'] = 24;
        $collection['item4'] = 25;
        
        $this->assertSame( $collection->pull('item1'), 22);
        $this->assertFalse( $collection->containsKey('item1'));
        
        $this->assertSame( $collection->pull('item2'), 23);
        $this->assertFalse( $collection->containsKey('item2'));
        
        $this->assertSame( $collection->pull('item3'), 24);
        $this->assertFalse( $collection->containsKey('item3'));
        
        $this->assertSame( $collection->pull('item4'), 25);
        $this->assertFalse( $collection->containsKey('item4'));
        
        $this->assertSame( $collection->pull('key_4_non_existent_item', -999), -999);
    }
    
    public function testThatPutWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        $this->assertSame( $collection->put('item1', 12), $collection);
        $this->assertSame( $collection->offsetGet('item1'), 12);
        
        $this->assertSame( $collection->put('item2', 13), $collection);
        $this->assertSame( $collection->offsetGet('item2'), 13);
        
        $this->assertSame( $collection->put('item3', 14), $collection);
        $this->assertSame( $collection->offsetGet('item3'), 14);
        
        $this->assertSame( $collection->put('item4',15), $collection);
        $this->assertSame( $collection->offsetGet('item4'), 15);
        
        $collection['item1'] = 22;
        $collection['item2'] = 23;
        $collection['item3'] = 24;
        $collection['item4'] = 25;
        
        $this->assertSame( $collection->put('item1', 32), $collection);
        $this->assertSame( $collection->offsetGet('item1'), 32);
        
        $this->assertSame( $collection->put('item2', 33), $collection);
        $this->assertSame( $collection->offsetGet('item2'), 33);
        
        $this->assertSame( $collection->put('item3', 34), $collection);
        $this->assertSame( $collection->offsetGet('item3'), 34);
        
        $this->assertSame( $collection->put('item4',35), $collection);
        $this->assertSame( $collection->offsetGet('item4'), 35);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomKeyWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        $random_key1 = $collection->randomKey();
        $random_key2 = $collection->randomKey();
        $random_key3 = $collection->randomKey();
        $random_key4 = $collection->randomKey();
        $random_key5 = $collection->randomKey();
        $random_key6 = $collection->randomKey();
        $random_key7 = $collection->randomKey();
        
        $this->assertTrue( $collection->containsKey($random_key1) );
        $this->assertTrue( $collection->containsKey($random_key2) );
        $this->assertTrue( $collection->containsKey($random_key3) );
        $this->assertTrue( $collection->containsKey($random_key4) );
        $this->assertTrue( $collection->containsKey($random_key5) );
        $this->assertTrue( $collection->containsKey($random_key6) );
        $this->assertTrue( $collection->containsKey($random_key7) );
        
        $all_random_keys_equal =
            $random_key1 === $random_key2
            && $random_key1 === $random_key3
            && $random_key1 === $random_key4
            && $random_key1 === $random_key5
            && $random_key1 === $random_key6
            && $random_key1 === $random_key7;
        
        $this->assertFalse($all_random_keys_equal);

        // Should throw a \LengthException. 
        // Can't get a random key from an empty collection.
        \BaseCollectionTestImplementation::makeNewCollection()->randomKey();
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomKeysWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        // default 1 key
        $this->assertTrue( $collection->randomKeys()->count() === 1 );
        
        $random_keys1 = $collection->randomKeys(4);
        $random_keys2 = $collection->randomKeys(4);
        $random_keys3 = $collection->randomKeys(4);
        $random_keys4 = $collection->randomKeys(6);
        
        $this->assertTrue( $random_keys1 instanceof \VersatileCollections\GenericCollection );
        $this->assertTrue( $random_keys2 instanceof \VersatileCollections\GenericCollection );
        $this->assertTrue( $random_keys3 instanceof \VersatileCollections\GenericCollection );
        $this->assertTrue( $random_keys4 instanceof \VersatileCollections\GenericCollection );
        
        $this->assertTrue( $random_keys1->count() === 4 );
        $this->assertTrue( $random_keys2->count() === 4 );
        $this->assertTrue( $random_keys3->count() === 4 );
        $this->assertTrue( $random_keys4->count() === 6 );
        
        $this->assertTrue( $collection->containsKeys($random_keys1->toArray()) );
        $this->assertTrue( $collection->containsKeys($random_keys2->toArray()) );
        $this->assertTrue( $collection->containsKeys($random_keys3->toArray()) );
        $this->assertTrue( $collection->containsKeys($random_keys4->toArray()) );
        
        $all_random_keys_collections_of_same_length_are_equal =
            $random_keys1->toArray() === $random_keys2->toArray()
            && $random_keys1->toArray() === $random_keys3->toArray();
        
        $this->assertFalse($all_random_keys_collections_of_same_length_are_equal);

        // Should throw a \LengthException. 
        // Can't get a random keys from an empty collection.
        \BaseCollectionTestImplementation::makeNewCollection()->randomKeys();
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatRandomKeysWorksAsExpected2() {
        
        \BaseCollectionTestImplementation::makeNewCollection([1, 2])
                                ->randomKeys("Invalid Length Data Type");
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatRandomKeysWorksAsExpected3() {
        
        // requesting more random keys than collection size
        \BaseCollectionTestImplementation::makeNewCollection([1, 2])->randomKeys(5);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomKeysWorksAsExpected4() {
        
        // requesting random keys from an empty collection
        \BaseCollectionTestImplementation::makeNewCollection()->randomKeys(5);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomItemWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        $random_item1 = $collection->randomItem();
        $random_item2 = $collection->randomItem();
        $random_item3 = $collection->randomItem();
        $random_item4 = $collection->randomItem();
        $random_item5 = $collection->randomItem();
        $random_item6 = $collection->randomItem();
        $random_item7 = $collection->randomItem();
        
        $this->assertTrue( $collection->containsItem($random_item1) );
        $this->assertTrue( $collection->containsItem($random_item2) );
        $this->assertTrue( $collection->containsItem($random_item3) );
        $this->assertTrue( $collection->containsItem($random_item4) );
        $this->assertTrue( $collection->containsItem($random_item5) );
        $this->assertTrue( $collection->containsItem($random_item6) );
        $this->assertTrue( $collection->containsItem($random_item7) );
        
        $all_random_items_equal =
            $random_item1 === $random_item2
            && $random_item1 === $random_item3
            && $random_item1 === $random_item4
            && $random_item1 === $random_item5
            && $random_item1 === $random_item6
            && $random_item1 === $random_item7;
        
        $this->assertFalse($all_random_items_equal);

        // Should throw a \LengthException. 
        // Can't get a random item from an empty collection.
        \BaseCollectionTestImplementation::makeNewCollection()->randomItem();
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomItemsWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        $collection2 = \BaseCollectionTestImplementation::makeNewCollection(
            [ 
                'a'=>'blue', 'b'=>'red', 'c'=>'green', 
                'd'=>'red', 'e'=>1, 'f'=>'blue', 'g'=>'2' 
            ]
        );

        // default 1 key
        $this->assertTrue( $collection->randomItems()->count() === 1 );
        
        $random_items1 = $collection->randomItems(4);
        $random_items2 = $collection->randomItems(4);
        $random_items3 = $collection->randomItems(4);
        $random_items4 = $collection2->randomItems(6, true);
        
        $this->assertTrue( $random_items1 instanceof \BaseCollectionTestImplementation );
        $this->assertTrue( $random_items2 instanceof \BaseCollectionTestImplementation );
        $this->assertTrue( $random_items3 instanceof \BaseCollectionTestImplementation );
        $this->assertTrue( $random_items4 instanceof \BaseCollectionTestImplementation );
        
        $this->assertTrue( $random_items1->count() === 4 );
        $this->assertTrue( $random_items2->count() === 4 );
        $this->assertTrue( $random_items3->count() === 4 );
        $this->assertTrue( $random_items4->count() === 6 );
        
        $this->assertTrue( $collection->containsItems($random_items1->toArray()) );
        $this->assertTrue( $collection->containsItems($random_items2->toArray()) );
        $this->assertTrue( $collection->containsItems($random_items3->toArray()) );
        $this->assertTrue( $collection->containsItems($random_items4->toArray()) );
        
        $all_random_items_collections_of_same_length_are_equal =
            $random_items1->toArray() === $random_items2->toArray()
            && $random_items1->toArray() === $random_items3->toArray();
        
        $this->assertFalse($all_random_items_collections_of_same_length_are_equal);

        // test preserve keys
        foreach ( $random_items4 as $key => $random_item ) {
            
            $this->assertTrue($collection2->containsKey($key));
            $this->assertTrue($collection2[$key] === $random_item);
        }
        
        // Should throw a \LengthException. 
        // Can't get a random key from an empty collection.
        \BaseCollectionTestImplementation::makeNewCollection()->randomItems();
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatRandomItemsWorksAsExpected2() {
        
        \BaseCollectionTestImplementation::makeNewCollection([1, 2])
                                ->randomItems("Invalid Length Data Type");
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatRandomItemsWorksAsExpected3() {
        
        // requesting more random keys than collection size
        \BaseCollectionTestImplementation::makeNewCollection([1, 2])->randomItems(5);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThatRandomItemsWorksAsExpected4() {
        
        // requesting random keys from an empty collection
        \BaseCollectionTestImplementation::makeNewCollection()->randomItems(5);
    }
    
    public function testThatSearchByValWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        // non-strict searches
        $this->assertSame( $collection->searchByVal('blue'), 0); // found at $collection[0]
        $this->assertSame( $collection->searchByVal('non existent item'), false); // not found
        
        // strict searches
        $this->assertSame( $collection->searchByVal(1, true), 4); // found at $collection[4]
        $this->assertSame( $collection->searchByVal('1', true), false); // not found
        
        $this->assertSame( $collection->searchByVal('2', true), 6); // found at $collection[6]
        $this->assertSame( $collection->searchByVal(2, true), false); // not found
    }
    
    public function testThatSearchAllByValWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2', 1
        );
        
        // non-strict searches
        // found at $collection[0] & $collection[5]
        $this->assertSame( $collection->searchAllByVal('blue'), [0, 5]);
        $this->assertSame( $collection->searchAllByVal('non existent item'), false); // not found
        
        // strict searches
        // found at $collection[4] & $collection[7]
        $this->assertSame( $collection->searchAllByVal(1, true), [4, 7]);
        $this->assertSame( $collection->searchAllByVal('1', true), false); // not found
        
        $this->assertSame( $collection->searchAllByVal('2', true), [6]); // found at $collection[6]
        $this->assertSame( $collection->searchAllByVal(2, true), false); // not found
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testThatSearchByCallbackWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2', 1
        );
        
        // Added  && $this->count() > 0
        // check to make sure that $this is
        // available by default in the callbacks
        
        $object_searcher = function($key, $item) {
          
            return is_object($item) && $this->count() > 0;
        };
        
        $int_searcher = function($key, $item) {
          
            return is_int($item) && $this->count() > 0;
        };
        
        $string_searcher = function($key, $item) {
          
            return is_string($item) && $this->count() > 0;
        };
        
        // found at $collection[4] & $collection[7]
        $this->assertSame( $collection->searchByCallback($int_searcher), [4, 7]);
        $this->assertSame( $collection->searchByCallback($object_searcher), false); // not found
        
        // found at $collection[0], $collection[1], $collection[2], $collection[3]
        // $collection[5] & $collection[6] 
        $this->assertSame( $collection->searchByCallback($string_searcher), [0, 1, 2, 3, 5, 6]);
        
        // test $this does not exist when specified not to
        $throw_exception_if_this_is_not_set = function($key, $item) use ($collection) {
          
            if( $this !== $collection ) {
                
                throw new \RuntimeException('blah');
            }
            
            return true;
        };
        
        // exception will be thrown
        $collection->searchByCallback($throw_exception_if_this_is_not_set, false); 
    }
    
    public function testThatShuffleWorksAsExpected4() {
        
        $empty_collection = 
            \BaseCollectionTestImplementation::makeNewCollection();
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            [ 
                'a'=>'blue', 'b'=>'red', 'c'=>'green', 
                'd'=>'red', 'e'=>1, 'f'=>'blue', 'g'=>'2' 
            ]
        );
        
        $this->assertTrue($empty_collection->shuffle()->isEmpty());
        
        // shuffle ($collection->count() * 2) times and assert
        // each shuffle is different from original collection
        // but with the same size.
        for ($i = 0 ; $i < ($collection->count() * 2); $i++ ) {
            
            $shuffled_collection = $collection->shuffle();
            
            // both collections are of the same length
            $this->assertTrue(
                $collection->count() === $shuffled_collection->count()
            );
            
            // keys are not in same order
            $this->assertTrue(
                $collection->getKeys() !== $shuffled_collection->getKeys()
            );
            
            // same keys exist in both collection
            $this->assertTrue(
                $collection->containsKeys($shuffled_collection->getKeys())
            );
        }
        
        // test not preserving keys
        $shuffled_collection = $collection->shuffle(false);
        
        // both collections are of the same length
        $this->assertTrue(
            $collection->count() === $shuffled_collection->count()
        );

        // same keys do not exist in both collection
        $this->assertFalse(
            $collection->containsKeys($shuffled_collection->getKeys())
        );
    }
    
    public function testThatSortWorksAsExpected() {
        
        $sorted_collection = (new \BaseCollectionTestImplementation(5, 3, 1, 2, 4))->sort();
        $this->assertEquals( [1, 2, 3, 4, 5], array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation(-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4))->sort();
        $this->assertEquals( [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5], array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation('foo', 'bar-10', 'bar-1'))->sort();
        $this->assertEquals( ['bar-1', 'bar-10', 'foo'], array_values($sorted_collection->toArray()) );

        $sorted_collection = 
            (new \BaseCollectionTestImplementation("orange2", "Orange3", "Orange1", "orange20"))
                ->sort(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
        $this->assertEquals( ["Orange1", "orange2", "Orange3", "orange20"], array_values($sorted_collection->toArray()) );
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        $sorted_collection = $collection->sort();
        $this->assertEquals( 
            [ $collection[2], $collection[3], $collection[0], $collection[1] ], 
            array_values($sorted_collection->toArray()) 
        );
        
        $age_sorter = function(\TestValueObject $a, \TestValueObject $b) {
            
            return $a->getAge() < $b->getAge() 
                   ? -1 
                   : 
                   (
                        ($a->getAge() == $b->getAge())
                        ? 0 
                        : 1 
                   ); 
        };
        $sorted_collection = $collection->sort($age_sorter);
        $this->assertEquals( 
            [ $collection[1], $collection[2], $collection[0], $collection[3] ], 
            array_values($sorted_collection->toArray()) 
        );
    }
    
    public function testThatSortDescWorksAsExpected() {
        
        $sorted_collection = (new \BaseCollectionTestImplementation(5, 3, 1, 2, 4))->sortDesc();
        $this->assertEquals( array_reverse([1, 2, 3, 4, 5]), array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation(-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4))->sortDesc();
        $this->assertEquals( array_reverse([-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5]), array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation('foo', 'bar-10', 'bar-1'))->sortDesc();
        $this->assertEquals( array_reverse(['bar-1', 'bar-10', 'foo']), array_values($sorted_collection->toArray()) );

        $sorted_collection = 
            (new \BaseCollectionTestImplementation("orange2", "Orange3", "Orange1", "orange20"))
                ->sortDesc(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
        $this->assertEquals( 
            array_reverse(["Orange1", "orange2", "Orange3", "orange20"]), 
            array_values($sorted_collection->toArray()) 
        );
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        $sorted_collection = $collection->sortDesc();
        $this->assertEquals( 
            array_reverse([ $collection[2], $collection[3], $collection[0], $collection[1] ]), 
            array_values($sorted_collection->toArray()) 
        );
        
        $age_sorter = function(\TestValueObject $a, \TestValueObject $b) {
            
            return $a->getAge() < $b->getAge() 
                   ? 1 
                   : 
                   (
                        ($a->getAge() == $b->getAge())
                        ? 0 
                        : -1 
                   ); 
        };
        $sorted_collection = $collection->sortDesc($age_sorter);
        $this->assertEquals( 
            array_reverse([ $collection[1], $collection[2], $collection[0], $collection[3] ]), 
            array_values($sorted_collection->toArray()) 
        );
    }
    
    public function testThatSortByKeyWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortByKey();
        $this->assertEquals( [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ], $sorted_collection->toArray() );
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortByKey();
        $this->assertEquals( [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ], $sorted_collection->toArray() );
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            [ 3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortByKey(null, new \VersatileCollections\SortType(SORT_STRING));
        $this->assertEquals( 
            [
                0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
            ], 
            $sorted_collection->toArray() 
        );
        
        $string_sorter = function($a, $b) {
            
            return $a.'' < $b.''
                   ? -1 
                   : 
                   (
                        ($a.'' == $b.'')
                        ? 0 
                        : 1 
                   ); 
        };
        $sorted_collection = $collection->sortByKey($string_sorter);
        $this->assertEquals( 
            [
                0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
            ], 
            $sorted_collection->toArray() 
        );
    }
    
    public function testThatSortDescByKeyWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortDescByKey();
        $this->assertEquals( 
            [ "d"=>"lemon", "c"=>"apple", "b"=>"banana", "a"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortDescByKey();
        $this->assertEquals( 
            [ "3"=>"lemon", "2"=>"apple", "1"=>"banana", "0"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            [ 
                3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", 
                "a"=>"orange", "b"=>"banana", "c"=>"apple"
            ]
        );
        $sorted_collection = $collection->sortDescByKey(null, new \VersatileCollections\SortType(SORT_STRING));
        $this->assertEquals(
            array_reverse(
                [
                    0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                    'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
                ],
                true
            ), 
            $sorted_collection->toArray() 
        );
        
        $string_sorter = function($a, $b) {
            
            return $a.'' < $b.''
                   ? 1 
                   : 
                   (
                        ($a.'' == $b.'')
                        ? 0 
                        : -1 
                   ); 
        };
        $sorted_collection = $collection->sortDescByKey($string_sorter);
        $this->assertEquals( 
            array_reverse(
                [
                    0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                    'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
                ],
                true
            ), 
            $sorted_collection->toArray() 
        );
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testThatSortByMultipleFieldsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
        $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
        $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ],
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ]
            ], 
            $sorted_collection_asc_desc->toArray()
        );
        
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ],
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ]
            ], 
            $sorted_collection_asc_asc->toArray()
        );
        
        $collection_of_wrong_types = new \VersatileCollections\GenericCollection(...[1,2,3]);
        
        // Can't multi sort collection of non-arrays or ArrayAccess objects
        $collection_of_wrong_types->sortByMultipleFields($sort_param);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatSortByMultipleFieldsWithNoArgsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        // Exception should be thrown if no sort param supplied
        $collection->sortByMultipleFields();
    }
    
    public function testThatSortMeWorksAsExpected() {
        
        $sorted_collection = (new \BaseCollectionTestImplementation(5, 3, 1, 2, 4))->sortMe();
        $this->assertEquals( [1, 2, 3, 4, 5], array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation(-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4))->sortMe();
        $this->assertEquals( [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5], array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation('foo', 'bar-10', 'bar-1'))->sortMe();
        $this->assertEquals( ['bar-1', 'bar-10', 'foo'], array_values($sorted_collection->toArray()) );

        $sorted_collection = 
            (new \BaseCollectionTestImplementation("orange2", "Orange3", "Orange1", "orange20"))
                ->sortMe(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
        $this->assertEquals( ["Orange1", "orange2", "Orange3", "orange20"], array_values($sorted_collection->toArray()) );
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        $sorted_collection = $collection->sortMe();
        $this->assertEquals( 
            [ $collection[2], $collection[3], $collection[0], $collection[1] ], 
            array_values($sorted_collection->toArray()) 
        );
        
        $age_sorter = function(\TestValueObject $a, \TestValueObject $b) {
            
            return $a->getAge() < $b->getAge() 
                   ? -1 
                   : 
                   (
                        ($a->getAge() == $b->getAge())
                        ? 0 
                        : 1 
                   ); 
        };
        $sorted_collection = $collection->sortMe($age_sorter);
        $this->assertEquals( 
            [ $collection[1], $collection[2], $collection[0], $collection[3] ], 
            array_values($sorted_collection->toArray()) 
        );
        
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
    }
    
    public function testThatSortMeDescWorksAsExpected() {
        
        $sorted_collection = (new \BaseCollectionTestImplementation(5, 3, 1, 2, 4))->sortMeDesc();
        $this->assertEquals( array_reverse([1, 2, 3, 4, 5]), array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation(-1, -3, -2, -4, -5, 0, 5, 3, 1, 2, 4))->sortMeDesc();
        $this->assertEquals( array_reverse([-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5]), array_values($sorted_collection->toArray()) );

        $sorted_collection = (new \BaseCollectionTestImplementation('foo', 'bar-10', 'bar-1'))->sortMeDesc();
        $this->assertEquals( array_reverse(['bar-1', 'bar-10', 'foo']), array_values($sorted_collection->toArray()) );

        $sorted_collection = 
            (new \BaseCollectionTestImplementation("orange2", "Orange3", "Orange1", "orange20"))
                ->sortMeDesc(null, new \VersatileCollections\SortType((SORT_NATURAL | SORT_FLAG_CASE)));
        $this->assertEquals( 
            array_reverse(["Orange1", "orange2", "Orange3", "orange20"]), 
            array_values($sorted_collection->toArray()) 
        );
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        $sorted_collection = $collection->sortMeDesc();
        $this->assertEquals( 
            array_reverse([ $collection[2], $collection[3], $collection[0], $collection[1] ]), 
            array_values($sorted_collection->toArray()) 
        );
        
        $age_sorter = function(\TestValueObject $a, \TestValueObject $b) {
            
            return $a->getAge() < $b->getAge() 
                   ? 1 
                   : 
                   (
                        ($a->getAge() == $b->getAge())
                        ? 0 
                        : -1 
                   ); 
        };
        $sorted_collection = $collection->sortMeDesc($age_sorter);
        $this->assertEquals( 
            array_reverse([ $collection[1], $collection[2], $collection[0], $collection[3] ]), 
            array_values($sorted_collection->toArray()) 
        );
        
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
    }
    
    public function testThatSortMeByKeyWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortMeByKey();
        $this->assertEquals( [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ], $sorted_collection->toArray() );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortMeByKey();
        $this->assertEquals( [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ], $sorted_collection->toArray() );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            [ 3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortMeByKey(null, new \VersatileCollections\SortType(SORT_STRING));
        $this->assertEquals( 
            [
                0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
            ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $string_sorter = function($a, $b) {
            
            return $a.'' < $b.''
                   ? -1 
                   : 
                   (
                        ($a.'' == $b.'')
                        ? 0 
                        : 1 
                   ); 
        };
        $sorted_collection = $collection->sortMeByKey($string_sorter);
        $this->assertEquals( 
            [
                0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
            ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
    }
    
    public function testThatSortMeDescByKeyWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortMeDescByKey();
        $this->assertEquals( 
            [ "d"=>"lemon", "c"=>"apple", "b"=>"banana", "a"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortMeDescByKey();
        $this->assertEquals( 
            [ "3"=>"lemon", "2"=>"apple", "1"=>"banana", "0"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNewCollection(
            [ 
                3=>"lemon", 0=>"orange", 1=>"banana", 2=>"apple", "d"=>"lemon", 
                "a"=>"orange", "b"=>"banana", "c"=>"apple"
            ]
        );
        $sorted_collection = $collection->sortMeDescByKey(null, new \VersatileCollections\SortType(SORT_STRING));
        $this->assertEquals(
            array_reverse(
                [
                    0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                    'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
                ],
                true
            ), 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $string_sorter = function($a, $b) {
            
            return $a.'' < $b.''
                   ? 1 
                   : 
                   (
                        ($a.'' == $b.'')
                        ? 0 
                        : -1 
                   ); 
        };
        $sorted_collection = $collection->sortMeDescByKey($string_sorter);
        $this->assertEquals( 
            array_reverse(
                [
                    0 => 'orange', 1 => 'banana', 2 => 'apple', 3 => 'lemon',
                    'a' => 'orange', 'b' => 'banana', 'c' => 'apple', 'd' => 'lemon'
                ],
                true
            ), 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testThatSortMeByMultipleFieldsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
        $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
        $sorted_collection_asc_desc = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ],
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ]
            ], 
            $sorted_collection_asc_desc->toArray()
        );
        $this->assertTrue($sorted_collection_asc_desc === $collection);
        
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_asc_asc = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ],
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ]
            ], 
            $sorted_collection_asc_asc->toArray()
        );
        $this->assertTrue($sorted_collection_asc_asc === $collection);
        
        $sort_param->setSortDirection(SORT_DESC);
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_desc_asc = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ],
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
            ], 
            $sorted_collection_desc_asc->toArray()
        );
        $this->assertTrue($sorted_collection_desc_asc === $collection);
        
        $sort_param->setSortDirection(SORT_DESC);
        $sort_param2->setSortDirection(SORT_DESC);
        $sorted_collection_desc_desc = $collection->sortMeByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                1 => [
                    'volume' => 86,
                    'edition' => 2
                ],
                3 => [
                    'volume' => 86,
                    'edition' => 1
                ],
                2 => [
                    'volume' => 85,
                    'edition' => 6
                ],
                0 => [
                    'volume' => 67,
                    'edition' => 2
                ],
            ], 
            $sorted_collection_desc_desc->toArray()
        );
        $this->assertTrue($sorted_collection_desc_desc === $collection);
        
        $collection_of_wrong_types = new \VersatileCollections\GenericCollection(...[1,2,3]);
        
        // Can't multi sort collection of non-arrays or ArrayAccess objects
        $collection_of_wrong_types->sortMeByMultipleFields($sort_param);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatSortMeByMultipleFieldsWithNoArgsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        // Exception should be thrown if no sort param supplied
        $collection->sortMeByMultipleFields();
    }
    
    public function testThatSplitWorksAsExpected() {

        $data = [ 1, 2, 3, 4, 5, 6, 7 ];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertTrue(\VersatileCollections\GenericCollection::makeNewCollection()->split(0)->isEmpty());
        $this->assertTrue($collection->split(0)->isEmpty());
 
        ///////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $_1_group_with_7_items = $collection->split(1);
        $this->assertTrue($_1_group_with_7_items->count() === 1);
        $this->assertTrue($_1_group_with_7_items->firstItem()->count() === 7);
        $this->assertSame(
            $_1_group_with_7_items->getAndRemoveFirstItem()->toArray(),
            [ 1, 2, 3, 4, 5, 6, 7 ]
        );
        
        ///////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $_7_groups_with_1_item_each = $collection->split(7);
        $this->assertTrue($_7_groups_with_1_item_each->count() === 7);
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 0=>1 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 1=>2 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 2=>3 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 3=>4 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 4=>5 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 5=>6 ]
        );
        
        $this->assertTrue($_7_groups_with_1_item_each->firstItem()->count() === 1);
        $this->assertSame(
            $_7_groups_with_1_item_each->getAndRemoveFirstItem()->toArray(),
            [ 6=>7 ]
        );
        
        ///////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $_4_groups_with_at_most_2_items_each = $collection->split(4);
        $this->assertTrue($_4_groups_with_at_most_2_items_each->count() === 4);
        
        $this->assertTrue($_4_groups_with_at_most_2_items_each->firstItem()->count() === 2);
        $this->assertSame(
            $_4_groups_with_at_most_2_items_each->getAndRemoveFirstItem()->toArray(),
            [ 0=>1, 1=>2 ]
        );
        
        $this->assertTrue($_4_groups_with_at_most_2_items_each->firstItem()->count() === 2);
        $this->assertSame(
            $_4_groups_with_at_most_2_items_each->getAndRemoveFirstItem()->toArray(),
            [ 2=>3, 3=>4 ]
        );
        
        $this->assertTrue($_4_groups_with_at_most_2_items_each->firstItem()->count() === 2);
        $this->assertSame(
            $_4_groups_with_at_most_2_items_each->getAndRemoveFirstItem()->toArray(),
            [ 4=>5, 5=>6 ]
        );
        
        $this->assertTrue($_4_groups_with_at_most_2_items_each->firstItem()->count() === 1);
        $this->assertSame(
            $_4_groups_with_at_most_2_items_each->getAndRemoveFirstItem()->toArray(),
            [ 6=>7 ]
        );
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatSplitWithNonIntNumberOfGroupsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        // Exception should be thrown
        $collection->split('Invalid Data Type for Number of Groups');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatSplitWithNumberOfGroupsLargerThanCollectionSizeWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        // Exception should be thrown
        $collection->split(7);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatSplitWithNumberOfGroupsLessThanZeroWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        // Exception should be thrown
        $collection->split(-7);
    }
    
    public function testThatUniqueWorksAsExpected() {
        
        $object = new ArrayObject();
        $object2 = new ArrayObject();
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = "4";
        $collection->item2 = 5.0;
        $collection->item3 = 7;
        $collection->item4 = true;
        $collection->item5 = false;
        $collection->item12 = "4";
        $collection->item22 = 5.0;
        $collection->item32 = 7;
        $collection->item42 = true;
        $collection->item52 = false;
        $collection->item123 = 4;
        $collection->item223 = '5.0';
        $collection->item323 = '7';
        $collection->item423 = 'true';
        $collection->item523 = 'false';
        $collection->item623 = $object;
        $collection->item723 = $object2;
        $collection->item823 = $object;
        $collection->item923 = $object2;
        
        $this->assertSame(\BaseCollectionTestImplementation::makeNewCollection()->unique()->toArray(), []);
        $this->assertEquals($collection->unique()->toArray(), ['4', 5.0, 7, true, false, 4, '5.0', '7','true', 'false', $object, $object2]);
    }
    
    /**
     * @expectedException \BadMethodCallException
     */
    public function testThat__CallWorksAsExpected() {
        
        // add to parent class
        \VersatileCollections\BaseCollection::addMethodForAllInstances(
            'toUpper', 
            function() {
            
                $upperred_items = [];
            
                foreach($this as $item) {
                    
                    $upperred_items[] = 
                        strtoupper($item).' via addMethodForAllInstances'
                        . \VersatileCollections\BaseCollection::class;
                }
                return $upperred_items;
            }, 
            true,
            true
        );
        
        $collection = new \BaseCollectionTestImplementation();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection[] = 'Johnny Cash';
        $collection[] = 'Suzzy Something';
        $collection[] = 'Jack Bauer';
        $collection[] = 'Jane Fonda';
        
        $this->assertEquals($collection->count(), 4);
        
        $upperred_items = $collection->toUpper();
        
        $this->assertContains('JOHNNY CASH via addMethodForAllInstances'. \VersatileCollections\BaseCollection::class, $upperred_items);
        $this->assertContains('SUZZY SOMETHING via addMethodForAllInstances'. \VersatileCollections\BaseCollection::class, $upperred_items);
        $this->assertContains('JACK BAUER via addMethodForAllInstances'. \VersatileCollections\BaseCollection::class, $upperred_items);
        $this->assertContains('JANE FONDA via addMethodForAllInstances'. \VersatileCollections\BaseCollection::class, $upperred_items);
        
        // add to specific class, which should override the one
        // added to the parent class
        \BaseCollectionTestImplementation::addMethodForAllInstances(
            'toUpper', 
            function() {
            
                $upperred_items = [];
            
                foreach($this as $item) {
                    
                    $upperred_items[] = 
                        strtoupper($item).' via addMethodForAllInstances'
                        . \BaseCollectionTestImplementation::class;
                }
                return $upperred_items;
            }, 
            true,
            true
        );
        
        $upperred_items = $collection->toUpper();
        
        $this->assertContains('JOHNNY CASH via addMethodForAllInstances'. \BaseCollectionTestImplementation::class, $upperred_items);
        $this->assertContains('SUZZY SOMETHING via addMethodForAllInstances'. \BaseCollectionTestImplementation::class, $upperred_items);
        $this->assertContains('JACK BAUER via addMethodForAllInstances'. \BaseCollectionTestImplementation::class, $upperred_items);
        $this->assertContains('JANE FONDA via addMethodForAllInstances'. \BaseCollectionTestImplementation::class, $upperred_items);
            
        $collection->addMethod(
            'toUpper', 
            function() {
            
                $upperred_items = [];
            
                foreach($this as $item) {
                    
                    $upperred_items[] = 
                        strtoupper($item).' via addMethod';
                }
                return $upperred_items;
            }, 
            true
        );
        
        $upperred_items = $collection->toUpper();
        
        $this->assertContains('JOHNNY CASH via addMethod', $upperred_items);
        $this->assertContains('SUZZY SOMETHING via addMethod', $upperred_items);
        $this->assertContains('JACK BAUER via addMethod', $upperred_items);
        $this->assertContains('JANE FONDA via addMethod', $upperred_items);
        
        $collection->nonExistentMethod();
    }
    
    /**
     * @expectedException \BadMethodCallException
     */
    public function testThat__CallStaticWorksAsExpected() {
        
        // add to parent class
        \VersatileCollections\BaseCollection::addStaticMethod(
            'toUpper', 
            function() {
            
                return 'toUpper via addStaticMethod'
                        . \VersatileCollections\BaseCollection::class;
            }, 
            true
        );
        
        $result = \BaseCollectionTestImplementation::toUpper();
        
        $this->assertEquals('toUpper via addStaticMethod'. \VersatileCollections\BaseCollection::class, $result);
        
        // add to specific class, which should override the one
        // added to the parent class
        \BaseCollectionTestImplementation::addStaticMethod(
            'toUpper', 
            function() {
            
                return 'toUpper via addStaticMethod'
                        . \BaseCollectionTestImplementation::class;
            }, 
            true
        );
        
        $result = \BaseCollectionTestImplementation::toUpper();
        
        $this->assertEquals('toUpper via addStaticMethod'. \BaseCollectionTestImplementation::class, $result);

        \BaseCollectionTestImplementation::nonExistentMethod();
    }
}
