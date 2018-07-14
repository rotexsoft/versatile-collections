<?php
/**
 * Description of ScalarsCollectionTest
 *
 * @author aadegbam
 */
class ScalarsCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyScalarsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\ScalarsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = "4";
        $collection->item2 = 5.0;
        $collection->item3 = 7;
        $collection->item4 = true;
        $collection->item5 = false;
        
        $collection = new \VersatileCollections\ScalarsCollection(
            "4", 5.0, 7, true, false, '6', '7'
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-scalar
        $collection->item5 = [];
    }
    
    public function testThatUniqueNonStrictWorksAsExpected() {
        
        $collection = new \VersatileCollections\ScalarsCollection();
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
        
        $this->assertSame(\VersatileCollections\ScalarsCollection::makeNew()->uniqueNonStrict()->toArray(), []);
        $this->assertEquals($collection->uniqueNonStrict()->toArray(), ['4', 5.0, 7, false, 'true', 'false']);
    }
}
