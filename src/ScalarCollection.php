<?php
namespace VersatileCollections;

/**
 * Description of ScalarCollection
 *
 * @author aadegbam
 */
class ScalarCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_scalar($item);
    }

    protected function getType() {
        
        return 'scalar';
    }
}
