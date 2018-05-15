<?php
/**
 * Description of SortParametersTest
 *
 * @author aadegbam
 */
class MultiSortParametersTest extends \PHPUnit_Framework_TestCase {
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\MissingMultiSortParameterFieldName
     */
    public function testThatConstructorWithFieldNameEmptyStringWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('');
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidMultiSortParameter
     */
    public function testThatConstructorWithNonStringFieldNameWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters([]);
    }

    public function testThatConstructorWithStringFieldNameAndNoOtherArgsWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('joe');

        $this->assertTrue($sort_param->getFieldName() === 'joe');
        $this->assertTrue($sort_param->getSortDirection() === SORT_ASC);
        $this->assertTrue($sort_param->getSortType() === SORT_REGULAR);
        $this->assertTrue(in_array($sort_param->getSortDirection(), \VersatileCollections\MultiSortParameters::getValidSortDirections()));
        $this->assertTrue(in_array($sort_param->getSortType(), \VersatileCollections\MultiSortParameters::getValidSortTypes()));
    }

    public function testThatConstructorWithStringFieldNameAndAllOtherArgsWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('joe2', SORT_DESC, SORT_STRING);

        $this->assertTrue($sort_param->getFieldName() === 'joe2');
        $this->assertTrue($sort_param->getSortDirection() === SORT_DESC);
        $this->assertTrue($sort_param->getSortType() === SORT_STRING);
        $this->assertTrue(in_array($sort_param->getSortDirection(), \VersatileCollections\MultiSortParameters::getValidSortDirections()));
        $this->assertTrue(in_array($sort_param->getSortType(), \VersatileCollections\MultiSortParameters::getValidSortTypes()));
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidMultiSortParameter
     */
    public function testThatConstructorWithStringFieldNameAndInvalidSortTypeWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('Jack', SORT_DESC, new ArrayObject() );
    }
    
    /**
     * @expectedException \VersatileCollections\Exceptions\InvalidMultiSortParameter
     */
    public function testThatConstructorWithStringFieldNameAndInvalidSortDirectionWorksAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('Jack', new ArrayObject() );
    }
    
    public function testThatSettersWorkAsExpected() {
        
        $sort_param = new \VersatileCollections\MultiSortParameters('joe2', SORT_ASC, SORT_LOCALE_STRING);

        $this->assertTrue($sort_param->getFieldName() === 'joe2');
        $this->assertTrue($sort_param->getSortDirection() === SORT_ASC);
        $this->assertTrue($sort_param->getSortType() === SORT_LOCALE_STRING);
        
        $sort_param->setFieldName('joe22');
        $sort_param->setSortDirection(SORT_DESC);
        $sort_param->setSortType(SORT_NUMERIC);
        
        $this->assertTrue($sort_param->getFieldName() === 'joe22');
        $this->assertTrue($sort_param->getSortDirection() === SORT_DESC);
        $this->assertTrue($sort_param->getSortType() === SORT_NUMERIC);
    }
}
