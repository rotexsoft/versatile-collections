<?php
declare(strict_types=1);
/**
 * Description of StringsCollectionTest
 *
 * @author aadegbam
 */
class StringsCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatOnlyStringsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\StringsCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = "4";
        $collection->item2 = '5';
        $collection->item3 = '7';
        $collection->item4 = '9';
        
        $collection = new \VersatileCollections\StringsCollection(
            '1', '2', '3', '4', '5', '6', '7'
        );
        
        $this->assertEquals($collection->count(), 7);
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-string
        $collection->item5 = [];
    }
}
