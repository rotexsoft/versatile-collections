<?php
namespace VersatileCollections;

/**
 * Description of ArrayCollection
 *
 * @author aadegbam
 */
class ArrayCollection implements \VersatileCollections\StrictlyTypedCollectionInterface {
    
    use StrictlyTypedCollectionInterfaceImplementationTrait;

    public function checkType($item) {
        
        return is_array($item);
    }

    public function getType() {
        
        return 'array';
    }
}
