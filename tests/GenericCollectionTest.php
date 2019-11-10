<?php
declare(strict_types=1);
use function VersatileCollections\dump_var;

class GenericCollectionTest extends \PHPUnit\Framework\TestCase {
    
    
    protected function setUp(): void { 
        
        parent::setUp();
    }
    
    public function testThatMakeNewWorksAsExpected() {
        
        $collection = \BaseCollectionTestImplementation::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\BaseCollectionTestImplementation::class, $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNew([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\BaseCollectionTestImplementation::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\CallablesCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\CallablesCollection::class, $collection);
        
        $collection = \VersatileCollections\CallablesCollection::makeNew(['strtolower', 'strtoupper', function(){ return 'boo'; }]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\CallablesCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\FloatsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\FloatsCollection::class, $collection);
        
        $collection = \VersatileCollections\FloatsCollection::makeNew([1.1, 2.2, 3.3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\FloatsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\GenericCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\GenericCollection::class, $collection);
        
        $collection = \VersatileCollections\GenericCollection::makeNew([1.1, 2.2, 3.3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\GenericCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\IntsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\IntsCollection::class, $collection);
        
        $collection = \VersatileCollections\IntsCollection::makeNew([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\IntsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\NumericsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\NumericsCollection::class, $collection);
        
        $collection = \VersatileCollections\NumericsCollection::makeNew([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\NumericsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ObjectsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ObjectsCollection::class, $collection);
        
        $collection = \VersatileCollections\ObjectsCollection::makeNew([new stdClass(), new ArrayObject(), new DateTime('2000-04-04')]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ObjectsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ResourcesCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ResourcesCollection::class, $collection);
        
        $collection = \VersatileCollections\ResourcesCollection::makeNew([tmpfile(), tmpfile(), tmpfile()]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ResourcesCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\ScalarsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\ScalarsCollection::class, $collection);
        
        $collection = \VersatileCollections\ScalarsCollection::makeNew([1, 2, 3]);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\ScalarsCollection::class, $collection);
        
        ///////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////
        $collection = \VersatileCollections\StringsCollection::makeNew();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertInstanceOf(\VersatileCollections\StringsCollection::class, $collection);
        
        $collection = \VersatileCollections\StringsCollection::makeNew(['1', '2', '3']);
        
        $this->assertEquals($collection->count(), 3);
        $this->assertInstanceOf(\VersatileCollections\StringsCollection::class, $collection);
        
        ////////////////////////////////////////////////////////////////////////
        // Test with array with string keys and preserve keys
        ////////////////////////////////////////////////////////////////////////
        $collection = \BaseCollectionTestImplementation::makeNew(['a'=>'taylor', 'b'=>'abigail', null]);
        
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
        $collection = \BaseCollectionTestImplementation::makeNew([5=>'taylor', 10=>'abigail', 9=>null], false);

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
        
        //var_dump($collection->getKeys()->toArray());
        $this->assertEquals($collection->count(), 3);
        $this->assertEquals($collection->getKeys()->toArray(), ['item1', 'item2', 'item3']);
    }
    
    public function testThatOffsetSetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection["item1"] = new stdClass();
        $collection["item2"] = new stdClass();
        $collection["item3"] = new stdClass();
        
        $this->assertEquals($collection->count(), 3);
        $this->assertEquals($collection->getKeys()->toArray(), ['item1', 'item2', 'item3']);
        
        // use the keyless syntax after keyed syntax
        $collection[] = new stdClass();
        $collection[] = new stdClass();
        $collection[] = new stdClass();
        
        //var_dump($collection->getKeys()->toArray());
        $this->assertEquals($collection->count(), 6);
        $this->assertEquals($collection->getKeys()->toArray(), ['item1', 'item2', 'item3', 0, 1, 2]);
        
        //keyless syntax starting with an empty collection
        $collection2 = new \BaseCollectionTestImplementation();
        $collection2[] = new stdClass();
        $collection2[] = new stdClass();
        $collection2[] = new stdClass();
        
        $this->assertEquals($collection2->count(), 3);
        $this->assertEquals($collection2->getKeys()->toArray(), [ 0, 1, 2]);
    }
    
    public function testThat__IssetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new stdClass();
        $collection->item2 = new stdClass();
        $collection->item3 = new stdClass();
        
        //var_dump($collection->getKeys()->toArray());
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
        
        //var_dump($collection->getKeys()->toArray());
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
        
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        // this should trigger an Exception
        $collection->__get('item5');
    }

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
        
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        // this should trigger an Exception
        $collection->offsetGet('item5');
    }
    
    public function testThatOffsetUnsetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        $collection->offsetUnset('item1');
        
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        // this should trigger an Exception
        $collection->item1;
    }

