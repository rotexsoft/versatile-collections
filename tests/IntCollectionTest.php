<?php
/**
 * Description of IntCollectionTest
 *
 * @author aadegbam
 */
class IntCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyIntsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\IntCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = 4;
        $collection->item2 = 5;
        $collection->item3 = 7;
        $collection->item4 = 9;
        
        $collection = new \VersatileCollections\IntCollection(
            1, 2, 3, 4, 5, 6, 7
        );
        
        $this->assertEquals($collection->count(), 7);
        
        // line below should produce an exception since we are injecting
        // a non-int
        $collection->item5 = 'boo';
    }
    
    public function testThatItemFromStringWorksAsExpected() {
        
        $collection = new \TestIntCollection();
        
        $this->assertSame($collection->getItemFromString('4'), 4);
        $this->assertSame($collection->getItemFromString('7'), 7);
        $this->assertSame($collection->getItemFromString('-7'), -7);
    }
    
    public function testThatItemToStringWorksAsExpected() {
        
        $collection = new \TestIntCollection();
        
        $this->assertSame($collection->getItemAsString(4), '4');
        $this->assertSame($collection->getItemAsString(7), '7');
        $this->assertSame($collection->getItemAsString(-7), '-7');
    }
}
