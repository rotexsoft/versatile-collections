<?php
declare(strict_types=1);
/**
 * Description of IntsCollectionTest
 *
 * @author aadegbam
 */
class IntsCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatOnlyIntsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\IntsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = 4;
        $collection->item2 = 5;
        $collection->item3 = 7;
        $collection->item4 = 9;
        
        $collection = new \VersatileCollections\IntsCollection(
            1, 2, 3, 4, 5, 6, 7
        );
        
        $this->assertEquals($collection->count(), 7);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        // line below should produce an exception since we are injecting
        // a non-int
        $collection->item5 = 'boo';
    }
    
    public function testThatItemFromStringWorksAsExpected() {
        
        $collection = new \TestIntsCollection();
        
        $this->assertSame($collection->getItemFromString('4'), 4);
        $this->assertSame($collection->getItemFromString('7'), 7);
        $this->assertSame($collection->getItemFromString('-7'), -7);
    }
    
    public function testThatItemToStringWorksAsExpected() {
        
        $collection = new \TestIntsCollection();
        
        $this->assertSame($collection->getItemAsString(4), '4');
        $this->assertSame($collection->getItemAsString(7), '7');
        $this->assertSame($collection->getItemAsString(-7), '-7');
    }
}
