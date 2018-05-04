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
        
        return is_object($item) 
            && ( trim(get_class($item)) === ($this->getType()) );
    }
    
    protected function getType() {
        
        return \TestValueObject::class;
    }
}
