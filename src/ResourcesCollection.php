<?php
namespace VersatileCollections;

/**
 * 
 * Description of ResourcesCollection
 *
 * @author aadegbam
 */
class ResourcesCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;

    public function checkType($item) {
        
        return is_resource($item);
    }
    
    public function getType() {
        
        return 'resource';
    }
}
