<?php
declare(strict_types=1);
/**
 * Description of ArraysCollectionTest
 *
 * @author Rotimi Ade
 */
class ArraysCollectionTest extends \PHPUnit\Framework\TestCase{
    
    protected function setUp(): void { 
        
        parent::setUp();
    }
    
    /**
     * 
     */
    public function testThatOnlyArraysCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\ArraysCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting arrays
        $collection->item1 = ['boo'];
        $collection->item2 = ['strtolower'];
        $collection->item3 = ['a'=>\DateTime::class, 'b'=>'getLastErrors'];
        $collection->item4 = [\DateTime::class, 'createFromFormat'];
        
        $collection = new \VersatileCollections\ArraysCollection(
            ['boo'],
            ['strtolower'],
            ['a'=>\DateTime::class, 'b'=>'getLastErrors'],
            [\DateTime::class, 'createFromFormat']
        );
        
        $this->assertEquals($collection->count(), 4);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-array
        $collection->item5 = 'non-array';
    }
}
