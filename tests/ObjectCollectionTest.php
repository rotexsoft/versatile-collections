<?php
/**
 * Description of ObjectCollectionTest
 *
 * @author aadegbam
 */
class ObjectCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyObjectsCanBeInjectedIntoCollection() {
        
        $collection = new \VersatileCollections\ObjectCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = new stdClass();
        $collection->item2 = new DateTime('2000-01-01');
        $collection->item3 = new \PDO(
                                'sqlite::memory:', 
                                null, 
                                null, 
                                [
                                    PDO::ATTR_PERSISTENT => true, 
                                    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                                ]
                            );
        $collection->item4 = new ArrayObject();
        
        $collection = new \VersatileCollections\ObjectCollection(
            $collection->item1, $collection->item2, $collection->item3, $collection->item4
        );
        
        $this->assertEquals($collection->count(), 4);
        
        // line below should produce an exception since we are injecting
        // a non-string
        $collection->item5 = [];
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidCollectionOperationException
     */
    public function testThat__CallWorksAsExpected() {
        
        $collection = new \VersatileCollections\ObjectCollection();
        
        $this->assertEquals($collection->count(), 0);
        
        // lines below should produce no exception since we are injecting floats
        $collection->item1 = new TestValueObject('Johnny Cash', 50);
        $collection->item2 = new TestValueObject('Suzzy Something', 23);
        $collection->item3 = new TestValueObject('Jack Bauer', 43);
        $collection->item4 = new TestValueObject('Jane Fonda', 55);
        
        $this->assertEquals($collection->count(), 4);
        
        $ages = $collection->getAge();
        $this->assertEquals($ages, ['item1' => 50, 'item2' => 23, 'item3' => 43, 'item4' => 55]);
        
        $collection->setAge(99);
        $ages = $collection->getAge();
        $this->assertEquals($ages, ['item1' => 99, 'item2' => 99, 'item3' => 99, 'item4' => 99]);
        
        $collection->nonExistentMethod();
    }
}
