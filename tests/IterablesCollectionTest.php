<?php
declare(strict_types=1);
use \VersatileCollections\IterablesCollection;

/**
 * Description of IterablesCollection
 *
 * @author rotimi
 */
class IterablesCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatOnlyIterableObjectsCanBeInjectedIntoCollection() {
        
        $collection = new IterablesCollection(
                        new \ArrayObject(),
                        new \SplDoublyLinkedList(),
                        new \SplStack(),
                        new \SplQueue(),
                        new \SplMaxHeap(),
                        new \SplMinHeap(),
                        new \SplPriorityQueue(),
                        new \SplPriorityQueue(),
                        new \SplFixedArray(),
                        new \SplObjectStorage()
                    );
        $this->assertEquals($collection->count(), 10);
        
        $collection2 = IterablesCollection::makeNew([
                        new \ArrayObject(),
                        new \SplDoublyLinkedList(),
                        new \SplStack(),
                        new \SplQueue(),
                        new \SplMaxHeap(),
                        new \SplMinHeap(),
                        new \SplPriorityQueue(),
                        new \SplPriorityQueue(),
                        new \SplFixedArray(),
                        new \SplObjectStorage()
                    ]);
        $this->assertEquals($collection2->count(), 10);
        
        $collection3 = new \VersatileCollections\IterablesCollection();
        $this->assertEquals($collection3->count(), 0);
        $collection3[] = new \SplPriorityQueue();
        $collection3['r'] = new \SplObjectStorage();
        $collection3->x = new \SplFixedArray();
        $this->assertEquals($collection3->count(), 3);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        // line below should produce an exception since we are injecting
        // an iterable that is not an object
        $collection3[] = [];
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        // line below should produce an exception since we are injecting
        // an iterable that is not an object
        $collection3['item4'] = [];
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        // line below should produce an exception since we are injecting
        // an iterable that is not an object
        $collection3->item5 = [];
    }
}
