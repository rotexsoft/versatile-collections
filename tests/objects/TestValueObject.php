<?php

/**
 * Description of TestValueObject
 *
 * @author aadegbam
 */
class TestValueObject {
    public $name;
    public $age;
    
    public function __construct($name='', $age='') {
        $this->age = $age;
        $this->name = $name;
    }
    
    public function getName() {
        
        return $this->name;
    }
    
    public function setName($name) {
        
        $this->name = $name;
    }
    
    public function echoName() {
        
        echo $this->name . PHP_EOL;
    }
    
    public function getAge() {
        
        return $this->age;
    }
    
    public function setAge($age) {
        
        $this->age = $age;
    }
    
    public function echoAge() {
        
        echo $this->age . PHP_EOL;
    }
}
