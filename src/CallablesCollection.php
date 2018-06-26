<?php
namespace VersatileCollections;

/**
 * Description of CallablesCollection
 *
 * @author aadegbam
 */
class CallablesCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_callable($item);
    }

    protected function getType() {
        
        return 'callable';
    }
}
