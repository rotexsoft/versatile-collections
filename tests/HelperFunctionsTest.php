<?php

use function VersatileCollections\random_array_key;
use function VersatileCollections\random_array_keys;
use function VersatileCollections\object_has_property;
use function VersatileCollections\get_object_property_value;

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
    
    public function testThat_object_has_property_WorksAsExpected() {
        
        // Object implementing ArrayAccess
        $obj_arr_access = 
            \VersatileCollections\GenericCollection::makeNew(
                ['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]
            );
        
        // Object with __get, __isset & __set and some real public, protected 
        // and private properties
        $obj_magic_methods_and_real_props = 
            (new TestValueObject())
                ->setData(['id'=>17, 777 =>67, 'edition'=>2, 'title'=>"Boo"]);
        
        // StdClass Objects without __get, __isset & __set
        $obj_without_magic_methods = 
            (object)['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
        
        $this->assertTrue( object_has_property($obj_arr_access, 777) ); // int property
        $this->assertTrue( object_has_property($obj_arr_access, 'id') ); // string property
        $this->assertTrue( object_has_property($obj_arr_access, 'edition') ); // string property
        $this->assertTrue( object_has_property($obj_arr_access, 'title') ); // string property
        $this->assertFalse( object_has_property($obj_arr_access, 1000) ); // int property
        $this->assertFalse( object_has_property($obj_arr_access, 'title2') ); // string property
        
        $this->assertTrue( object_has_property($obj_magic_methods_and_real_props, 777) ); // int property
        $this->assertTrue( object_has_property($obj_magic_methods_and_real_props, 'id') ); // string property
        $this->assertTrue( object_has_property($obj_magic_methods_and_real_props, 'edition') ); // string property
        $this->assertTrue( object_has_property($obj_magic_methods_and_real_props, 'title') ); // string property
        $this->assertFalse( object_has_property($obj_magic_methods_and_real_props, 1000) ); // int property
        $this->assertFalse( object_has_property($obj_magic_methods_and_real_props, 'title2') ); // string property
        
        $this->assertTrue( object_has_property($obj_without_magic_methods, 777) ); // int property
        $this->assertTrue( object_has_property($obj_without_magic_methods, 'id') ); // string property
        $this->assertTrue( object_has_property($obj_without_magic_methods, 'edition') ); // string property
        $this->assertTrue( object_has_property($obj_without_magic_methods, 'title') ); // string property
        $this->assertFalse( object_has_property($obj_without_magic_methods, 1000) ); // int property
        $this->assertFalse( object_has_property($obj_without_magic_methods, 'title2') ); // string property
        
        $obj_real_and_dynamic_props_and_no_magic_methods = new TestValueObject2('John Doe', 47);
        $obj_real_and_dynamic_props_and_no_magic_methods->dynamic_property1 = 'dynamic_property1';
        $obj_real_and_dynamic_props_and_no_magic_methods->dynamic_property2 = 'dynamic_property2';
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'name') ); // public property
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'age') ); // public property
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'protected_field') ); // protected property
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'private_field') ); // private property
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'dynamic_property1') ); // dynamically assigned property
        $this->assertTrue( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'dynamic_property2') ); // dynamically assigned property
        $this->assertFalse( object_has_property($obj_real_and_dynamic_props_and_no_magic_methods, 'non_existent_property') ); // non-existent property
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_object_has_property_WithNonObjectFirstArgWorksAsExpected() {
        
        object_has_property([], 'id');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_object_has_property_WithNonStringNonIntSecondArgWorksAsExpected() {
        
        object_has_property((new stdClass()), []);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_object_has_property_WithNonObjectFirstArgAndNonStringNonIntSecondArgWorksAsExpected() {
        
        object_has_property([], []);
    }
    
    public function testThat_get_object_property_value_WorksAsExpected() {
        
        // Object implementing ArrayAccess
        $obj_arr_access = 
            \VersatileCollections\GenericCollection::makeNew(
                ['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"]
            );
        
        // Object with __get, __isset & __set and some real public, protected 
        // and private properties
        $obj_magic_methods_and_real_props = 
            (new TestValueObject())
                ->setData(['id'=>17, 777 =>67, 'edition'=>2, 'title'=>"Boo"]);
        
        // Object without __get, __isset & __set and some real public, protected 
        // and private properties
        $obj_real_and_dynamic_props_and_no_magic_methods = new TestValueObject2('John Doe', 47);
        $obj_real_and_dynamic_props_and_no_magic_methods->dynamic_property1 = 'dynamic_property1';
        $obj_real_and_dynamic_props_and_no_magic_methods->dynamic_property2 = 'dynamic_property2';
        
        // StdClass Objects without __get, __isset & __set
        $obj_without_magic_methods = 
            (object)['id' => 17, 777 => 67, 'edition' => 2, 'title'=>"Boo"];
        
        $this->assertSame( get_object_property_value($obj_arr_access, 777), 67 ); // int property
        $this->assertSame( get_object_property_value($obj_arr_access, 'id'), 17 ); // string property
        $this->assertSame( get_object_property_value($obj_arr_access, 'edition'), 2 ); // string property
        $this->assertSame( get_object_property_value($obj_arr_access, 'title'), "Boo" ); // string property
        $this->assertSame( get_object_property_value($obj_arr_access, 1000, -777), -777 ); // int property
        $this->assertSame( get_object_property_value($obj_arr_access, 'title2', -777), -777 ); // string property
        
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 777), 67 ); // int property
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 'id'), 17 ); // string property
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 'edition'), 2 ); // string property
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 'title'), "Boo" ); // string property
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 1000, -777), -777 ); // int property
        $this->assertSame( get_object_property_value($obj_magic_methods_and_real_props, 'title2', -777), -777 ); // string property
        
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 777), 67 ); // int property
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 'id'), 17 ); // string property
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 'edition'), 2 ); // string property
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 'title'), "Boo" ); // string property
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 1000, -777), -777 ); // int property
        $this->assertSame( get_object_property_value($obj_without_magic_methods, 'title2', -777), -777 ); // string property
        
        // public, private and protected property and dynamically assigned property
        // access check
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'name'), 'John Doe' ); // public property
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'age'), 47 ); // public property
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'protected_field', null, true), 'protected_field' ); // protected property
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'private_field', null, true), 'private_field' ); // private property
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'dynamic_property1'), 'dynamic_property1' ); // dynamically assigned property
        $this->assertSame( get_object_property_value($obj_real_and_dynamic_props_and_no_magic_methods, 'dynamic_property2'), 'dynamic_property2' ); // dynamically assigned property
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testThatNonIntendedProtectedPropertyAccessVia_get_object_property_value_WorksAsExpected() {
        
        $obj_protected_and_private_props_and_no_magic_methods = new TestValueObject2('John Doe', 47);
        
        // accessing the protected property without passing true as the fourth
        // argument to get_object_property_value() below should throw an exception
        get_object_property_value($obj_protected_and_private_props_and_no_magic_methods, 'protected_field');
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testThatNonIntendedPrivatePropertyAccessVia_get_object_property_value_WorksAsExpected() {
        
        $obj_protected_and_private_props_and_no_magic_methods = new TestValueObject2('John Doe', 47);
        
        // accessing the private property without passing true as the fourth
        // argument to get_object_property_value() below should throw an exception
        get_object_property_value($obj_protected_and_private_props_and_no_magic_methods, 'private_field');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_get_object_property_value_WithNonObjectFirstArgWorksAsExpected() {
        
        get_object_property_value([], 'id');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_get_object_property_value_WithNonStringNonIntSecondArgWorksAsExpected() {
        
        get_object_property_value((new stdClass()), []);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThat_get_object_property_value_WithNonObjectFirstArgAndNonStringNonIntSecondArgWorksAsExpected() {
        
        get_object_property_value([], []);
    }
    
    public function test_dump_var() {

        $result = $this->execFuncAndReturnBufferedOutput(
            "\\VersatileCollections\\dump_var", [['Hello World!', 'Boo']]
        );
        
        $this->assertContains('Hello World!', $result);
        $this->assertContains('Boo', $result);
    }
    
    protected function execFuncAndReturnBufferedOutput(callable $func, array $args=[]) {
        
        // Capture the output
        ob_start();
        
        call_user_func_array($func, $args);
        
        // Get the captured output and close the buffer and return the captured output
        return ob_get_clean();
    }
}
