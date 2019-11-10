<?php
declare(strict_types=1);
/**
 * Description of CustomStrictlyTypedCollectionTest
 *
 * @author aadegbam
 */
class CustomStrictlyTypedCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }
    
    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );

        $this->assertEquals($collection->count(), 4);
        
        $collection->item1 = new TestValueObject('Johnny Cash', 509);
        $collection->item2 = new TestValueObject('Suzzy Something', 239);
        $collection->item3 = new TestValueObject('Jack Bauer', 439);
        $collection->item4 = new TestValueObject('Jane Fonda', 559);
        
        $collection[] = new TestValueObject('Johnny Cash', 1509);
        $collection[] = new TestValueObject('Suzzy Something', 1239);
        $collection[] = new TestValueObject('Jack Bauer', 1439);
        $collection[] = new TestValueObject('Jane Fonda', 1559);
        
        $this->assertEquals($collection->count(), 12);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // var_dump($collection->toArray());
        // line below should produce an exception since we are injecting
        // a non-object
        $collection->item5 = [];
    }

    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection2() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-object
        $collection[] = [];
    }

    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection3() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-object
        $collection['item5'] = [];
    }

    public function testThatReduceWorksAsExpected() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );

        $sum_of_ages = $collection->reduce(
            function($carry, $item) {
            
                return $carry + $item->getAge();
            }
        );
        $this->assertEquals($sum_of_ages, 171);

        $sum_of_ages_plus_ten = $collection->reduce(
            function($carry, $item) {
            
                return $carry + $item->getAge();
            },
            10
        );
        $this->assertEquals($sum_of_ages_plus_ten, 181);
    }

    public function testThatReduceWithKeyAccessWorksAsExpected() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );

        $sum_of_ages = $collection->reduceWithKeyAccess(
            function($carry, $item, $key) {
            
                return $carry + $item->getAge();
            }
        );
        $this->assertEquals($sum_of_ages, 171);

        $sum_of_ages_minus_keys = $collection->reduceWithKeyAccess(
            function($carry, $item, $key) {
            
                return $carry + $item->getAge() - ((int)$key);
            }
        );
        $this->assertEquals($sum_of_ages_minus_keys, 165);

        $sum_of_ages_and_keys_plus_ten = $collection->reduceWithKeyAccess(
            function($carry, $item, $key) {
            
                return $carry + $item->getAge() + ((int)$key);
            },
            10
        );
        $this->assertEquals($sum_of_ages_and_keys_plus_ten, 187);
    }
    
    public function testThatTransformWorksAsExpected() {
        
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );

        $collection->transform(
            function($key, \TestValueObject $item) {
                $item->setName($item->getName().':Transformed');
                return $item;
            }
        );
        
        foreach ($collection as $item) {
            
            $this->assertStringContainsString(':Transformed', $item->getName());
        }
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // transformer that returns wrong type should throw exception
        $collection->transform(
            function($key, \TestValueObject $item) {
            
                return 'Wrong Type'; // should have been instance of \TestValueObject
            }
        );
    }
    
    public function testThatAppendCollectionWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
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
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidCollectionOperationException::class);
        
        $collection->appendCollection($other_collection);
    }
    
    public function testThatAppendCollectionWorksAsExpected2() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = new \TestValueObjectsCollection(
            $other_item1, $other_item2, $other_item3, $other_item4
        );
        
        $collection->appendCollection($other_collection);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertFalse($collection->containsItem('not in collection'));
        $this->assertFalse($collection->containsItem(4));
        $this->assertFalse($collection->containsItem('5.0'));
        $this->assertFalse($collection->containsItem('7'));
        $this->assertSame($collection->lastItem() , $other_item4);
        $this->assertEquals(
            $collection->toArray() ,
            [$item1, $item2, $item3, $item4, $other_item1, $other_item2, $other_item3, $other_item4]
        );
    }
    
    public function testThatPrependCollectionWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
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
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidCollectionOperationException::class);
        
        $collection->prependCollection($other_collection);
    }
    
    public function testThatPrependCollectionWorksAsExpected2() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = new \TestValueObjectsCollection(
            $other_item1, $other_item2, $other_item3, $other_item4
        );
        
        $collection->prependCollection($other_collection);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertFalse($collection->containsItem('not in collection'));
        $this->assertFalse($collection->containsItem(4));
        $this->assertFalse($collection->containsItem('5.0'));
        $this->assertFalse($collection->containsItem('7'));
        $this->assertEquals($collection->lastItem() , $item4);
        $this->assertEquals(
            $collection->toArray() ,
            [$other_item1, $other_item2, $other_item3, $other_item4, $item1, $item2, $item3, $item4, ]
        );
    }

    public function testThatMergeCollectionWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
                
        $other_item1 = "4";
        $other_item2 = 5.0;
        $other_item3 = 7;
        $other_item4 = true;
        $other_item5 = false;
        $other_item6 = tmpfile();
        $other_item7 = new \ArrayObject();
        $other_item8 = function(){ return 'Hello World!'; };
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4, 
            $other_item5, $other_item6, $other_item7, $other_item8
        ];
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // should generate exception since one or more item(s) 
        // not of type `TestValueObject` are present in $other_collection
        $collection->mergeWith($other_collection);
    }
    
    public function testThatMergeCollectionWorksAsExpected2() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4
        ];
        
        // $other_collection will completely overwrite the items in $collection
        // since they have the same number of items and keys
        
        $merged_collection = $collection->mergeWith($other_collection);
        
        $this->assertTrue($merged_collection->containsItem($other_item1));
        $this->assertTrue($merged_collection->containsItem($other_item2));
        $this->assertTrue($merged_collection->containsItem($other_item3));
        $this->assertTrue($merged_collection->containsItem($other_item4));
        $this->assertFalse($merged_collection->containsItem($item1));
        $this->assertFalse($merged_collection->containsItem($item2));
        $this->assertFalse($merged_collection->containsItem($item3));
        $this->assertFalse($merged_collection->containsItem($item4));
        $this->assertSame($merged_collection->firstItem() , $other_item1);
        $this->assertSame($merged_collection->lastItem() , $other_item4);
        $this->assertEquals(
            $merged_collection->toArray() ,
            [ $other_item1, $other_item2, $other_item3, $other_item4, ]
        );
        
        // test original collection after the merge
        $this->assertFalse($collection->containsItem($other_item1));
        $this->assertFalse($collection->containsItem($other_item2));
        $this->assertFalse($collection->containsItem($other_item3));
        $this->assertFalse($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertSame($collection->firstItem() , $item1);
        $this->assertSame($collection->lastItem() , $item4);
        $this->assertEquals(
            $collection->toArray() ,
            [ $item1, $item2, $item3, $item4, ]
        );
        
        $this->assertNotSame($collection, $merged_collection);
    }
    
    public function testThatMergeCollectionWorksAsExpected3() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        $item5 = new TestValueObject('Jane Fonda22', 1212);
        $item6 = new TestValueObject('Jane Fonda22', 21);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4, $item5, $item6
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4
        ];
        
        $merged_collection = $collection->mergeWith($other_collection);
        
        $this->assertTrue($merged_collection->containsItem($other_item1));
        $this->assertTrue($merged_collection->containsItem($other_item2));
        $this->assertTrue($merged_collection->containsItem($other_item3));
        $this->assertTrue($merged_collection->containsItem($other_item4));
        $this->assertTrue($merged_collection->containsItem($item5));
        $this->assertTrue($merged_collection->containsItem($item6));
        $this->assertFalse($merged_collection->containsItem($item1));
        $this->assertFalse($merged_collection->containsItem($item2));
        $this->assertFalse($merged_collection->containsItem($item3));
        $this->assertFalse($merged_collection->containsItem($item4));
        $this->assertSame($merged_collection->firstItem() , $other_item1);
        $this->assertSame($merged_collection->lastItem() , $item6);
        $this->assertEquals(
            $merged_collection->toArray() ,
            [ $other_item1, $other_item2, $other_item3, $other_item4, $item5, $item6 ]
        );
        
        // test original collection after the merge
        $this->assertFalse($collection->containsItem($other_item1));
        $this->assertFalse($collection->containsItem($other_item2));
        $this->assertFalse($collection->containsItem($other_item3));
        $this->assertFalse($collection->containsItem($other_item4));

        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertTrue($collection->containsItem($item5));
        $this->assertTrue($collection->containsItem($item6));
        $this->assertSame($collection->firstItem() , $item1);
        $this->assertSame($collection->lastItem() , $item6);
        $this->assertEquals(
            $collection->toArray() ,
            [ $item1, $item2, $item3, $item4, $item5, $item6 ]
        );
        
        $this->assertNotSame($collection, $merged_collection);
    }

    public function testThatMergeMeWithCollectionWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
                
        $other_item1 = "4";
        $other_item2 = 5.0;
        $other_item3 = 7;
        $other_item4 = true;
        $other_item5 = false;
        $other_item6 = tmpfile();
        $other_item7 = new \ArrayObject();
        $other_item8 = function(){ return 'Hello World!'; };
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4, 
            $other_item5, $other_item6, $other_item7, $other_item8
        ];
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // should generate exception since one or more item(s) 
        // not of type `TestValueObject` are present in $other_collection
        $collection->mergeMeWith($other_collection);
    }
    
    public function testThatMergeMeWithCollectionWorksAsExpected2() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4
        ];
        
        // $other_collection will completely overwrite the items in $collection
        // since they have the same number of items and keys
        
        $collection->mergeMeWith($other_collection);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertFalse($collection->containsItem($item1));
        $this->assertFalse($collection->containsItem($item2));
        $this->assertFalse($collection->containsItem($item3));
        $this->assertFalse($collection->containsItem($item4));
        $this->assertSame($collection->firstItem() , $other_item1);
        $this->assertSame($collection->lastItem() , $other_item4);
        $this->assertEquals(
            $collection->toArray() ,
            [ $other_item1, $other_item2, $other_item3, $other_item4, ]
        );
    }
    
    public function testThatMergeMeWithCollectionWorksAsExpected3() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        $item5 = new TestValueObject('Jane Fonda22', 1212);
        $item6 = new TestValueObject('Jane Fonda22', 21);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4, $item5, $item6
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        
        $other_collection = [
            $other_item1, $other_item2, $other_item3, $other_item4
        ];
        
        $collection->mergeMeWith($other_collection);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($item5));
        $this->assertTrue($collection->containsItem($item6));
        $this->assertFalse($collection->containsItem($item1));
        $this->assertFalse($collection->containsItem($item2));
        $this->assertFalse($collection->containsItem($item3));
        $this->assertFalse($collection->containsItem($item4));
        $this->assertSame($collection->firstItem() , $other_item1);
        $this->assertSame($collection->lastItem() , $item6);
        $this->assertEquals(
            $collection->toArray() ,
            [ $other_item1, $other_item2, $other_item3, $other_item4, $item5, $item6 ]
        );
    }

    public function testThatAppendItemWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
                
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $other_item1 = "4";
        $collection->appendItem($other_item1);
    }
    
    public function testThatAppendItemWorksAsExpected2() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
                
        $collection->appendItem($other_item1);
        $collection->appendItem($other_item2);
        $collection->appendItem($other_item3);
        $collection->appendItem($other_item4);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertSame($collection->firstItem() , $item1);
        $this->assertSame($collection->lastItem() , $other_item4);
        $this->assertEquals(
            $collection->toArray() ,
            [  $item1, $item2, $item3, $item4, $other_item1, $other_item2, $other_item3, $other_item4, ]
        );
        
        // test return $this 
        $this->assertSame($collection->appendItem($other_item1) , $collection);
    }
    
    public function testThatPushWorksAsExpected() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
                
        $collection->push($other_item1);
        $collection->push($other_item2);
        $collection->push($other_item3);
        $collection->push($other_item4);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertSame($collection->firstItem() , $item1);
        $this->assertSame($collection->lastItem() , $other_item4);
        $this->assertEquals(
            $collection->toArray() ,
            [  $item1, $item2, $item3, $item4, $other_item1, $other_item2, $other_item3, $other_item4, ]
        );
        
        // test return $this 
        $this->assertSame($collection->push($other_item1) , $collection);
    }

    public function testThatPrependItemWorksAsExpected() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
                
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        $other_item1 = "4";
        $collection->prependItem($other_item1);
    }

    public function testThatPrependItemWorksAsExpected2() {
                
        $collection = new \TestValueObjectsCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
                
        $this->expectException(\VersatileCollections\Exceptions\InvalidKeyException::class);
        $other_item1 = new TestValueObject('Joe Blow', 35);
        $collection->prependItem($other_item1, 3.0); // non-string & non-int key
    }
    
    public function testThatPrependItemWorksAsExpected3() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $collection = new \TestValueObjectsCollection(
            $item1, $item2, $item3, $item4
        );
                
        $other_item1 = new TestValueObject('Johnny Cash2', 502);
        $other_item2 = new TestValueObject('Suzzy Something2', 223);
        $other_item3 = new TestValueObject('Jack Bauer2', 423);
        $other_item4 = new TestValueObject('Jane Fonda2', 525);
        $other_item5 = new TestValueObject('Jane Fonda2', 525);
                
        $collection->prependItem($other_item1);
        $collection->prependItem($other_item2);
        $collection->prependItem($other_item3, 'custom_key');
        $collection->prependItem($other_item4);
        $collection->prependItem($other_item5);
        
        $this->assertTrue($collection->containsItem($other_item1));
        $this->assertTrue($collection->containsItem($other_item2));
        $this->assertTrue($collection->containsItem($other_item3));
        $this->assertTrue($collection->containsItem($other_item4));
        $this->assertTrue($collection->containsItem($other_item5));
        $this->assertTrue($collection->containsItem($item1));
        $this->assertTrue($collection->containsItem($item2));
        $this->assertTrue($collection->containsItem($item3));
        $this->assertTrue($collection->containsItem($item4));
        $this->assertSame($collection->firstItem(), $other_item5);
        $this->assertSame($collection->lastItem(), $item4);
        $this->assertEquals(
            $collection->toArray() ,
            [  $other_item5, $other_item4, 'custom_key'=>$other_item3, $other_item2, $other_item1, $item1, $item2, $item3, $item4, ]
        );
    }

    public function testUnionWithMe() {
        
        $item1 = new TestValueObject('Johnny Cash', 50);
        $item2 = new TestValueObject('Suzzy Something', 23);
        $item3 = new TestValueObject('Jack Bauer', 43);
        $item4 = new TestValueObject('Jane Fonda', 55);
        
        $item5 = new TestValueObject('John Doe', 25);
        $item6 = new TestValueObject('Sandra Green', 35);
                
        $initial_items = [ 
            'item1'=>$item1, 'item2'=>$item2, 'item3'=>$item3, 'item4'=>$item4,
        ];
        $other_items = [ 
            'item5'=>$item5, 'item6'=>$item6,
        ];
        
        $collection = \TestValueObjectsCollection::makeNew($initial_items);
        
        $this->assertEquals($initial_items, $collection->unionMeWith([])->toArray());
        
        $unioned_1 = $collection->unionMeWith($other_items);
        
        $this->assertEquals(
            [
                'item1'=>$item1, 'item2'=>$item2, 'item3'=>$item3, 
                'item4'=>$item4, 'item5'=>$item5, 'item6'=>$item6,
            ], 
            $unioned_1->toArray()
        );
        
        // test return $this
        $this->assertSame($unioned_1, $collection);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // Exception will occur when unioning with one or more items of the wrong type
        $collection->unionMeWith( ['item of wrong type', $item2, []] );
    }
}