    public function testThat__UnsetWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        $collection->__unset('item1');
        
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        // this should trigger an Exception
        $collection->item1;
    }

    public function testThat__UnsetWorksAsExpected2() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        unset($collection['item1']);
        
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        
        // this should trigger an Exception
        $collection->item1;
    }

    public function testThat__UnsetWorksAsExpected3() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = 'One';
        $collection->item2 = 'Two';
        $collection->item3 = 'Three';
        
        unset($collection->item1);
        $this->expectException(\VersatileCollections\Exceptions\NonExistentItemException::class);
        
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
            true,
            true,
            true
        );
        
        $this->assertEquals(
            $collection_of_even_ints->toArray(), [1=>2, 3=>4, 5=>6, 7=>8, 9=>10]
        );
        
        // verify that filtered items were removed
        $this->assertEquals(
            $collection_of_ints->toArray(), [0=>1, 2=>3, 4=>5, 6=>7, 8=>9]
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
            false,
            true,
            true
        );
        
        $this->assertEquals(
            $collection_of_ints_except_first_and_last_items->toArray(), [2, 3, 4, 5, 6, 7, 8, 9]
        );
        
        // verify that filtered items were removed
        $this->assertEquals(
            $collection_of_ints->toArray(), [ 0=>1,  9=>10]
        );

        // no items matching filter strcmp, because it never returns true only 
        // integers >0, 0 or <0
        $this->assertEquals(
            $collection_of_ints->filterFirstN('strcmp', null, false, true, false)
                               ->count(), 
            0
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

        // Exception will not be thrown even though we are trying to
        // bind a non-closure callable to $this. The callable is converted
        // to a Closure under the hood, though binding it to $this has no
        // effect in this case.
        $this->assertEquals(
            $collection_of_ints->transform('strcmp', true)->count(), 4
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
        
        // Exception will not be thrown even though we are trying to
        // bind a non-closure callable to $this. The callable is converted
        // to a Closure under the hood, though binding it to $this has no
        // effect in this case.
        $this->assertSame(
            $numeric_collection,
            $numeric_collection->each('strcmp', false, true)
        );
        $this->assertEquals(
            $numeric_collection->toArray(),
            $numeric_collection->each('strcmp', false, true)->toArray()
        );
    }

    public function testThatMapWorksAsExpected() {
        
        $int_collection = new \VersatileCollections\IntsCollection(1, 2, 3, 4, 5);

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
        $int_collection = new \VersatileCollections\IntsCollection();
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
        
        // Exception will not be thrown even though we are trying to
        // bind a non-closure callable to $this. The callable is converted
        // to a Closure under the hood, though binding it to $this has no
        // effect in this case.
        $string_keys_and_vals_collection = new \VersatileCollections\GenericCollection();
        $string_keys_and_vals_collection['5'] = '1';
        $string_keys_and_vals_collection['4'] = '2';
        $string_keys_and_vals_collection['3'] = '3';
        $string_keys_and_vals_collection['2'] = '4';
        $string_keys_and_vals_collection['1'] = '5';

        if( PHP_OS_FAMILY === 'Windows' ) {
            
            $this->assertEquals(
                $string_keys_and_vals_collection->map('strcmp', true, true)->toArray(), 
                [ '5' => 1, '4' => 1, '3' => 0, '2' => -1, '1' => -1, ]
            );
            
        } else {
            
            $this->assertEquals(
                $string_keys_and_vals_collection->map('strcmp', true, true)->toArray(), 
                [ '5' => 4, '4' => 2, '3' => 0, '2' => -2, '1' => -4, ]
            );
        }
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
        $collection_of_collections->item1 = \BaseCollectionTestImplementation::makeNew( ['name'=>'Joe', 'age'=>'10'] );
        $collection_of_collections->item2 = \BaseCollectionTestImplementation::makeNew( ['name'=>'Jane', 'age'=>'20'] );
        $collection_of_collections->item3 = \BaseCollectionTestImplementation::makeNew( ['name'=>'Janice', 'age'=>'30'] );
        
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
        
        $collection->setValForEachItem('age2', '48', true);
        $this->assertEquals($collection->item1->age2, '48');
        $this->assertEquals($collection->item2->age2, '48');
        $this->assertEquals($collection->item3->age2, '48');
        
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
        
        ///////////////////////////////////////////////////
        ///////////////////////////////////////////////////
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = new ArrayAccessObject();
        $collection->item2 = new ArrayAccessObject();
        $collection->item3 = new ArrayAccessObject();
        
        $collection->setValForEachItem('age', 24, true);
        $this->assertEquals($collection->item1['age'], 24);
        $this->assertEquals($collection->item2['age'], 24);
        $this->assertEquals($collection->item3['age'], 24);
        
        $collection->setValForEachItem('age', '48', true);
        $this->assertEquals($collection->item1['age'], '48');
        $this->assertEquals($collection->item2['age'], '48');
        $this->assertEquals($collection->item3['age'], '48');
        
        $collection->setValForEachItem('age3', '59', true);
        $this->assertEquals($collection->item1['age3'], '59');
        $this->assertEquals($collection->item2['age3'], '59');
        $this->assertEquals($collection->item3['age3'], '59');
    }
    
    public function testThatIsEmptyWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        //var_dump($collection->getKeys()->toArray());
        $this->assertTrue($collection->isEmpty());
        
        $collection[] = 'some item';
        $this->assertTrue($collection->isEmpty() === false);
    }
    
    public function testThatGetIfExistsWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        
        //var_dump($collection->getKeys()->toArray());
        $this->assertEquals($collection->getIfExists('item1'), ['name'=>'Joe', 'age'=>'10',]);
        $this->assertEquals($collection->getIfExists('item2'), ['name'=>'Jane', 'age'=>'20',]);
        $this->assertEquals($collection->getIfExists('item3'), null);
        
        $collection = new \BaseCollectionTestImplementation();
        $collection[] = ['name'=>'Joe', 'age'=>'10',];
        $collection[] = ['name'=>'Jane', 'age'=>'20',];
        
        $this->assertEquals($collection->getIfExists(0), ['name'=>'Joe', 'age'=>'10',]);
        $this->assertEquals($collection->getIfExists(1), ['name'=>'Jane', 'age'=>'20',]);
        $this->assertEquals($collection->getIfExists(2), null);
        
        $this->expectException(\InvalidArgumentException::class);
        $collection->getIfExists(['non int or string first argument']);
    }
    
    public function testThatColumnWorksAsExpected() {

        $data = [];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertTrue($collection->column('some_key')->isEmpty());

        // collection of ArrayAccess objects
        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertSame(
            $collection->column(777)->toArray(), 
            [ 0=>67, 1=>86, 2=>85, 3=>98, 4=>86, 5=>67 ]
        ); // int, null
        
        $this->assertSame(
            $collection->column('title')->toArray(), 
            [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]
        ); // string, null
        
        $this->assertSame(
            $collection->column('title', 'id')->toArray(), 
            [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
        ); // string, string
        $this->assertSame(
            $collection->column('title', 777)->toArray(), 
            [ 67=>'Hoo', 86=>'Goo', 85=>'Doo', 98=>'Foo' ]
        ); // string, int
        $this->assertSame(
            $collection->column(777, 'title')->toArray(), 
            [ 'Boo'=>67, 'Coo'=>86, 'Doo'=>85, 'Foo'=>98, 'Goo'=>86, 'Hoo'=>67 ]
        ); // int, string
        $this->assertSame(
            $collection->column(777, 777)->toArray(), 
            [ 67=>67, 86=>86, 85=>85, 98=>98 ]
        ); // int, int
        
        // collection of Arrays
        $data = [];
        $data[] = ['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = ['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = ['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertSame(
            $collection->column(777)->toArray(), 
            [ 0=>67, 1=>86, 2=>85, 3=>98, 4=>86, 5=>67 ]
        ); // int, null
        
        $this->assertSame(
            $collection->column('title')->toArray(), 
            [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]
        ); // string, null
        
        $this->assertSame(
            $collection->column('title', 'id')->toArray(), 
            [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
        ); // string, string
        $this->assertSame(
            $collection->column('title', 777)->toArray(), 
            [ 67=>'Hoo', 86=>'Goo', 85=>'Doo', 98=>'Foo' ]
        ); // string, int
        $this->assertSame(
            $collection->column(777, 'title')->toArray(), 
            [ 'Boo'=>67, 'Coo'=>86, 'Doo'=>85, 'Foo'=>98, 'Goo'=>86, 'Hoo'=>67 ]
        ); // int, string
        $this->assertSame(
            $collection->column(777, 777)->toArray(), 
            [ 67=>67, 86=>86, 85=>85, 98=>98 ]
        ); // int, int
        
        // collection of objects with __get, __isset & __set
        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);   
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertSame(
            $collection->column(777)->toArray(), 
            [ 0=>67, 1=>86, 2=>85, 3=>98, 4=>86, 5=>67 ]
        ); // int, null
        
        $this->assertSame(
            $collection->column('title')->toArray(), 
            [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]
        ); // string, null
        
        $this->assertSame(
            $collection->column('title', 'id')->toArray(), 
            [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
        ); // string, string
        $this->assertSame(
            $collection->column('title', 777)->toArray(), 
            [ 67=>'Hoo', 86=>'Goo', 85=>'Doo', 98=>'Foo' ]
        ); // string, int
        $this->assertSame(
            $collection->column(777, 'title')->toArray(), 
            [ 'Boo'=>67, 'Coo'=>86, 'Doo'=>85, 'Foo'=>98, 'Goo'=>86, 'Hoo'=>67 ]
        ); // int, string
        $this->assertSame(
            $collection->column(777, 777)->toArray(), 
            [ 67=>67, 86=>86, 85=>85, 98=>98 ]
        ); // int, int
        
        // collection of objects without __get, __isset & __set
        $data = [];
        $data[] = (object)['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertSame(
            $collection->column(777)->toArray(), 
            [ 0=>67, 1=>86, 2=>85, 3=>98, 4=>86, 5=>67 ]
        ); // int, null
        
        $this->assertSame(
            $collection->column('title')->toArray(), 
            [ 0=>'Boo', 1=>'Coo', 2=>'Doo', 3=>'Foo', 4=>'Goo', 5=>'Hoo' ]
        ); // string, null
        
        $this->assertSame(
            $collection->column('title', 'id')->toArray(), 
            [ 17=>'Boo', 27=>'Coo', 37=>'Doo', 47=>'Foo', 57=>'Goo', 67=>'Hoo' ]
        ); // string, string
        $this->assertSame(
            $collection->column('title', 777)->toArray(), 
            [ 67=>'Hoo', 86=>'Goo', 85=>'Doo', 98=>'Foo' ]
        ); // string, int
        $this->assertSame(
            $collection->column(777, 'title')->toArray(), 
            [ 'Boo'=>67, 'Coo'=>86, 'Doo'=>85, 'Foo'=>98, 'Goo'=>86, 'Hoo'=>67 ]
        ); // int, string
        $this->assertSame(
            $collection->column(777, 777)->toArray(), 
            [ 67=>67, 86=>86, 85=>85, 98=>98 ]
        ); // int, int
    }

    public function testThatColumnWithNonStringAndNonIntColumnKeyWorksAsExpected() {

        $this->expectException(\InvalidArgumentException::class);
        $data = [];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column([]);
    }

    public function testThatColumnWithNonStringAndNonIntIndexKeyWorksAsExpected() {

        $this->expectException(\InvalidArgumentException::class);
        $data = [];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('some_key',[]);
    }

    public function testThatColumnOnCollectionWithOneOrMoreNonArrayAndNonObjectItemsWorksAsExpected() {

        $data = [];
        $data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = 1.55;
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = true;
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title');
    }

    public function testThatColumnOnCollectionOfArraysWithOneOrMoretItemsWithoutStringColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2');
    }

    public function testThatColumnOnCollectionOfArrayAccessObjectsWithOneOrMoretItemsWithoutStringColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2');
    }

    public function testThatColumnOnCollectionOfArraysWithOneOrMoretItemsWithoutIntColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo", 55=>17];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo", 55=>27];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo", 55=>37];
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo", 55=>47];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo", 55=>57];
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo", 55=>67];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column(99);
    }

    public function testThatColumnOnCollectionOfArrayAccessObjectsWithOneOrMoretItemsWithoutIntColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column(99);
    }

    public function testThatColumnOnCollectionOfArraysWithOneOrMoretItemsWithoutNonNullStringIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id2');
    }

    public function testThatColumnOnCollectionOfArrayAccessObjectsWithOneOrMoretItemsWithoutNonNullStringIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id2');
    }

    public function testThatColumnOnCollectionOfArraysWithOneOrMoretItemsWithoutNonNullIntIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = ['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 99);
    }

    public function testThatColumnOnCollectionOfArrayAccessObjectsWithOneOrMoretItemsWithoutNonNullIntIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 17, 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 99);
    }

    public function testThatColumnOnCollectionOfArraysWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = ['id' => [], 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = ['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = ['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = ['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = ['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = ['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id');
    }

    public function testThatColumnOnCollectionOfArrayAccessObjectsWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => [], 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = \VersatileCollections\GenericCollection::makeNew(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id');
    }

    public function testThatColumnOnCollectionOfMagicMethodObjectsWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullStringIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => [], 'volume' => 67, 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id');
    }

    public function testThatColumnOnCollectionOfNonMagicMethodObjectsWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullStringIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (object)['id' => [], 'volume' => 67, 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 'volume' => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 'volume' => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 'volume' => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 'volume' => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 'volume' => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id');
    }

    public function testThatColumnOnCollectionOfMagicMethodObjectsWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullIntIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 777);
    }

    public function testThatColumnOnCollectionOfNonMagicMethodObjectsWithOneOrMoretItemsWithNonStringAndNonIntValueForANonNullIntIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (object)['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 777);
    }

    public function testThatColumnOnCollectionOfMagicMethodObjectsWithNonExistentNonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id2');
    }

    public function testThatColumnOnCollectionOfNonMagicMethodObjectsWithNonExistentNonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (object)['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title', 'id2');
    }

    public function testThatColumnOnCollectionOfMagicMethodObjectsWithNonExistentColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2', 'id');
    }

    public function testThatColumnOnCollectionOfNonMagicMethodObjectsWithNonExistentColumnKeyWorksAsExpected() {

        $data = [];
        $data[] = (object)['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2', 'id');
    }

    public function testThatColumnOnCollectionOfMagicMethodObjectsWithNonExistentColumnKeyAndNonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (new TestValueObject())->setData(['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"]);
        $data[] = (new TestValueObject())->setData(['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"]);
        $data[] = (new TestValueObject())->setData(['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"]);
        $data[] = (new TestValueObject())->setData(['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"]);
        $data[] = (new TestValueObject())->setData(['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"]);
        $data[] = (new TestValueObject())->setData(['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"]);
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2', 'id2');
    }

    public function testThatColumnOnCollectionOfNonMagicMethodObjectsWithNonExistentColumnKeyAndNonNullIndexKeyWorksAsExpected() {

        $data = [];
        $data[] = (object)['id' => 17, 777 => [], 'edition' => 2, 'title'=>"Boo"];
        $data[] = (object)['id' => 27, 777 => 86, 'edition' => 1, 'title'=>"Coo"];
        $data[] = (object)['id' => 37, 777 => 85, 'edition' => 6, 'title'=>"Doo"];
        $data[] = (object)['id' => 47, 777 => 98, 'edition' => 2, 'title'=>"Foo"];
        $data[] = (object)['id' => 57, 777 => 86, 'edition' => 6, 'title'=>"Goo"];
        $data[] = (object)['id' => 67, 777 => 67, 'edition' => 7, 'title'=>"Hoo"];
        
        $this->expectException(\RuntimeException::class);
        $collection = new \VersatileCollections\GenericCollection(...$data);
        $collection->column('title2', 'id2');
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
        $this->assertFalse($collection->containsKey([]));
    }
    
    public function testThatContainsItemWithKeyWorksAsExpected() {

        $item1 = "4";
        $item2 = 5.0;
        $item3 = 7;
        
        $collection = 
            new \BaseCollectionTestImplementation($item1, $item2, $item3);
        
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        
        $this->assertTrue($collection->containsItemWithKey(0, $item1));
        $this->assertTrue($collection->containsItemWithKey('0', $item1));
        $this->assertTrue($collection->containsItemWithKey(1, $item2));
        $this->assertTrue($collection->containsItemWithKey(2, $item3));
        $this->assertTrue($collection->containsItemWithKey('item1', ['name'=>'Joe', 'age'=>'10',]));
        $this->assertTrue($collection->containsItemWithKey('item2', ['name'=>'Jane', 'age'=>'20',]));
        $this->assertFalse($collection->containsItemWithKey('not in collection', $item1));
        $this->assertFalse($collection->containsItemWithKey('item1', 'not in collection'));
        $this->assertFalse($collection->containsItemWithKey([], $item1));
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
        
        $collections = $collection->getCollectionsOfSizeN(3)->toArray();
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14,14=>15], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14
        );
        
        $collections = $collection->getCollectionsOfSizeN(3)->toArray();
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = $collection->getCollectionsOfSizeN(50)->toArray();
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = $collection->getCollectionsOfSizeN(-50)->toArray();
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = $collection->getCollectionsOfSizeN(null)->toArray();
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );
    }
    
    public function testThatYieldCollectionsOfSizeNWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15
        );
        
        $collections = iterator_to_array($collection->yieldCollectionsOfSizeN(3));
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14,14=>15], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14
        );
        
        $collections = iterator_to_array($collection->yieldCollectionsOfSizeN(3));
        $this->assertEquals( [1,2,3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4, 4=>5, 5=>6], array_shift($collections)->toArray() );
        $this->assertEquals( [6=>7, 7=>8, 8=>9], array_shift($collections)->toArray() );
        $this->assertEquals( [9=>10, 10=>11, 11=>12], array_shift($collections)->toArray() );
        $this->assertEquals( [12=>13,13=>14], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->yieldCollectionsOfSizeN(50));
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->yieldCollectionsOfSizeN(-50));
        $this->assertEquals( [1], array_shift($collections)->toArray() );
        $this->assertEquals( [1=>2], array_shift($collections)->toArray() );
        $this->assertEquals( [2=>3], array_shift($collections)->toArray() );
        $this->assertEquals( [3=>4], array_shift($collections)->toArray() );
        $this->assertEquals( [4=>5], array_shift($collections)->toArray() );

        $collection = new \BaseCollectionTestImplementation(
            1, 2, 3, 4, 5
        );
        
        $collections = iterator_to_array($collection->yieldCollectionsOfSizeN(null));
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
        
        // no args
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
        
        // negative number should work like zero or no args
        $collection->makeAllKeysNumeric(-777);
        $this->assertTrue($collection->containsKey(0));
        $this->assertTrue($collection->containsKey(1));
        $this->assertTrue($collection->containsKey(2));
        
        $this->assertEquals($collection[0], $item1);
        $this->assertEquals($collection[1], $item2);
        $this->assertEquals($collection[2], $item3);
        
        // positive number
        $collection->makeAllKeysNumeric(777);
        $this->assertTrue($collection->containsKey(777));
        $this->assertTrue($collection->containsKey(778));
        $this->assertTrue($collection->containsKey(779));
        
        $this->assertEquals($collection[777], $item1);
        $this->assertEquals($collection[778], $item2);
        $this->assertEquals($collection[779], $item3);
        
        $this->expectException(\InvalidArgumentException::class);
        // throw exception for non-int arg
        $collection->makeAllKeysNumeric([]);
    }
    
    public function testThatValidateMethodNameWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation();
        
        $this->assertTrue(
            $collection->validateMethodNamePublic('newMethod', __FUNCTION__)
        );
    }

    public function testThatValidateMethodNameWorksAsExpected2() {
        
        $collection = new \BaseCollectionTestImplementation();
        $this->expectException(\InvalidArgumentException::class);
                
        // This should trigger an Exception because we are
        // passing a non-string (in this case an array)
        // as the method name
        $collection->validateMethodNamePublic([], __FUNCTION__);
    }

    public function testThatValidateMethodNameWorksAsExpected3() {
        
        $collection = new \BaseCollectionTestImplementation();
        $this->expectException(\InvalidArgumentException::class);
                
        // This should trigger an Exception because we are
        // passing a string that is not valid for a method
        // name according to php syntax rules as the method
        // name.
        $collection->validateMethodNamePublic('!badMethodName', __FUNCTION__);
    }

    public function testThatValidateMethodNameWorksAsExpected4() {
        
        $collection = new \BaseCollectionTestImplementation();
        $this->expectException(\VersatileCollections\Exceptions\AddConflictingMethodException::class);
                
        // This should trigger an Exception because we are
        // trying to validate the name of an instance method 
        // that exists in the collection class.
        $collection->validateMethodNamePublic('each', __FUNCTION__);
    }

    public function testThatValidateMethodNameWorksAsExpected5() {
        
        $collection = new \BaseCollectionTestImplementation();
        $this->expectException(\VersatileCollections\Exceptions\AddConflictingMethodException::class);
                
        // This should trigger an Exception because we are
        // trying to validate the name of a static method 
        // that exists in the collection class.
        $collection->validateMethodNamePublic('makeNew', __FUNCTION__);
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
        
        $add_method_return_val = $collection->addMethod(
            $method_name, $method, $has_return_val, $bind_to_this
        );
        
        $this->assertSame($add_method_return_val, $collection);
        
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
        
        //try binding a non-closure callable to $this should
        //not generate exception. It will be internally converted
        //to a closure with $this bound to it but of no effect.
        $collection->addMethod(
            'strToLower', 'strtolower', true, true
        ); 
    }
    
    public function testThatEveryNthWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'
        );
                
        $every_4th_starting_at_0 = $collection->everyNth(4);
        $this->assertEquals(
            $every_4th_starting_at_0->toArray(), ['a',  'e']
        );
        
        $every_4th_starting_at_3 = $collection->everyNth(4, 3);
        $this->assertEquals(
            $every_4th_starting_at_3->toArray(), ['d',  'h']
        );
        
        $empty_collection = new \BaseCollectionTestImplementation();
        $this->assertSame($empty_collection->everyNth(4)->count(), 0);
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

        $this->expectException(\LengthException::class);
        // Should throw a \LengthException. 
        // Can't get a random key from an empty collection.
        \BaseCollectionTestImplementation::makeNew()->randomKey();
    }

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

        $this->expectException(\LengthException::class);
        // Should throw a \LengthException. 
        // Can't get a random keys from an empty collection.
        \BaseCollectionTestImplementation::makeNew()->randomKeys();
    }

    public function testThatRandomKeysWorksAsExpected2() {
        
        $this->expectException(\InvalidArgumentException::class);
        \BaseCollectionTestImplementation::makeNew([1, 2])
                                ->randomKeys("Invalid Length Data Type");
    }

    public function testThatRandomKeysWorksAsExpected3() {
        
        $this->expectException(\InvalidArgumentException::class);
        // requesting more random keys than collection size
        \BaseCollectionTestImplementation::makeNew([1, 2])->randomKeys(5);
    }

    public function testThatRandomKeysWorksAsExpected4() {
        
        $this->expectException(\LengthException::class);
        // requesting random keys from an empty collection
        \BaseCollectionTestImplementation::makeNew()->randomKeys(5);
    }

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

        $this->expectException(\LengthException::class);
        // Should throw a \LengthException. 
        // Can't get a random item from an empty collection.
        \BaseCollectionTestImplementation::makeNew()->randomItem();
    }

    public function testThatRandomItemsWorksAsExpected() {
        
        $collection = new \BaseCollectionTestImplementation(
            'blue', 'red', 'green', 'red', 1, 'blue', '2'
        );
        
        $collection2 = \BaseCollectionTestImplementation::makeNew(
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
        
        $this->expectException(\LengthException::class);
        
        // Should throw a \LengthException. 
        // Can't get a random key from an empty collection.
        \BaseCollectionTestImplementation::makeNew()->randomItems();
    }

    public function testThatRandomItemsWorksAsExpected2() {
        
        $this->expectException(\InvalidArgumentException::class);
        \BaseCollectionTestImplementation::makeNew([1, 2])
                                ->randomItems("Invalid Length Data Type");
    }

    public function testThatRandomItemsWorksAsExpected3() {
        
        $this->expectException(\InvalidArgumentException::class);
        // requesting more random keys than collection size
        \BaseCollectionTestImplementation::makeNew([1, 2])->randomItems(5);
    }

    public function testThatRandomItemsWorksAsExpected4() {
        
        $this->expectException(\LengthException::class);
        
        // requesting random keys from an empty collection
        \BaseCollectionTestImplementation::makeNew()->randomItems(5);
    }
    
    public function testReverse() {
        
        $data = \BaseCollectionTestImplementation::makeNew(['zaeed', 'alan']);
        $reversed = $data->reverse();

        $this->assertSame([1 => 'alan', 0 => 'zaeed'], $reversed->toArray());

        $data = \BaseCollectionTestImplementation::makeNew(['name' => 'taylor', 'framework' => 'laravel']);
        $reversed = $data->reverse();

        $this->assertSame(['framework' => 'laravel', 'name' => 'taylor'], $reversed->toArray());
    }

    public function testReverseMe() {
        
        $data = \BaseCollectionTestImplementation::makeNew(['zaeed', 'alan']);
        $reversed = $data->reverseMe();
        $this->assertSame([1 => 'alan', 0 => 'zaeed'], $reversed->toArray());
        $this->assertSame($reversed, $data);

        $data = \BaseCollectionTestImplementation::makeNew(['name' => 'taylor', 'framework' => 'laravel']);
        $reversed = $data->reverseMe();
        $this->assertSame(['framework' => 'laravel', 'name' => 'taylor'], $reversed->toArray());
        $this->assertSame($reversed, $data);
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
        
        $this->expectException(\RuntimeException::class);
        
        // exception will be thrown
        $collection->searchByCallback($throw_exception_if_this_is_not_set, false); 
    }
    
    public function testThatShuffleWorksAsExpected4() {
        
        $empty_collection = 
            \BaseCollectionTestImplementation::makeNew();
        
        $collection = \BaseCollectionTestImplementation::makeNew(
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
                $collection->getKeys()->toArray() !== $shuffled_collection->getKeys()->toArray()
            );
            
            // same keys exist in both collection
            $this->assertTrue(
                $collection->containsKeys($shuffled_collection->getKeys()->toArray())
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
            $collection->containsKeys($shuffled_collection->getKeys()->toArray())
        );
    }

    public function testSliceExceptionOffset()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->slice([]); // exception should be generated
    }

    public function testSliceExceptionLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->slice(-3,[]); // exception should be generated
    }

    public function testSliceExceptionOffsetAndLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->slice([],[]); // exception should be generated
    }
    
    public function testSliceNegativeOffset()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([6, 7, 8], $collection->slice(-3)->makeAllKeysNumeric()->toArray());
    }
	
    public function testSliceNegativeOffsetAndLength()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([4, 5, 6], $collection->slice(-5, 3)->makeAllKeysNumeric()->toArray());
    }
	
    public function testSliceNegativeOffsetAndNegativeLength()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([3, 4, 5, 6], $collection->slice(-6, -2)->makeAllKeysNumeric()->toArray());
    }
    
    public function testSliceOffset()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([4, 5, 6, 7, 8], $collection->slice(3)->makeAllKeysNumeric()->toArray());
    }
    
    public function testSliceKeysPreserved()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([3=>4, 4=>5, 5=>6, 6=>7, 7=>8], $collection->slice(3)->toArray());
    }

    public function testSliceOffsetAndLength()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([4, 5, 6], $collection->slice(3, 3)->makeAllKeysNumeric()->toArray());
    }

    public function testSliceOffsetAndNegativeLength()
    {
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $this->assertEquals([4, 5, 6, 7], $collection->slice(3, -1)->makeAllKeysNumeric()->toArray());
    }
    
    public function testSplice()
    {
        $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
        $data->splice(1);
        $this->assertEquals(['foo'], $data->toArray());

        $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
        $data->splice(1, 0, ['bar']);
        $this->assertEquals(['foo', 'bar', 'baz'], $data->toArray());

        $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
        $data->splice(1, 1);
        $this->assertEquals(['foo'], $data->toArray());

        $data = \VersatileCollections\GenericCollection::makeNew(['foo', 'baz']);
        $cut = $data->splice(1, 1, ['bar']);
        $this->assertEquals(['foo', 'bar'], $data->toArray());
        $this->assertEquals(['baz'], $cut->toArray());
    }

    public function testSpliceExceptionOffset()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->splice([]); // exception should be generated
    }

    public function testSpliceExceptionLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->splice(-3,[]); // exception should be generated
    }

    public function testSpliceExceptionOffsetAndLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8]);
        $collection->splice([],[]); // exception should be generated
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
    
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
        
        $collection = new \TestValueObjectsCollection(
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
        
        $collection = new \TestValueObjectsCollection(
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
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortByKey();
        $this->assertEquals( [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ], $sorted_collection->toArray() );
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortByKey();
        $this->assertEquals( [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ], $sorted_collection->toArray() );
        
        $collection = \BaseCollectionTestImplementation::makeNew(
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
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortDescByKey();
        $this->assertEquals( 
            [ "d"=>"lemon", "c"=>"apple", "b"=>"banana", "a"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortDescByKey();
        $this->assertEquals( 
            [ "3"=>"lemon", "2"=>"apple", "1"=>"banana", "0"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        
        $collection = \BaseCollectionTestImplementation::makeNew(
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

    public function testThatSortByMultipleFieldsWorksAsExpected() {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        // Collection of Arrays
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

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        // Collection of ArrayAccess Objects
        $data = [];
        $data[0] = new ArrayAccessObject([ 'volume'=>67, 'edition'=>2 ]);
        $data[1] = new ArrayAccessObject([ 'volume'=>86, 'edition'=>2 ]);
        $data[2] = new ArrayAccessObject([ 'volume'=>85, 'edition'=>6 ]);
        $data[3] = new ArrayAccessObject([ 'volume'=>86, 'edition'=>1 ]);

        $collection = new \VersatileCollections\GenericCollection(...$data);
        $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
        $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
        $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
            ], 
            $sorted_collection_asc_desc->toArray()
        );
        
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
            ], 
            $sorted_collection_asc_asc->toArray()
        );

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        // Collection of StdClass Objects
        $data = [];
        $data[0] = ((object)[ 'volume'=>67, 'edition'=>2 ]);
        $data[1] = ((object)[ 'volume'=>86, 'edition'=>2 ]);
        $data[2] = ((object)[ 'volume'=>85, 'edition'=>6 ]);
        $data[3] = ((object)[ 'volume'=>86, 'edition'=>1 ]);

        $collection = new \VersatileCollections\GenericCollection(...$data);
        $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC);
        $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);
        $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
            ], 
            $sorted_collection_asc_desc->toArray()
        );
        
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
            ], 
            $sorted_collection_asc_asc->toArray()
        );

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        // Collection of Objects to be sorted by private and protected properties
        $data = [];
        $data[0] = new TestValueObject3(67, 2);
        $data[1] = new TestValueObject3(86, 2);
        $data[2] = new TestValueObject3(85, 6);
        $data[3] = new TestValueObject3(86, 1);

        $collection = new \VersatileCollections\GenericCollection(...$data);
        $sort_param = new \VersatileCollections\MultiSortParameters('volume', SORT_ASC, SORT_NUMERIC); // protected property
        $sort_param2 = new \VersatileCollections\MultiSortParameters('edition', SORT_DESC, SORT_NUMERIC);  // private property
        $sorted_collection_asc_desc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
            ], 
            $sorted_collection_asc_desc->toArray()
        );
        
        $sort_param2->setSortDirection(SORT_ASC);
        $sorted_collection_asc_asc = $collection->sortByMultipleFields($sort_param, $sort_param2);
        $this->assertSame(
            [
                0 => 
//                [
//                    'volume' => 67,
//                    'edition' => 2
//                ]
                $data[0],
                2 => 
//                [
//                    'volume' => 85,
//                    'edition' => 6
//                ]
                $data[2],
                3 => 
//                [
//                    'volume' => 86,
//                    'edition' => 1
//                ]
                $data[3],
                1 => 
//                [
//                    'volume' => 86,
//                    'edition' => 2
//                ]
                $data[1],
            ], 
            $sorted_collection_asc_asc->toArray()
        );
        
        ////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////
        $collection_of_wrong_types = new \VersatileCollections\GenericCollection(...[1,2,3]);
        
        $this->expectException(\RuntimeException::class);
        
        // Can't multi sort collection of non-arrays or ArrayAccess objects
        $collection_of_wrong_types->sortByMultipleFields($sort_param);
    }

    public function testThatSortByMultipleFieldsWithNoArgsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->expectException(\InvalidArgumentException::class);
        
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
        
        $collection = new \TestValueObjectsCollection(
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
        
        $collection = new \TestValueObjectsCollection(
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
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortMeByKey();
        $this->assertEquals( [ "a"=>"orange", "b"=>"banana", "c"=>"apple", "d"=>"lemon" ], $sorted_collection->toArray() );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortMeByKey();
        $this->assertEquals( [ "0"=>"orange", "1"=>"banana", "2"=>"apple", "3"=>"lemon" ], $sorted_collection->toArray() );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNew(
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
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple"]
        );
        $sorted_collection = $collection->sortMeDescByKey();
        $this->assertEquals( 
            [ "d"=>"lemon", "c"=>"apple", "b"=>"banana", "a"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNew(
            ["3"=>"lemon", "0"=>"orange", "1"=>"banana", "2"=>"apple"]
        );
        $sorted_collection = $collection->sortMeDescByKey();
        $this->assertEquals( 
            [ "3"=>"lemon", "2"=>"apple", "1"=>"banana", "0"=>"orange" ], 
            $sorted_collection->toArray() 
        );
        // test that $this was returned
        $this->assertTrue($sorted_collection === $collection);
        
        $collection = \BaseCollectionTestImplementation::makeNew(
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
        
        $this->expectException(\RuntimeException::class);
        
        // Can't multi sort collection of non-arrays or ArrayAccess objects
        $collection_of_wrong_types->sortMeByMultipleFields($sort_param);
    }

    public function testThatSortMeByMultipleFieldsWithNoArgsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->expectException(\InvalidArgumentException::class);
        
        // Exception should be thrown if no sort param supplied
        $collection->sortMeByMultipleFields();
    }
    
    public function testThatSplitWorksAsExpected() {

        $data = [ 1, 2, 3, 4, 5, 6, 7 ];
        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->assertTrue(\VersatileCollections\GenericCollection::makeNew()->split(0)->isEmpty());
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

    public function testThatSplitWithNonIntNumberOfGroupsWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->expectException(\InvalidArgumentException::class);
        
        // Exception should be thrown
        $collection->split('Invalid Data Type for Number of Groups');
    }

    public function testThatSplitWithNumberOfGroupsLargerThanCollectionSizeWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->expectException(\InvalidArgumentException::class);
        
        // Exception should be thrown
        $collection->split(7);
    }

    public function testThatSplitWithNumberOfGroupsLessThanZeroWorksAsExpected() {

        $data = [];
        $data[0] = [ 'volume' => 67, 'edition' => 2 ];
        $data[1] = [ 'volume' => 86, 'edition' => 2 ];
        $data[2] = [ 'volume' => 85, 'edition' => 6 ];
        $data[3] = [ 'volume' => 86, 'edition' => 1 ];

        $collection = new \VersatileCollections\GenericCollection(...$data);
        
        $this->expectException(\InvalidArgumentException::class);
        
        // Exception should be thrown
        $collection->split(-7);
    }

    public function testTake() {
        
        $data = new \VersatileCollections\GenericCollection(...['taylor', 'dayle', 'shawn']);
        $data = $data->take(2);
        $this->assertEquals(['taylor', 'dayle'], $data->toArray());
        
        $this->assertTrue($data->take(0)->isEmpty());
        
        $this->expectException(\InvalidArgumentException::class);
        $data->take([]); // should throw exception
    }
    
    public function testTakeLast() {
        
        $data = new \VersatileCollections\GenericCollection(...['taylor', 'dayle', 'shawn']);
        $data = $data->take(-2);
        $this->assertEquals([1 => 'dayle', 2 => 'shawn'], $data->toArray());
    }
    
    public function testTap() {
        
        $collection = new \VersatileCollections\GenericCollection(...[1, 2, 3]);

        $fromTap = [];
        $collection = $collection->tap(function ($collection) use (&$fromTap) {
            $fromTap = $collection->slice(0, 1)->toArray();
            $collection->removeAll(); // empty copy
        });

        $this->assertSame([1], $fromTap);
        $this->assertSame([1, 2, 3], $collection->toArray());
    }
    
    public function testUnion() {
        
        $c = \VersatileCollections\GenericCollection::makeNew(['name' => 'Hello']);
        $this->assertEquals(['name' => 'Hello'], $c->unionWith([])->toArray());
        $this->assertEquals(['name' => 'Hello', 'id' => 1], $c->unionWith(['id' => 1])->toArray());
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
        
        $this->assertSame(\BaseCollectionTestImplementation::makeNew()->unique()->toArray(), []);
        $this->assertEquals($collection->unique()->toArray(), ['4', 5.0, 7, true, false, 4, '5.0', '7','true', 'false', $object, $object2]);
    }
    
    public function testValues() {
        
        $c = \BaseCollectionTestImplementation::makeNew(
            [
                'a' => ['id' => 1, 'name' => 'Hello'], 
                'b' => ['id' => 2, 'name' => 'World']
            ]
        );
        
        $values = $c->getItems();
        
        $this->assertTrue(
            $values instanceof \VersatileCollections\CollectionInterface
        );
        $this->assertSame(
            [
                ['id' => 1, 'name' => 'Hello'], 
                ['id' => 2, 'name' => 'World']
            ],
            $values->toArray()
        );
    }

    public function testWhenTrue() {
        
        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        $newName = 'adam';
        
        $collection->whenTrue('adam', function ($collection)use(&$newName) {
            return $collection->push($newName);
        });

        $this->assertSame(['michael', 'tom', 'adam'], $collection->toArray());

        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        // Test return null
        $this->assertSame(
            null, 
            $collection->whenTrue(false, function ($collection) {
                return $collection->push('adam');
            })
        );
        
        $this->assertSame(['michael', 'tom'], $collection->toArray());
    }

    public function testWhenTrueDefault() {
        
        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        $collection->whenTrue(
            false, 
            function ($collection) {

                return $collection->push('adam');
            }, 
            function ($collection) {

                return $collection->push('taylor');
            }
        );

        $this->assertSame(['michael', 'tom', 'taylor'], $collection->toArray());
    }

    public function testWhenFalse() {
        
        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        $collection->whenFalse(false, function ($collection) {
            return $collection->push('adam');
        });

        $this->assertSame(['michael', 'tom', 'adam'], $collection->toArray());

        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        // Test return null
        $this->assertSame(
            null, 
            $collection->whenFalse(true, function ($collection) {
                return $collection->push('adam');
            })
        );
        
        $this->assertSame(['michael', 'tom'], $collection->toArray());
    }

    public function testWhenFalseDefault() {
        
        $collection = new \BaseCollectionTestImplementation(...['michael', 'tom']);

        $collection->whenFalse(
            true, 
            function ($collection) {

                return $collection->push('adam');
            }, 
            function ($collection) {

                return $collection->push('taylor');
            }
        );

        $this->assertSame(['michael', 'tom', 'taylor'], $collection->toArray());
    }

    public function testGetAsNewType() {
        
        $generic_ints_collection = 
            \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
        
        $generic_floats_collection = 
            \VersatileCollections\GenericCollection::makeNew([1.5, 2.5, 3.5, 4.5, 5.5]);
        
        $generic_ints_and_floats_collection = 
            \VersatileCollections\GenericCollection::makeNew([1, 2.5, 3, 4.5, 5]);
        
        $generic_strings_collection = 
            \VersatileCollections\GenericCollection::makeNew(['1', '2.5', '3', '4.5', '5']);
        
        $ints_collection = 
            \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5]);
        
        $floats_collection = 
            \VersatileCollections\FloatsCollection::makeNew([1.5, 2.5, 3.5, 4.5, 5.5]);
        
        $numerics_collection = 
            \VersatileCollections\NumericsCollection::makeNew([1, 2.5, 3, 4.5, 5]);
        
        $strings_collection = 
            \VersatileCollections\GenericCollection::makeNew(['1', '2.5', '3', '4.5', '5']);
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_ints_collection->getAsNewType(); // no args
        $this->assertInstanceOf(
            \VersatileCollections\GenericCollection::class, 
            $new
        );
        $this->assertSame(
            [1, 2, 3, 4, 5], 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_ints_collection->getAsNewType(
            \VersatileCollections\IntsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\IntsCollection::class, 
            $new
        );
        $this->assertSame(
            [1, 2, 3, 4, 5], 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_ints_collection->getAsNewType(
            \VersatileCollections\IntsCollection::makeNew() // object instance 
        );
        $this->assertInstanceOf(
            \VersatileCollections\IntsCollection::class, 
            $new
        );
        $this->assertSame(
            [1, 2, 3, 4, 5], 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_floats_collection->getAsNewType(
            \VersatileCollections\FloatsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\FloatsCollection::class, 
            $new
        );
        $this->assertSame(
            [1.5, 2.5, 3.5, 4.5, 5.5], 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_ints_and_floats_collection->getAsNewType(
            \VersatileCollections\NumericsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\NumericsCollection::class, 
            $new
        );
        $this->assertSame(
            $generic_ints_and_floats_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $generic_strings_collection->getAsNewType(
            \VersatileCollections\StringsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\StringsCollection::class, 
            $new
        );
        $this->assertSame(
            $generic_strings_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $ints_collection->getAsNewType(
            \VersatileCollections\NumericsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\NumericsCollection::class, 
            $new
        );
        $this->assertSame(
            $ints_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $ints_collection->getAsNewType(
            \VersatileCollections\ScalarsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\ScalarsCollection::class, 
            $new
        );
        $this->assertSame(
            $ints_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $floats_collection->getAsNewType(
            \VersatileCollections\NumericsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\NumericsCollection::class, 
            $new
        );
        $this->assertSame(
            $floats_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $floats_collection->getAsNewType(
            \VersatileCollections\ScalarsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\ScalarsCollection::class, 
            $new
        );
        $this->assertSame(
            $floats_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $numerics_collection->getAsNewType(
            \VersatileCollections\ScalarsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\ScalarsCollection::class, 
            $new
        );
        $this->assertSame(
            $numerics_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        $new = $strings_collection->getAsNewType(
            \VersatileCollections\ScalarsCollection::class  // string
        );
        $this->assertInstanceOf(
            \VersatileCollections\ScalarsCollection::class, 
            $new
        );
        $this->assertSame(
            $strings_collection->toArray(), 
            $new->toArray()
        );
        $this->assertSame(
            5, 
            $new->count()
        );
    }

    public function testGetAsNewTypeGenericCollectionOfNonArraysToArraysCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ArraysCollection::class);
    }

    public function testGetAsNewTypeGenericCollectionOfNonCallablesToCallablesCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\CallablesCollection::class);
    }

    public function testGetAsNewTypeGenericCollectionOfNonFloatsToFloatsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\FloatsCollection::class);
    }

    public function testGetAsNewTypeGenericCollectionOfNonObjectsToObjectsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ObjectsCollection::class);
    }

    public function testGetAsNewTypeGenericCollectionOfNonResourcesToResourcesCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ResourcesCollection::class);
    }

    public function testGetAsNewTypeGenericCollectionOfNonStringsToStringsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\StringsCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToArraysCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ArraysCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToCallablesCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\CallablesCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToFloatsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\FloatsCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToObjectsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ObjectsCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToResourcesCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\ResourcesCollection::class);
    }

    public function testGetAsNewTypeIntsCollectionToStringsCollection() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(\VersatileCollections\StringsCollection::class);
    }

    public function testGetAsNewTypeWithNonStringAndNonObjectArg() {
        
        $this->expectException(\InvalidArgumentException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType([]);
    }

    public function testGetAsNewTypeWithStringNonCollectionInterfaceSubClassArg() {
        
        $this->expectException(\InvalidArgumentException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType('Yay');
    }

    public function testGetAsNewTypeWithObjectNonCollectionInterfaceSubClassArg() {
        
        $this->expectException(\InvalidArgumentException::class);
        \VersatileCollections\IntsCollection::makeNew([1, 2, 3, 4, 5])
                ->getAsNewType(new stdClass());
    }
    
    public function testRemoveAll() {
        
        $c = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
        
        $this->assertCount(5, $c);
        
        $result = $c->removeAll();
        
        $this->assertCount(0, $c);
        $this->assertCount(0, $result);
        $this->assertSame($c, $result);
        
        // test removing with specified keys
        $c = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5]);
        
        $result = $c->removeAll([0,2,4]);
        
        $this->assertCount(2, $c);
        $this->assertCount(2, $result);
        $this->assertSame($c, $result);
        $this->assertTrue($c->containsItem(2));
        $this->assertTrue($c->containsItem(4));
        $this->assertTrue($result->containsItem(4));
        $this->assertTrue($result->containsItem(4));
        
    }
    
    public function testThatGetAllWhereKeysInWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
        
        $item1 = $collection->item1;
        $item2 = $collection->item2;
        $item3 = $collection->item3;
        
        $new_collection = $collection->getAllWhereKeysIn(['item1', 'item3']);
        
        $this->assertSame($new_collection->count(), 2);
        $this->assertSame(get_class($new_collection), get_class($collection));
        $this->assertTrue($new_collection->containsItemWithKey('item1', $item1));
        $this->assertFalse($new_collection->containsItemWithKey('item2', $item2));
        $this->assertTrue($new_collection->containsItemWithKey('item3', $item3));
        
        
        // test empty collection returned
        $this->assertTrue(
            $collection->getAllWhereKeysIn(['non existens key 1', 'non existens key 2'])
                       ->isEmpty()
        );
    }
    
    public function testThatGetAllWhereKeysNotInWorksAsExpected() {

        $collection = new \BaseCollectionTestImplementation( );
        $collection->item1 = ['name'=>'Joe', 'age'=>'10',];
        $collection->item2 = ['name'=>'Jane', 'age'=>'20',];
        $collection->item3 = ['name'=>'Janice', 'age'=>'30',];
        
        $item1 = $collection->item1;
        $item2 = $collection->item2;
        $item3 = $collection->item3;
        
        $new_collection = $collection->getAllWhereKeysNotIn(['item1', 'item3']);
        
        $this->assertSame($new_collection->count(), 1);
        $this->assertSame(get_class($new_collection), get_class($collection));
        $this->assertFalse($new_collection->containsItemWithKey('item1', $item1));
        $this->assertTrue($new_collection->containsItemWithKey('item2', $item2));
        $this->assertFalse($new_collection->containsItemWithKey('item3', $item3));
        
        // test empty collection returned
        $this->assertTrue(
            $collection->getAllWhereKeysNotIn(['item1', 'item2', 'item3'])
                       ->isEmpty()
        );
    }
    
    public function testPaginate() {
        
        $empty_c = new \BaseCollectionTestImplementation();
        $c = new \BaseCollectionTestImplementation(
                ...[ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
            );

        $this->assertSame([], $empty_c->paginate(1, 2)->toArray());
        $this->assertEquals(['a', 'b'], $c->paginate(0, 2)->toArray());
        $this->assertEquals(['a'], $c->paginate(0, -2)->toArray());
        $this->assertEquals(['a', 'b'], $c->paginate(-777, 2)->toArray());
        $this->assertEquals(['a', 'b'], $c->paginate(1, 2)->toArray());
        $this->assertEquals([2 => 'c', 3 => 'd'], $c->paginate(2, 2)->toArray());
        $this->assertEquals(
            [ 3 => 'd', 4 =>'e', 5=>'f' ], 
            $c->paginate(2, 3)->toArray()
        );
        
        // number of items in page > $c->count()
        $this->assertEquals(
            [ 1 => 'b', 2 => 'c', 3 => 'd', 4 =>'e', 5=>'f', 6=>'g', 7=>'h'], 
            $c->paginate(2, 777)->toArray()
        );
        
        // only 4 pages of two items per page available in 
        //  [ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
        // requesting a 5th page should return an empty collection
        $this->assertEquals([], $c->paginate(5, 2)->toArray()); 
    }

    public function testPaginateNonIntPageNumberException() {
        
        $this->expectException(\InvalidArgumentException::class);
        $c = new \BaseCollectionTestImplementation(
                ...[ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
            );
        
        $c->paginate([], 2)->toArray();
    }

    public function testPaginateNonIntNumberOfItemsPerPageException() {
        
        $this->expectException(\InvalidArgumentException::class);
        $c = new \BaseCollectionTestImplementation(
                ...[ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
            );
        
        $c->paginate(1, [])->toArray();
    }

    public function testPaginateNonIntPageNumberAndNonIntNumberOfItemsPerPageException() {
        
        $this->expectException(\InvalidArgumentException::class);
        $c = new \BaseCollectionTestImplementation(
                ...[ 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' ]
            );
        
        $c->paginate([], [])->toArray();
    }

    public function testThat__CallWorksAsExpected2() {
        
        \VersatileCollections\GenericCollection::addMethodForAllInstances(
            'toUpper', 
            'strtoupper', 
            true,
            true
        );
        
        $collection = new \BaseCollectionTestImplementation();
        $collection[] = 'Johnny Cash';
        $collection[] = 'Suzzy Something';
        $collection[] = 'Jack Bauer';
        $collection[] = 'Jane Fonda';
        
        //try binding a non-closure callable to $this should
        //not generate exception. It will be internally converted
        //to a closure with $this bound to it but of no effect.
        $this->assertTrue($collection->toUpper('Johnny Cash') === 'JOHNNY CASH');
    }

    public function testThat__CallWorksAsExpected() {
        
        // add to parent class
        \VersatileCollections\GenericCollection::addMethodForAllInstances(
            'toUpper', 
            function() {
            
                $upperred_items = [];
            
                foreach($this as $item) {
                    
                    $upperred_items[] = 
                        strtoupper($item).' via addMethodForAllInstances'
                        . \VersatileCollections\GenericCollection::class;
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
        
        $this->assertContains('JOHNNY CASH via addMethodForAllInstances'. \VersatileCollections\GenericCollection::class, $upperred_items);
        $this->assertContains('SUZZY SOMETHING via addMethodForAllInstances'. \VersatileCollections\GenericCollection::class, $upperred_items);
        $this->assertContains('JACK BAUER via addMethodForAllInstances'. \VersatileCollections\GenericCollection::class, $upperred_items);
        $this->assertContains('JANE FONDA via addMethodForAllInstances'. \VersatileCollections\GenericCollection::class, $upperred_items);
        
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
        
        $this->expectException(\BadMethodCallException::class);
        $collection->nonExistentMethod();
    }

    public function testThat__CallStaticWorksAsExpected() {
        
        // add to parent class
        \VersatileCollections\GenericCollection::addStaticMethod(
            'toUpper', 
            function() {
            
                return 'toUpper via addStaticMethod'
                        . \VersatileCollections\GenericCollection::class;
            }, 
            true
        );
        
        $result = \BaseCollectionTestImplementation::toUpper();
        
        $this->assertEquals('toUpper via addStaticMethod'. \VersatileCollections\GenericCollection::class, $result);
        
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

        $this->expectException(\BadMethodCallException::class);
        \BaseCollectionTestImplementation::nonExistentMethod();
    }
    
    public function testDiffCollection() {
	
        $c = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
        
        $this->assertEquals(['id' => 1], $c->diff(['first_word' => 'Hello', 'last_word' => 'World'])->toArray());
    }
	
    public function testDiffUsingWithCollection() {
	
        $c = \VersatileCollections\GenericCollection::makeNew(['en_GB', 'fr', 'HR']);
        // demonstrate that diffKeys wont support case insensitivity
        $this->assertEquals(['en_GB', 'fr', 'HR'], $c->diff(['en_gb', 'hr'])->toArray());
        // allow for case insensitive difference
        $this->assertEquals(['fr'], $c->diffUsing(['en_gb', 'hr'], 'strcasecmp')->getItems()->toArray());
    }
	
    public function testDiffUsingWithEmptyArray() {
	
        $c = \VersatileCollections\GenericCollection::makeNew(['en_GB', 'fr', 'HR']);
        $this->assertEquals(['en_GB', 'fr', 'HR'], $c->diffUsing([], 'strcasecmp')->getItems()->toArray());
    }
	
    public function testDiffWithEmptyArray() {
	
        $c = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
        $this->assertEquals(['id' => 1, 'first_word' => 'Hello'], $c->diff([])->toArray());
    }
	
    public function testDiffKeys() {
	
        $c1 = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
        $c2 = \VersatileCollections\GenericCollection::makeNew(['id' => 123, 'foo_bar' => 'Hello']);
        $this->assertEquals(['first_word' => 'Hello'], $c1->diffKeys($c2->toArray())->toArray());
    }
	
    public function testDiffKeysUsing() {
	
        $c1 = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello']);
        $c2 = \VersatileCollections\GenericCollection::makeNew(['ID' => 123, 'foo_bar' => 'Hello']);
        // demonstrate that diffKeys wont support case insensitivity
        $this->assertEquals(['id'=>1, 'first_word'=> 'Hello'], $c1->diffKeys($c2->toArray())->toArray());
        // allow for case insensitive difference
        $this->assertEquals(['first_word' => 'Hello'], $c1->diffKeysUsing($c2->toArray(), 'strcasecmp')->toArray());
    }
	
    public function testDiffAssoc() {
	
        $c1 = \VersatileCollections\GenericCollection::makeNew(['id' => 1, 'first_word' => 'Hello', 'not_affected' => 'value']);
        $c2 = \VersatileCollections\GenericCollection::makeNew(['id' => 123, 'foo_bar' => 'Hello', 'not_affected' => 'value']);
        $this->assertEquals(['id' => 1, 'first_word' => 'Hello'], $c1->diffAssoc($c2->toArray())->toArray());
    }
	
    public function testDiffAssocUsing() {
	
        $c1 = \VersatileCollections\GenericCollection::makeNew(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red']);
        $c2 = \VersatileCollections\GenericCollection::makeNew(['A' => 'green', 'yellow', 'red']);
        // demonstrate that the case of the keys will affect the output when diffAssoc is used
        $this->assertEquals(['a' => 'green', 'b' => 'brown', 'c' => 'blue', 'red'], $c1->diffAssoc($c2->toArray())->toArray());
        // allow for case insensitive difference
        $this->assertEquals(['b' => 'brown', 'c' => 'blue', 'red'], $c1->diffAssocUsing($c2->toArray(), 'strcasecmp')->toArray());
    }

    public function testAllSatisfyConditions() {
	
        $c = \VersatileCollections\GenericCollection::makeNew([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        
        // test that $this also works
        // All items less than 11: true
        $this->assertTrue(
            $c->allSatisfyConditions(
                function($key, $item) {
                    return $this->count() > 0 && $item < 11;
                }
            )
        );
            
        $this->assertFalse(
            $c->allSatisfyConditions(
                function($key, $item) {
                    return $item > 5;
                }
            )
        );
            
        $this->assertFalse(
            $c->allSatisfyConditions(
                function($key, $item) {
                    return (isset($this) && $this instanceof \VersatileCollections\CollectionInterface);
                },
                false
            )
        );
                
        // use non-closure callback without bind $this
        $this->assertFalse(
            $c->allSatisfyConditions(
                [ \TestValueObject2::class, 'isItemGreaterThan11' ],
                false
            )
        );
        
        // use non-closure callback and try binding to $this which should 
        // also not throw exception
        $this->assertFalse(
            $c->allSatisfyConditions(
                'TestValueObject2_IsItemGreaterThan11'
            )
        );
        
        $c2 = \VersatileCollections\GenericCollection::makeNew(
            [12, 20, 30, 40, 50, 60, 70, 80, 90, 100]
        );
        $this->assertTrue(
            $c2->allSatisfyConditions(
                'TestValueObject2_IsItemGreaterThan11'
            )
        );
    }
    
    public function testIntersectByKeys() {
        
        $array1 = array('blue'=>1, 'red'=>2, 'green'=>3, 'purple'=>4);
        $array2 = array('green'=>5, 'blue'=>6, 'yellow'=>7, 'cyan'=>8);
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeys($array2)->toArray(), 
            ['blue'=>1, 'green'=>3]
        );
    }
    
    public function testIntersectByItems() {
        
        $array1 = array("a" => "green", "red", "blue");
        $array2 = array("b" => "green", "yellow", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByItems($array2)->toArray(), 
            ["a" => "green", 0 => "red"]
        );
    }
    
    public function testIntersectByKeysAndItems() {
        
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "b" => "yellow", "blue", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysAndItems($array2)->toArray(), 
            ["a" => "green"]
        );
    }
    
    public function testIntersectByKeysUsingCallback() {

        $key_compare_func = function ($key1, $key2) {
            
            if ($key1 == $key2)
                return 0;
            else if ($key1 > $key2)
                return 1;
            else
                return -1;
        };
        
        $array1 = array('blue'  => 1, 'red'  => 2, 'green'  => 3, 'purple' => 4);
        $array2 = array('green' => 5, 'blue' => 6, 'yellow' => 7, 'cyan'   => 8);
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysUsingCallback($array2, $key_compare_func)->toArray(), 
            ['blue'  => 1, 'green'  => 3]
        );
    }
    
    public function testIntersectByItemsUsingCallback() {

        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByItemsUsingCallback($array2, "strcasecmp")->toArray(), 
            ["a" => "green", "b" => "brown", 0 => "red"]
        );
    }
    
    public function testIntersectByKeysAndItemsUsingCallbacks() {
        
        //////////////////////////////////////////////////////////////////////////////
        // null key callback and null item callback
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "green", "b" => "yellow", "blue", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysAndItemsUsingCallbacks($array2, null, null)->toArray(), 
            ["a" => "green"]
        );
        
        //////////////////////////////////////////////////////////////////////////////
        // non-null key callback and non-null item callback
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysAndItemsUsingCallbacks($array2, "strcasecmp", "strcasecmp")->toArray(), 
            ["a" => "green", "b" => "brown"]
        );
        
        //////////////////////////////////////////////////////////////////////////////
        // null key callback and non-null item callback
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysAndItemsUsingCallbacks($array2, null, "strcasecmp")->toArray(), 
            ["a" => "green"]
        );
        //////////////////////////////////////////////////////////////////////////////
        // non-null key callback and null item callback
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red");
        $array2 = array("a" => "GREEN", "B" => "brown", "yellow", "red");
        
        $collection = \VersatileCollections\GenericCollection::makeNew($array1);
        
        $this->assertSame(
            $collection->intersectByKeysAndItemsUsingCallbacks($array2, "strcasecmp", null)->toArray(), 
            ["b" => "brown"]
        );
    }
}
