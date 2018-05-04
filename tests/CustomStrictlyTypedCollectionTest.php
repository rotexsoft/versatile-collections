<?php
/**
 * Description of CustomStrictlyTypedCollectionTest
 *
 * @author aadegbam
 */
class CustomStrictlyTypedCollectionTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection() {
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );

        $this->assertEquals($collection->count(), 4);
        
        $collection->item1 = new TestValueObject('Johnny Cash', 509);
        $collection->item2 = new TestValueObject('Suzzy Something', 239);
        $collection->item3 = new TestValueObject('Jack Bauer', 439);
        $collection->item4 = new TestValueObject('Jane Fonda', 559);
        
        $collection[] = new TestValueObject('Johnny Cash', 1509);
        $collection[] = new TestValueObject('Suzzy Something', 1239);
        $collection[] = new TestValueObject('Jack Bauer', 1439);
        $collection[] = new TestValueObject('Jane Fonda', 1559);
        
        $this->assertEquals($collection->count(), 12);
        // var_dump($collection->toArray());
        // line below should produce an exception since we are injecting
        // a non-object
        $collection->item5 = [];
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection2() {
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        // line below should produce an exception since we are injecting
        // a non-object
        $collection[] = [];
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidItemException
     */
    public function testThatOnlyTestValueObjectsCanBeInjectedIntoCollection3() {
        
        $collection = new \TestValueObjectCollection(
            new TestValueObject('Johnny Cash', 50),
            new TestValueObject('Suzzy Something', 23),
            new TestValueObject('Jack Bauer', 43),
            new TestValueObject('Jane Fonda', 55)
        );
        // line below should produce an exception since we are injecting
        // a non-object
        $collection['item5'] = [];
    }
}
