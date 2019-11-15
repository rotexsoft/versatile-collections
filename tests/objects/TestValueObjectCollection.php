<?php

/**
 * Description of TestValueObjectsCollection
 *
 * @author Rotimi Ade
 */
class TestValueObjectsCollection extends \VersatileCollections\ObjectsCollection {

    public function __construct(\TestValueObject ...$arr_objs) {
                
        $this->versatile_collections_items = $arr_objs;
    }

    public function checkType($item): bool {
        
        return ($item instanceof TestValueObject);
    }
    
    public function getType() {
        
        return \TestValueObject::class;
    }
}
