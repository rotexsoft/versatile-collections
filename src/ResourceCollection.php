<?php
namespace VersatileCollections;

/**
 * 
 * Description of ResourceCollection
 *
 * @author aadegbam
 */
class ResourceCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;

    public function checkType($item) {
        
        return is_resource($item);
    }
    
    public function getType() {
        
        return 'resource';
    }
}
