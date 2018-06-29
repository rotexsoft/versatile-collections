<?php
/**
 * Description of NumericsCollectionTest
 *
 * @author aadegbam
 */
class NumericsCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    public function testThatAverageWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0,3, 4, 5, 6
        );
        
        $this->assertEquals($collection->average(), 3.5);
        
        $collection = new \VersatileCollections\NumericsCollection(
            1, 2, 3, 4, 5
        );
        
        $this->assertEquals($collection->average(), 3.0);
    }
    
    public function testThatMaxWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10
        );
        
        $this->assertEquals($collection->max(), 10);
        
        $collection = new \VersatileCollections\NumericsCollection(
            3, 5.0, 7, 8, 9, 10.5
        );
        
        $this->assertEquals($collection->max(), 10.5);
    }
    
    public function testThatMedianWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        $this->assertNull($collection->median());
        
        // 6 items, average of the sum of the items at index 2 and 
        // index 3 is the median value when items in collection are
        //sorted in ascending numeric order
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10
        );
        $this->assertEquals($collection->median(), 7.5);
        
        // 6 items, average of the sum of the items at index 2 and 
        // index 3 is the median value when items in collection are
        //sorted in ascending numeric order
        $collection = new \VersatileCollections\NumericsCollection(
            8, 9, 10, 4.0, 5.0, 7
        );
        $this->assertEquals($collection->median(), 7.5);
        
        // 7 items, item at index 3 is the median value when
        // items in collection are sorted in ascending numeric order
        $collection = new \VersatileCollections\NumericsCollection(
            3, 5.0, 7, 8, 9, 10.5, 20
        );
        $this->assertEquals($collection->median(), 8);
        
        // 7 items, item at index 3 is the median value when
        // items in collection are sorted in ascending numeric order
        $collection = new \VersatileCollections\NumericsCollection(
            20, 3, 5.0, 7, 8, 9, 10.5
        );
        $this->assertEquals($collection->median(), 8);
    }
    
    public function testThatMinWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10
        );
        
        $this->assertEquals($collection->min(), 4.0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            3, 5.0, 7, 8, 9, 10.5
        );
        
        $this->assertEquals($collection->min(), 3.0);
    }
    
    public function testThatModeWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertSame($collection->count(), 0);
        $this->assertNull($collection->mode());
        
        $collection = new \VersatileCollections\NumericsCollection(
            0, 0, 2, 4
        );
        $this->assertSame($collection->mode(), [0] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            0, -0, 0, 0, 2, 4
        );
        $this->assertSame($collection->mode(), [0] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            1, 1, 2, 4
        );
        $this->assertSame($collection->mode(), [1] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            -1, 1, -20, 4
        );
        $this->assertSame($collection->mode(), [-1, 1, -20, 4] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            -1, 1, -20, 4, -1
        );
        $this->assertSame($collection->mode(), [-1] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10
        );
        $this->assertSame($collection->mode(), [4, 5, 7, 8, 9, 10] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            3, 5.0, 7, 8, 9, 10.5
        );
        $this->assertSame($collection->mode(), [3, 5, 7, 8, 9, 10.5] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            10.5, 9, 8, 7, 5.0, 3
        );
        $this->assertSame($collection->mode(), [10.5, 9, 8, 7, 5, 3] );
        
        $collection = new \VersatileCollections\NumericsCollection(
            10.5, 9, 8, 7, 5.0, 3, 10.5, 3
        );
        $this->assertSame($collection->mode(), [10.5, 3] );
    }
    
    public function testThatProductWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertSame($collection->product(), 1);
        
        $collection = new \VersatileCollections\NumericsCollection(100, 2.5);
        $this->assertSame($collection->product(), 250.0);
        
        $collection = new \VersatileCollections\NumericsCollection(3.5, 2.5);
        $this->assertSame($collection->product(), 8.75);
        
        $collection = new \VersatileCollections\NumericsCollection(3, 2);
        $this->assertSame($collection->product(), 6);
        

    }
    
    public function testThatSumWorksAsExpected() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10
        );
        
        $this->assertEquals($collection->sum(), 43.0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10.5
        );
        
        $this->assertEquals($collection->sum(), 43.5);
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyNumericsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = 4.0;
        $collection->item2 = 5.0;
        $collection->item3 = 7;
        $collection->item4 = 8;
        $collection->item5 = 9;
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10, 11
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-numeric scalar
        $collection->item5 = true;
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyNumericsCanBeInjectedIntoCollection2() {
        
        $collection = new \VersatileCollections\NumericsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        $collection = new \VersatileCollections\NumericsCollection(
            4.0, 5.0, 7, 8, 9, 10, 11
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-numeric scalar
        $collection->item5 = 'true';
    }

    public function testThatAppendCollectionWorksAsExpected() {
        
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );
        
        $int_collection = new \VersatileCollections\IntCollection(
            8, 9, 10, 11
        );
        
        // append a sub-class collection
        $numeric_collection->appendCollection($int_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [1.0, 2.0, 3, 4, 5, 6, 8, 9, 10, 11 ]
        );
        
        $float_collection = new \VersatileCollections\FloatCollection(
            8.5, 9.7, 10.8, 11.9
        );
        
        // append another sub-class collection
        $numeric_collection->appendCollection($float_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [1.0, 2.0, 3, 4, 5, 6, 8, 9, 10, 11, 8.5, 9.7, 10.8, 11.9 ]
        );
    }
    
    public function testThatPrependCollectionWorksAsExpected() {
        
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );
        
        $int_collection = new \VersatileCollections\IntCollection(
            8, 9, 10, 11
        );
        
        // append a sub-class collection
        $numeric_collection->prependCollection($int_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8, 9, 10, 11, 1.0, 2.0, 3, 4, 5, 6 ]
        );
        
        $float_collection = new \VersatileCollections\FloatCollection(
            8.5, 9.7, 10.8, 11.9
        );
        
        // append another sub-class collection
        $numeric_collection->prependCollection($float_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8.5, 9.7, 10.8, 11.9, 8, 9, 10, 11, 1.0, 2.0, 3, 4, 5, 6 ]
        );
    }
    
    public function testThatMergeCollectionWorksAsExpected() {
        
        $numeric_collection = new \VersatileCollections\NumericsCollection(
            1.0, 2.0, 3, 4, 5, 6
        );
        
        $int_collection = [
            8, 9, 10, 11
        ];
        
        // append a sub-class collection
        $numeric_collection = 
            $numeric_collection->mergeWith($int_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8, 9, 10, 11, 5, 6, ]
        );
        
        $float_collection = [
            8.5, 9.7, 10.8, 11.9
        ];
        
        // append another sub-class collection
        $numeric_collection =
            $numeric_collection->mergeWith($float_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8.5, 9.7, 10.8, 11.9, 5, 6, ]
        );
    }
    
    public function testThatItemFromStringWorksAsExpected() {
        
        $collection = new \TestNumericsCollection();
        
        $this->assertSame($collection->getItemFromString('4.0'), 4.0);
        $this->assertSame($collection->getItemFromString('7.777'), 7.777);
        $this->assertSame($collection->getItemFromString('-7.777'), -7.777);
        
        $this->assertSame($collection->getItemFromString('4'), 4);
        $this->assertSame($collection->getItemFromString('7'), 7);
        $this->assertSame($collection->getItemFromString('-7'), -7);
    }
    
    public function testThatItemToStringWorksAsExpected() {
        
        $collection = new \TestNumericsCollection();
        
        $this->assertSame($collection->getItemAsString(4.0), '4');
        $this->assertSame($collection->getItemAsString(7.777), '7.777');
        $this->assertSame($collection->getItemAsString(-7.777), '-7.777');
        
        $this->assertSame($collection->getItemAsString(4), '4');
        $this->assertSame($collection->getItemAsString(7), '7');
        $this->assertSame($collection->getItemAsString(-7), '-7');
    }
}
