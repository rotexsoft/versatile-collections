<?php

/**
 * Description of TestValueObject2
 *
 * @author aadegbam
 */
class TestValueObject2 {
    
    public $name;
    public $age;
    protected $protected_field = 'protected_field';
    private $private_field = 'private_field';

    public function __construct($name='', $age='') {
        $this->age = $age;
        $this->name = $name;
    }
    
    public static function isItemGreaterThan11($key, $item) {
     
        return $item > 11;
    }
}

function TestValueObject2_IsItemGreaterThan11($key, $item) {
     
    return \TestValueObject2::isItemGreaterThan11($key, $item);
}
