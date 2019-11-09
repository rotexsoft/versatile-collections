<?php
/**
 * Description of FloatsCollectionTest
 *
 * @author aadegbam
 */
class FloatsCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatOnlyFloatsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\FloatsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = 4.0;
        $collection->item2 = 5.0;
        $collection->item3 = 7.7;
        $collection->item4 = 9.9;
        
        $collection = new \VersatileCollections\FloatsCollection(
            1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0
        );
        
        $this->assertEquals($collection->count(), 7);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-float
        $collection->item5 = 'boo';
    }
    
    public function testThatItemFromStringWorksAsExpected() {
        
        $collection = new \TestFloatsCollection();
        
        $this->assertSame($collection->getItemFromString('4.0'), 4.0);
        $this->assertSame($collection->getItemFromString('7.777'), 7.777);
        $this->assertSame($collection->getItemFromString('-7.777'), -7.777);
    }
    
    public function testThatItemToStringWorksAsExpected() {
        
        $collection = new \TestFloatsCollection();
        
        $this->assertSame($collection->getItemAsString(4.0), '4');
        $this->assertSame($collection->getItemAsString(7.777), '7.777');
        $this->assertSame($collection->getItemAsString(-7.777), '-7.777');
    }
}
