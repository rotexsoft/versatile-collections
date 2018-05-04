<?php

/**
 * Description of TestValueObjectCollection
 *
 * @author aadegbam
 */
class TestValueObjectCollection extends \VersatileCollections\ObjectCollection {

    public function __construct(\TestValueObject ...$arr_objs) {
                
        $this->collection_items = $arr_objs;
    }

    protected function checkType($item) {
        
        return ($item instanceof TestValueObject);
    }
    
    protected function getType() {
        
        return \TestValueObject::class;
    }
}
