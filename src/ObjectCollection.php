<?php
namespace VersatileCollections;

/**
 * Description of ObjectCollection
 *
 * @author aadegbam
 */
class ObjectCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_object($item);
    }
    
    protected function getType() {
        
        return 'object';
    }
}
