<?php
namespace VersatileCollections;

/**
 * Description of ResourceCollection
 *
 * @author aadegbam
 */
class ResourceCollection extends StrictlyTypedCollection {

    protected function checkType($item) {
        
        return is_resource($item);
    }
    
    protected function getType() {
        
        return 'resource';
    }
}
