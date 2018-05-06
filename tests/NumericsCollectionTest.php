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
        
        $int_collection = new \VersatileCollections\IntCollection(
            8, 9, 10, 11
        );
        
        // append a sub-class collection
        $numeric_collection->merge($int_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8, 9, 10, 11, 5, 6, ]
        );
        
        $float_collection = new \VersatileCollections\FloatCollection(
            8.5, 9.7, 10.8, 11.9
        );
        
        // append another sub-class collection
        $numeric_collection->merge($float_collection);

        $this->assertEquals(
            $numeric_collection->toArray() ,
            [ 8.5, 9.7, 10.8, 11.9, 5, 6, ]
        );
    } 
}
