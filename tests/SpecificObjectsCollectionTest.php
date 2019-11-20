<?php
declare(strict_types=1);
/**
 * Description of ScalarsCollectionTest
 *
 * @author Rotimi Ade
 */
class SpecificObjectsCollectionTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatProtectedConstructorCannotBeInvokedFromOutside() {

        try {
            $class_name = \VersatileCollections\SpecificObjectsCollection::class;
            $collection = new $class_name();
            $this->assertTrue(false); // force test to fail if line above did not throw Error

        } catch (\Throwable $e) {

            $this->assertStringContainsString(
                'Call to protected VersatileCollections\SpecificObjectsCollection::__construct()',
                $e->getMessage()
            );
        }
        
//        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
//        $collection->item1 = "4";
//        $collection->item2 = 5.0;
//        $collection->item3 = 7;
//        $collection->item4 = true;
//        $collection->item5 = false;
//
//        $collection = new \VersatileCollections\ScalarsCollection(
//            "4", 5.0, 7, true, false, '6', '7'
//        );
        
        //$this->assertEquals($collection->count(), 7);
        //$this->expectException(\VersatileCollections\Exceptions\InvalidItemException::class);
        
        // line below should produce an exception since we are injecting
        // a non-scalar
//        $collection->item5 = [];
    }
    
//    public function testThatUniqueNonStrictWorksAsExpected() {
//
//    }
}
