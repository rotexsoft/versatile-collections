<?php

use function VersatileCollections\random_array_key;
use function VersatileCollections\random_array_keys;

class HelperFunctionsTest extends \PHPUnit_Framework_TestCase {
    
    
    protected function setUp() { 
        
        parent::setUp();
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThat_random_array_key_WorksAsExpected() {
        
        $array = ['blue', 'red', 'green', 'a'=>'red', 1, 'b' => 'blue', '2'];
        
        $random_key1 = random_array_key($array);
        $random_key2 = random_array_key($array);
        $random_key3 = random_array_key($array);
        $random_key4 = random_array_key($array);
        $random_key5 = random_array_key($array);
        $random_key6 = random_array_key($array);
        $random_key7 = random_array_key($array);
        
        $this->assertTrue( array_key_exists($random_key1, $array) );
        $this->assertTrue( array_key_exists($random_key2, $array) );
        $this->assertTrue( array_key_exists($random_key3, $array) );
        $this->assertTrue( array_key_exists($random_key4, $array) );
        $this->assertTrue( array_key_exists($random_key5, $array) );
        $this->assertTrue( array_key_exists($random_key6, $array) );
        $this->assertTrue( array_key_exists($random_key7, $array) );
        
        $all_random_keys_equal =
            $random_key1 === $random_key2
            && $random_key1 === $random_key3
            && $random_key1 === $random_key4
            && $random_key1 === $random_key5
            && $random_key1 === $random_key6
            && $random_key1 === $random_key7;
        
        $this->assertFalse($all_random_keys_equal);

        // Should throw a \LengthException. 
        // Can't get a random key from an empty array.
        random_array_key([]);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThat_random_array_keys_WorksAsExpected() {
        
        $array = ['blue', 'red', 'green', 'a'=>'red', 1, 'b' => 'blue', '2'];
        
        // default 1 key
        $this->assertTrue( count( random_array_keys($array) ) === 1 );
        
        $random_keys1 = random_array_keys($array, 4);
        $random_keys2 = random_array_keys($array, 4);
        $random_keys3 = random_array_keys($array, 4);
        $random_keys4 = random_array_keys($array, 6);
        
        $this->assertTrue( is_array($random_keys1)  );
        $this->assertTrue( is_array($random_keys2)  );
        $this->assertTrue( is_array($random_keys3)  );
        $this->assertTrue( is_array($random_keys4)  );
        
        $this->assertTrue( count($random_keys1) === 4 );
        $this->assertTrue( count($random_keys2) === 4 );
        $this->assertTrue( count($random_keys3) === 4 );
        $this->assertTrue( count($random_keys4) === 6 );
        
        array_walk(
            $random_keys1,
            function($current_item, $current_key) use (&$array) {
            
                $this->assertArrayHasKey($current_item, $array);
            }
        );
        
        array_walk(
            $random_keys2,
            function($current_item, $current_key) use (&$array) {
            
                $this->assertArrayHasKey($current_item, $array);
            }
        );
        
        array_walk(
            $random_keys3,
            function($current_item, $current_key) use (&$array) {
            
                $this->assertArrayHasKey($current_item, $array);
            }
        );
        
        array_walk(
            $random_keys4,
            function($current_item, $current_key) use (&$array) {
            
                $this->assertArrayHasKey($current_item, $array);
            }
        );
                
        $all_random_keys_collections_of_same_length_are_equal =
            $random_keys1 === $random_keys2
            && $random_keys1 === $random_keys3;
        
        $this->assertFalse($all_random_keys_collections_of_same_length_are_equal);

        // Should throw a \LengthException. 
        // Can't get a random keys from an empty collection.
        random_array_keys([]);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_random_array_keys_WorksAsExpected2() {
        
        random_array_keys([1, 2], "Invalid Length Data Type");
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_random_array_keys_WorksAsExpected3() {
        
        // requesting more random keys than array size
        random_array_keys([1, 2], 5);
    }
    
    /**
     * @expectedException \LengthException
     */
    public function testThat_random_array_keys_WorksAsExpected4() {
        
        // requesting random keys from an empty array
        random_array_keys([], 5);
    }
    
}
