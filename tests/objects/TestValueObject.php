<?php

/**
 * Description of TestValueObject
 *
 * @author aadegbam
 */
class TestValueObject {
    public $name;
    public $age;
    protected $data = [];
    private $data2 = [];


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
    
    public function setData(array $data) {
        
        $this->data = $data;
        
        return $this;
    }
    
    public function __isset($key) {
        
        return array_key_exists($key, $this->data);
    }

    public function __get($key) {
        
        if ( array_key_exists($key, $this->data) ) {

            return $this->data[$key];
            
        } else {

            throw new Exception(get_class($this)."::offsetGet({$key})");
        }
    }

    public function __set($key, $val) {
        
        if(is_null($key) ) {
            
            $this->data[] = $val;
            
        } else {
            
            $this->data[$key] = $val;
        }
    }
    
    public function __unset($key) {
        
        $this->data[$key] = null;
        unset($this->data[$key]);
    }
}
