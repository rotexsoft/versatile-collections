<?php
/**
 * Description of CallablesCollectionTest
 *
 * @author aadegbam
 */
class CallablesCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyCallablesCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\CallablesCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting callables
        $collection->item1 = function() {
            return 'boo';
        };
        $collection->item2 = 'strtolower';
        $collection->item3 = [\DateTime::class, 'getLastErrors'];
        $collection->item4 = [\DateTime::class, 'createFromFormat'];
        
        
        $collection = new \VersatileCollections\CallablesCollection(
            function() { return 'boo'; },
            'strtolower',
            [\DateTime::class, 'getLastErrors'],
            [\DateTime::class, 'createFromFormat']
        );
        
        $this->assertEquals($collection->count(), 4);
        
        // line below should produce an exception since we are injecting
        // a non-callable
        $collection->item5 = [];
    }
}
