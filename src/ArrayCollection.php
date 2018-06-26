<?php
namespace VersatileCollections;

/**
 * Description of ArrayCollection
 *
 * @author aadegbam
 */
class ArrayCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_array($item);
    }

    protected function getType() {
        
        return 'array';
    }
}
