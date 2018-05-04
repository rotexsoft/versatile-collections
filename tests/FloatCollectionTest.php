<?php
/**
 * Description of FloatCollectionTest
 *
 * @author aadegbam
 */
class FloatCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyFloatsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\FloatCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = 4.0;
        $collection->item2 = 5.0;
        $collection->item3 = 7.7;
        $collection->item4 = 9.9;
        
        $collection = new \VersatileCollections\FloatCollection(
            1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-float
        $collection->item5 = 'boo';
    }
}
