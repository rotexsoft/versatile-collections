<?php
/**
 * Description of StringCollectionTest
 *
 * @author aadegbam
 */
class StringCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyStringsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\StringCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = "4";
        $collection->item2 = '5';
        $collection->item3 = '7';
        $collection->item4 = '9';
        
        $collection = new \VersatileCollections\StringCollection(
            '1', '2', '3', '4', '5', '6', '7'
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-string
        $collection->item5 = [];
    }
}
