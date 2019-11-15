<?php
declare(strict_types=1);
/**
 * Description of SortTypeTest
 *
 * @author Rotimi Ade
 */
class SortTypeTest extends \PHPUnit\Framework\TestCase {
    
    protected function setUp(): void { 
        
        parent::setUp();
    }

    public function testThatConstructorWithValidSortTypeWorksAsExpected() {
        
        $sort_type = new \VersatileCollections\SortType();

        $this->assertTrue($sort_type->getSortType() === SORT_REGULAR);
        $this->assertTrue(
            in_array($sort_type->getSortType(), 
            \VersatileCollections\SortType::getValidSortTypes())
        );
        
        $sort_type = new \VersatileCollections\SortType(SORT_NATURAL);
        $this->assertTrue($sort_type->getSortType() === SORT_NATURAL);
        $this->assertTrue(in_array($sort_type->getSortType(), \VersatileCollections\SortType::getValidSortTypes()));
    }

    public function testThatConstructorWithInvalidSortTypeWorksAsExpected() {
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidSortType::class);
        $sort_type = new \VersatileCollections\SortType(777);
    }

    public function testThatGettersWorkAsExpected() {
        
        $sort_param = new \VersatileCollections\SortType(SORT_LOCALE_STRING);
        $this->assertTrue($sort_param->getSortType() === SORT_LOCALE_STRING);
        
        $sort_param = new \VersatileCollections\SortType(SORT_NUMERIC);
        $this->assertTrue($sort_param->getSortType() === SORT_NUMERIC);
    }

    public function testThatSettersWorkAsExpected() {
        
        $sort_param = new \VersatileCollections\SortType(SORT_LOCALE_STRING);
        $this->assertTrue($sort_param->getSortType() === SORT_LOCALE_STRING);
        
        $sort_param->setSortType(SORT_NUMERIC);
        $this->assertTrue($sort_param->getSortType() === SORT_NUMERIC);
        
        $this->expectException(\VersatileCollections\Exceptions\InvalidSortType::class);
        $sort_param->setSortType(777);
    }
}
