<?php
declare(strict_types=1);
/**
 * Description of ResourcesCollectionTest
 *
 * @author Rotimi Ade
 */
class ResourcesCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatOnlyResourcesCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\ResourcesCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting resources
        $collection->item1 = tmpfile();
        $collection->item2 = tmpfile();
        $collection->item3 = tmpfile();
        $collection->item4 = tmpfile();
        
        $collection = new \VersatileCollections\ResourcesCollection(
            $collection->item1, $collection->item2, $collection->item3, $collection->item4
        );
        
        $this->assertEquals($collection->count(), 4);
        
        foreach ($collection as $item) {
            
            fclose($item); // clean-up
        }
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        // line below should produce an exception since we are injecting
        // a non-resource
        $collection->item5 = [];
    }
}
